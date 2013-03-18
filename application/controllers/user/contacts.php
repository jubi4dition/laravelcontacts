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
        $contacts = Contact::where('uid', '=', Session::get('uid'))->get();

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
            'name' => 'required|max:60|alpha_dash',
            'email' => 'required|max:60|email',
            'phone' => 'required|max:30|alpha_num'
        );

        $validation = Validator::make(Input::get(), $rules);
        
        if ($validation->fails()) {
            $message = "<strong>Adding</strong> failed!";

            return Helper::json(false, $message);
        }

        $name = Input::get('name');

        $created = Contact::create(array(
            'uid' => Session::get('uid'),
            'name' => $name,
            'email' => Input::get('email'),
            'phone' => Input::get('phone')
        ));

        if ($created) {
            $message = "<strong>".$name."</strong> has been added!";
            
            return Helper::json(true, $message);
        } else {
            $message = "<strong>".$name."</strong> already exists!";
            
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
        
        $validation = Validator::make(Input::get(), array('name' => 'required|max:60|alpha_dash'));
        
        if ($validation->fails()) {
            $message = "<strong>Deletion</strong> failed!";
            
            return Helper::json(false, $message);
        }

        $name = Input::get('name');

        Contact::where('uid', '=', Session::get('uid'))
            ->where('name', '=', $name)
            ->delete();

        $message = "<strong>".$name."</strong> has been deleted!";

        return Helper::json(true, $message);  
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
            'name' => 'required|max:60|alpha_dash',
            'email' => 'required|max:60|email',
            'phone' => 'required|max:30|alpha_num'
        );

        $validation = Validator::make(Input::get(), $rules);
        
        if ($validation->fails()) {
            $message = "<strong>Editing</strong> failed!";
            
            return Helper::json(false, $message);
        }
            
        $name = Input::get('name');

        $contact = Contact::where('uid', '=', Session::get('uid'))
            ->where('name', '=', $name)
            ->first();

        $contact->email = Input::get('email');
        $contact->phone = Input::get('phone');
        $contact->save();

        $message = "Editing for <strong>".$name."</strong> has been done!";
        
        return Helper::json(true, $message); 
    }

    public function post_data()
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
}
