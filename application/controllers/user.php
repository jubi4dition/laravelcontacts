<?php

class User_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->filter('before', 'auth');
	}

	public function action_index()
	{
		//$contacts = Contacts::get_contacts(Session::get('uid'));
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
		$input = Input::all();
		$rules = array(
			'name' => 'required|max:40|alpha_dash',
			'email' => 'required|max:40|email',
			'phone' => 'required|max:15|alpha_num'
		);
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			$data = array(
				'success' => FALSE,
				'message' => "<strong>Adding</strong> failed!"
			);
			return Response::json($data);
		} else {
			$name = Input::get('name');
			$email = Input::get('email');
			$phone = Input::get('phone');
			$is_added = Contacts::add_contact(Session::get('uid'), $name, $email, $phone);
			if ($is_added) {
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
		//$contacts = Contacts::get_contacts(Session::get('uid'));
		$contacts = Contact::where('uid', '=', Session::get('uid'))->get();

		if (count($contacts) > 0) {
			return View::make('user.delete')->with('contacts', $contacts);
		} else {
			return View::make('user.delete_error');
		}
		
	}

	public function action_delete_contact()
	{
		sleep(1);
		$input = Input::all();
		$rules = array('name' => 'required|max:40|alpha_dash');
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			$message = "<strong>Deletion</strong> failed!";
			$data = array(
				'success' => FALSE,
				'message' => $message,
			);
			return Response::json($data);
		} else {
			$name = Input::get('name');
			Contacts::delete_contact(Session::get('uid'), $name);

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
		//$contacts = Contacts::get_contacts(Session::get('uid'));
		$contacts = Contact::where('uid', '=', Session::get('uid'))->get();

		if (count($contacts) > 0) {
			return View::make('user.edit')->with('contacts', $contacts);
		} else {
			return View::make('user.edit_error');
		}	
	}

	public function action_edit_contact()
	{
		sleep(1);
		$input = Input::all();
		$rules = array(
			'name' => 'required|max:40|alpha_dash',
			'email' => 'required|max:40|email',
			'phone' => 'required|max:15|alpha_num'
		);
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			$message = "<strong>Editing</strong> failed!";
			$data = array('success' => FALSE, 'message' => $message);
			return Response::json($data);
		} else {
			$name = Input::get('name');
			$email = Input::get('email');
			$phone = Input::get('phone');
			
			Contacts::update_contact(Session::get('uid'), $name, $email, $phone);
			
			$message = "Editing for <strong>".$name."</strong> has been done!";
			$data = array('success' => TRUE, 'message' => $message);
			return Response::json($data);
		}	
	}

	public function action_contactdata()
	{
		$contact = Contacts::get_contact_data(Session::get('uid'), Input::get('name'));
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
		$input = Input::all();
		$rules = array(
			'curpwd' => 'required|max:20|alpha_num',
			'newpwd' => 'required|max:20|alpha_num'
		);
		$validation = Validator::make($input, $rules);
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
		$users = User::all();

		foreach ($users as $user) {
			echo $user->email;
		}
	}

}
