<?php

$db_config = array(
	'host' => 'pgsql:host=localhost;dbname=newsletter',
	'user' => 'user',
	'password' => ''
);

$mail_config = array(
	'from' => 'newsletter@nixers.net',
	'host' => '',
	'port' => '587',
	'username' => 'newsletter@nixers.net',
	'password' => '',
);

define('URL', 'https://nixers.net/newsletter/');
define('TIMEOUT_DELETION',' 2 days ');

