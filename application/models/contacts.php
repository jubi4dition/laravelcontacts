<?php

class Contacts {

	public static function get_contacts($uid)
	{
		return DB::table('contacts')->where_uid($uid)->order_by('id', 'asc')->get();
	}

	public static function get_contact_names($uid)
	{
		return DB::table('contacts')->where_uid($uid)->order_by('id', 'asc')->get(array('name'));
	}

	public static function get_contact_data($uid, $name)
	{
		return DB::table('contacts')->where_uid_and_name($uid, $name)->first(array('email', 'phone'));
	}

	public static function add_contact($uid, $name, $email, $phone)
	{
		$contact = DB::table('contacts')->where_uid_and_name($uid, $name)->get();
		if (count($contact) == 1) return FALSE;

		$contact = DB::table('contacts')->insert(array(
			'uid' => $uid, 'name' => $name, 'email' => $email, 'phone' => $phone));
		DB::table('users')->where_id($uid)->increment('contacts');
		return TRUE;
	}

	public static function delete_contact($uid, $name)
	{
		DB::table('contacts')->where_uid_and_name($uid, $name)->delete();
		DB::table('users')->where_id($uid)->decrement('contacts');
	}

	public static function update_contact($uid, $name, $email, $phone)
	{
		DB::table('contacts')->where_uid_and_name($uid, $name)->update(array('email' => $email, 'phone' => $phone));
	}

}
