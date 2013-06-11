LaravelContacts
===============

LaravelContacts is the counterpart to [YourContacts](https://github.com/jubi4dition/yourcontacts). 
Now it's based on the PHP Framework Laravel-3 instead of Codeigniter-2.

See it in action: http://youtu.be/K-GM9SeyH1Y

Current Version: **1.2.3**

Usage
-----

Using LaravelContacts requires the following steps.

* Copy the yourcontacts folder to your webroot
* If you are not using PHP 5.4, then you have to activate the short_open_tag in the php.ini
* You could also create a VirtualHost in Apache (laravelcontacts.dev) with points to the public folder
* Edit application/config/database.php, SQLite or MySql, Username and password for MySQL
* With SQLite you don't have to do anything
* With MySQL you have to create the database 'laravelcontacts' and then run 'php artisan DatabaseFiller' or import the sql-file
* Open the site in your browser
* You can login for example with Email = 'user1@mail.com' and Password = 'password' 

Authors
-------

jubi4dition

* yubi4dition@gmail.com

Last Words
----------

Have fun, maybe you can learn something from the source code or you can improve it.
