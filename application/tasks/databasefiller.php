<?php

class DatabaseFiller_Task {

	public function run()
	{	
		Schema::create('users', function($table)
		{
		    $table->increments('id');
		    $table->string('email', 80);
		    $table->string('password', 60);
		    $table->timestamps();
		});

		Schema::create('contacts', function($table)
		{
		    $table->increments('id');
		    $table->integer('uid')->unsigned();
		    $table->string('name', 60);
		    $table->string('email', 80);
		    $table->string('phone', 30);
		    $table->timestamps();

		    //$table->foreign('uid')->references('id')->on('users');
		});

		$user1 = User::create(array(
            'email' => 'user1@mail.com',
            'password' => Hash::make('password')
        ));

		$user2 = User::create(array(
            'email' => 'user2@mail.com',
            'password' => Hash::make('password')
        ));

        Contact::create(array(
            'uid' => $user1->id,
            'name' => 'contact1',
            'email' => 'contact1@mail.com',
            'phone' => '11111111111111111'
        ));

        Contact::create(array(
            'uid' => $user1->id,
            'name' => 'contact2',
            'email' => 'contact2@mail.com',
            'phone' => '22222222222222222'
        ));

        Contact::create(array(
            'uid' => $user2->id,
            'name' => 'contact1',
            'email' => 'contact1@mail.com',
            'phone' => '11111111111111111'
        ));

        Contact::create(array(
            'uid' => $user2->id,
            'name' => 'contact2',
            'email' => 'contact2@mail.com',
            'phone' => '22222222222222222'
        ));	
	}

	public function drop()
	{
		Schema::drop('users');
		Schema::drop('contacts');
	}

}
