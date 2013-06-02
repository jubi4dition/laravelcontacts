<?php

class Users_Task {

    public function create($arguments)
    {
        $email = $arguments[0];
        $password = $arguments[1];

        if (User::where('email', '=', $email)->count() != 0) {
            echo "Email is already used.";
        } else {
            $user = User::create(array(
                'email' => $email,
                'password' => Hash::make($password)
            ));

            if ($user) {
                echo "User created!";
            } else {
                echo "User not created!";
            }
        }   
    }

    public function delete($arguments)
    {
        $userID = $arguments[0];

        DB::table('users')->where('id', '=', $userID)->delete();

        echo "User deleted!";
    }
    
}
