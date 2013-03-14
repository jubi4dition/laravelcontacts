<?php

class User_Controller extends Base_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->filter('before', 'auth');
    }

    public function action_index()
    {
        $contacts = Contact::where('uid', '=', Session::get('uid'))->get();

        return View::make('user.contacts')->with('contacts', $contacts); 
    }

    public function action_profile()
    {
        return View::make('user.profile');
    }

    public function action_profile_password()
    {
        sleep(1);

        $rules = array(
            'curpwd' => 'required|max:20|alpha_num',
            'newpwd' => 'required|max:20|alpha_num'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            $message = '<strong>Changing</strong> failed!';
            $data = array('success' => FALSE, 'message' => $message);
            return Response::json($data);
        } else {
            $cur_pwd = Input::get('curpwd');
            $new_pwd = Input::get('newpwd');

            $pwd_valid = Users::validate_password(Session::get('uid'), $cur_pwd);
            if ($pwd_valid) {
                Users::update_password(Session::get('uid'), $new_pwd);
                
                $message = '<strong>Password</strong> has been changed!';
                $data = array('success' => TRUE, 'message' => $message);
                return Response::json($data);
            } else {
                $message = '<strong>Current Password</strong> is wrong!';
                $data = array('success' => FALSE, 'message' => $message);
                return Response::json($data);
            }
        }
    }

}
