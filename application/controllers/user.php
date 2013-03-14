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

	public function action_add()
	{
		return View::make('user.add');
	}

	public function action_add_contact()
	{
		sleep(1);
		
		$rules = array(
			'name' => 'required|max:60|alpha_dash',
			'email' => 'required|max:60|email',
			'phone' => 'required|max:30|alpha_num'
		);

		$validation = Validator::make(Input::get(), $rules);
		
		if ($validation->fails()) {
			$data = array(
				'success' => FALSE,
				'message' => "<strong>Adding</strong> failed!"
			);

			return Response::json($data);
		} else {
			$name = Input::get('name');

			$created = Contact::create(array(
				'uid' => Session::get('uid'),
				'name' => $name,
				'email' => Input::get('email'),
				'phone' => Input::get('phone')
			));

			if ($created) {
				$message = "<strong>".$name."</strong> has been added!";
				$data = array('success' => TRUE, 'message' => $message);
				
				return Response::json($data);
			} else {
				$message = "<strong>".$name."</strong> already exists!";
				$data = array('success' => FALSE, 'message' => $message);
				
				return Response::json($data);
			}
			
		}	
	}

	public function action_delete()
	{
		$contacts = Contact::where('uid', '=', Session::get('uid'))->get();

		return View::make('user.delete')->with('contacts', $contacts);
	}

	public function action_delete_contact()
	{
		sleep(1);
		
		$validation = Validator::make(Input::get(), array('name' => 'required|max:60|alpha_dash'));
		
		if ($validation->fails()) {
			$message = "<strong>Deletion</strong> failed!";
			$data = array(
				'success' => FALSE,
				'message' => $message,
			);
			return Response::json($data);
		} else {
			$name = Input::get('name');

			Contact::where('uid', '=', Session::get('uid'))
				->where('name', '=', $name)
				->delete();

			$message = "<strong>".$name."</strong> has been deleted!";
			$data = array(
				'success' => TRUE,
				'message' => $message,
				'name' => $name
			);
			return Response::json($data);
		}	
	}

	public function action_edit()
	{
		$contacts = Contact::where('uid', '=', Session::get('uid'))->get();

		return View::make('user.edit')->with('contacts', $contacts);
	}

	public function action_edit_contact()
	{
		sleep(1);

		$rules = array(
			'name' => 'required|max:60|alpha_dash',
			'email' => 'required|max:60|email',
			'phone' => 'required|max:30|alpha_num'
		);

		$validation = Validator::make(Input::get(), $rules);
		
		if ($validation->fails()) {
			$message = "<strong>Editing</strong> failed!";
			$data = array('success' => FALSE, 'message' => $message);
			return Response::json($data);
		} else {
			$name = Input::get('name');

			$contact = Contact::where('uid', '=', Session::get('uid'))
				->where('name', '=', $name)
				->first();

			$contact->email  = Input::get('email');
			$contact->phone = Input::get('phone');
			$contact->save();

			$message = "Editing for <strong>".$name."</strong> has been done!";
			$data = array('success' => TRUE, 'message' => $message);

			return Response::json($data);
		}	
	}

	public function action_contactdata()
	{
		$contact = Contact::where('uid', '=', Session::get('uid'))
			->where('name', '=', Input::get('name'))
			->first();

		$data = array(
			'success' => TRUE,
			'email' => $contact->email,
			'phone' => $contact->phone
		);
		
		return Response::json($data);
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

	public function action_test()
	{
		if(Contact::$timestamps) {
			return "true";
		} else {
			return "false";
		}
	}

}
