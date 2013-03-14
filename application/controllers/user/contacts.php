<?php

class User_Contacts_Controller extends Base_Controller {

    public $restful = true;

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
                
                return Helper::json(true, $message);
            } else {
                $message = "<strong>".$name."</strong> already exists!";
                
                return Helper::json(false, $message);
            }
            
        }   
    }
}
