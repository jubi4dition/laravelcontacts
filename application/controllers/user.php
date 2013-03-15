<?php

class User_Controller extends Base_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->filter('before', 'auth');
    }

    public function action_index()
    {
        return View::make('user.index'); 
    }

    public function action_profile()
    {
        return View::make('user.profile');
    }

    public function action_password()
    {
        sleep(1);

        $rules = array(
            'curpwd' => 'required|max:30|alpha_num',
            'newpwd' => 'required|max:30|alpha_num'
        );

        $validation = Validator::make(Input::get(), $rules);

        if ($validation->fails()) {
            $message = '<strong>Changing</strong> failed!';
            
            return Helper::json(false, $message);
        }

        $currentPassword = Input::get('curpwd');
        $newPassword = Input::get('newpwd');

        $user = User::where('id', '=', Session::get('uid'))->first();

        if (Hash::check($currentPassword, $user->password)) {
            
            $user->password = Hash::make($newPassword);
            $user->save();
            
            $message = '<strong>Password</strong> has been changed!';

            return Helper::json(true, $message);
        } else {
            $message = '<strong>Current Password</strong> is wrong!';

            return Helper::json(false, $message);
        }
    }

}
