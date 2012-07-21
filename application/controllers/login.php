<?php

class Login_Controller extends Base_Controller {

	public function action_index()
	{		
		if (Session::get('logged_in') == TRUE) {
			return Redirect::to('user');
		} else {
			return View::make('login.index')->with('error', FALSE);
		}
	}

	public function action_checklogin()
	{
		$rules = array(
			'email' => 'required|max:40|email',
			'pwd' => 'required|max:20|alpha_num'
		);
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails()) {
			return Redirect::to('login/error');
		}

		$email = Input::get('email');
		$password = Input::get('pwd');
		$is_user = Users::is_user($email, $password);
		if ($is_user) {
			Session::put('uid', Users::get_uid($email));
			Session::put('email', $email);
			Session::put('logged_in', TRUE);
			return Redirect::to('user');
		} else {
			return Redirect::to('login/error');
		}
	}

	public function action_error()
	{
		return View::make('login.index')->with('error', TRUE);
	}

	public function action_logout()
	{
		Session::flush();
		return View::make('login.index')->with('error', FALSE);
	}

}
