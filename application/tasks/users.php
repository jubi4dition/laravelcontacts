<?php

class Users_Task {

    public function create($arguments)
    {
        $email = $arguments[0];
        $password = $arguments[1];

        DB::table('users')->insert(array(
            'email' => $email,
            'password' => Hash::make($password)
        ));

        echo "User created!";
    }

    public function delete($arguments)
    {
        $userID = $arguments[0];

        DB::table('users')->where('id', '=', $userID)->delete();

        echo "User deleted!";
    }
    
}