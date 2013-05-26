<?php

class Contacts_Task {

	public function randoms($arguments)
	{
		$userID = $arguments[0];
		$count = $arguments[1];

		for ($i = 0; $i < $count; $i++) {

			$name = Str::random(8, 'alpha');
			$email = $name.'@mail.com';
			$phone = rand();

			DB::table('contacts')->insert(array(
				'uid' => $userID,
				'name' => $name,
				'email' => $email,
				'phone' => $phone
			));
		}

		echo "Created Contacts: " .$count;
	}

	public function clear($arguments)
	{
		$userID = $arguments[0];

		$affected = DB::table('contacts')->where('uid', '=', $userID)->delete();

		echo "Affected: " .$affected;
	}
}