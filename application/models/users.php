<?php

class Users {

	public static function is_user($email, $password)
	{
		$user = DB::table('users')->where_email($email)->first();
		return Hash::check($password, $user->password) ? TRUE : FALSE;
	}

	public static function get_uid($email)
	{
		return DB::table('users')->where_email($email)->first()->uid;
	}

	public static function validate_password($uid, $password)
	{
		$user = DB::table('users')->where_uid($uid)->first();
		return Hash::check($password, $user->password) ? TRUE : FALSE;
	}

	public static function update_password($uid, $password)
	{
		$hashed_pwd = Hash::make($password);
		DB::table('users')->where_uid($uid)->update(array('password' => $hashed_pwd));
	}

}
