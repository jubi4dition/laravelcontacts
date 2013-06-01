<?php

class Contact extends Eloquent {

    public static $timestamps = true;

    public function set_email($email)
    {
        $this->set_attribute('email', Str::lower($email));
    }

}
