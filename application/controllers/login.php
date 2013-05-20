<?php

class Login_Controller extends Base_Controller {

    public function action_index()
    {       
        if (Auth::guest()) {
            return View::make('login.index');
        } else {
            return Redirect::to('home');
        }
    }

    public function action_check()
    {
        $rules = array(
            'email' => 'required|max:60|email',
            'pwd' => 'required|max:30|alpha_num'
        );

        $validation = Validator::make(Input::get(), $rules);
        
        if ($validation->fails()) {
            return Redirect::to('login/error');
        }

        $email = Input::get('email');
        $password = Input::get('pwd');
        $credentials = array('username' => $email, 'password' => $password);
        
        if (Auth::attempt($credentials)) {
            Session::put('uid', Auth::user()->id);
            Session::put('email', Auth::user()->email);
            
            return Redirect::to('user');
        } else {
            //Input::flash('only', array('email'));

            //return Input::old('email');
            return Redirect::to('login/error')->with_input('only', array('email'));;
        }
    }

    public function action_error()
    {
        return View::make('login.index')->with('error', true);
    }

    public function action_logout()
    {
        Auth::logout();

        return View::make('login.index');
    }

}
