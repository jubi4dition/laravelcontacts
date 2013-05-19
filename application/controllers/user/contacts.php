<?php

class User_Contacts_Controller extends Base_Controller {

    public $restful = true;

    public function __construct()
    {
        parent::__construct();

        $this->filter('before', 'auth');
    }

    public function get_index()
    {
        //$contacts = Contact::where('uid', '=', Session::get('uid'))->get();
        $contacts = Contact::where('uid', '=', Session::get('uid'))->paginate(50);

        return View::make('contacts.index')->with('contacts', $contacts); 
    }

    public function get_add()
    {
        return View::make('contacts.add');
    }

    public function post_add()
    {
        sleep(1);
        
        $rules = array(
            'name' => 'required|max:60|alpha_space',
            'email' => 'required|max:60|email',
            'phone' => 'required|max:30|alpha_num'
        );

        $validation = Validator::make(Input::get(), $rules);
        
        if ($validation->fails()) {
            $message = "<b>Error!</b> Invalid <b>input!</b>";

            return Helper::json(false, $message);
        }

        $contact = Contact::where('uid', '=', Session::get('uid'))
            ->where('name', '=', Input::get('name'))->first();

        if ($contact != null) {
            $message = "<b>Error!</b> A <b>contact</b> with this <b>name</b> already exists!";

            return Helper::json(false, $message); 
        }

        $contact = Contact::create(array(
            'uid' => Session::get('uid'),
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'phone' => Input::get('phone')
        ));

        if ($contact) {
            $message = "<b>Success!</b> Contact <b>".$contact->name."</b> has been added!";
            
            return Helper::json(true, $message);
        } else {
            $message = "<b>Error!</b> The <b>contact</b> couldn't be created!";
            
            return Helper::json(false, $message);
        }     
    }

    public function get_delete()
    {
        $contacts = Contact::where('uid', '=', Session::get('uid'))->get();

        return View::make('contacts.delete')->with('contacts', $contacts);
    }

    public function post_delete()
    {
        sleep(1);
        
        $validation = Validator::make(Input::get(), array('name' => 'required|max:60|alpha_space'));
        
        if ($validation->fails()) {
            $message = "<b>Error!</b> Invalid <b>input!</b>";
            
            return Helper::json(false, $message);
        }

        $name = Input::get('name');

        $deleted = Contact::where('uid', '=', Session::get('uid'))
            ->where('name', '=', $name)
            ->delete();

        if ($deleted) {
            $message = "<b>Success!</b> Contact <b>".$name."</b> has been deleted!";
            
            return Helper::json(true, $message);
        } else {
            $message = "<b>Error!</b> The <b>contact</b> couldn't be deleted!";
            
            return Helper::json(false, $message);
        }  
    }

    public function get_edit()
    {
        $contacts = Contact::where('uid', '=', Session::get('uid'))->get();

        return View::make('contacts.edit')->with('contacts', $contacts);
    }

    public function post_edit()
    {
        sleep(1);

        $rules = array(
            'name' => 'required|max:60|alpha_space',
            'email' => 'required|max:60|email',
            'phone' => 'required|max:30|alpha_num'
        );

        $validation = Validator::make(Input::get(), $rules);
        
        if ($validation->fails()) {
            $message = "<b>Error!</b> Invalid <b>input!</b>";
            
            return Helper::json(false, $message);
        }
            
        $name = Input::get('name');

        $contact = Contact::where('uid', '=', Session::get('uid'))
            ->where('name', '=', $name)
            ->first();

        $contact->email = Input::get('email');
        $contact->phone = Input::get('phone');
        
        if ($contact->save()) {
            $message = "<b>Success!</b> Contact <b>".$contact->name."</b> has been edited!";
            
            return Helper::json(true, $message);
        } else {
            $message = "<b>Error!</b> The <b>contact</b> couldn't be edited!";
            
            return Helper::json(false, $message);
        }  
    }

    public function post_data()
    {
        $validation = Validator::make(Input::get(), array('name' => 'required|max:60|alpha_space'));
        
        if ($validation->fails()) {
            $message = "No <b>Data</b> found!";
            
            return Helper::json(false, $message);
        }

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

}
