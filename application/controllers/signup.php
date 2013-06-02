<?php

class Signup_Controller extends Base_Controller {

    public function action_index()
    {       
        return View::make('signup.index');
    }

    public function action_check()
    {
    	$rules = array(
            'email' => 'required|max:80|email',
            'email-repeat' => 'required|max:80|email',
            'pwd' => 'required|max:30|alpha_num',
            'pwd-repeat' => 'required|max:30|alpha_num'
        );

        $validation = Validator::make(Input::get(), $rules);

        if ($validation->fails()) {
            $message = "<b>Error!</b> Invalid <b>input!</b>";

            return Helper::json(false, $message);
        }

        $email = Input::get('email');
        $password = Input::get('pwd');

        if ($email != Input::get('email-repeat')) {
            $message = "<b>Error!</b> The <b>Emails</b> do not match!";
            return Helper::json(false, $message);

        } elseif ($password != Input::get('pwd-repeat')) {
            $message = "<b>Error!</b> The <b>Passwords</b> do not match!";
            return Helper::json(false, $message);
        
        } elseif (User::where('email', '=', $email)->count() != 0) {
            $message = "<b>Error!</b> The <b>Email</b> is already used!";
            return Helper::json(false, $message);
        }

        $user = User::create(array(
            'email' => $email,
            'password' => Hash::make($password)
        ));

        if ($user) {
            $message = "<b>Success!</b> The <b>Registration</b> was successful!";
            return Helper::json(true, $message);
        } else {
            $message = "<b>Error!</b> The <b>Account</b> couldn't be created!";
            return Helper::json(false, $message);
        }
    }

}
