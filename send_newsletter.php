<?php

include_once('functions.php');

if (count($argv) >= 2 && file_exists($argv[1])) {

	$db = get_db_handle();
	$emails = get_subscribed_emails($db);

	$email_content = file_get_contents($argv[1]);
	foreach ($emails as $e) {
		send_email($e['email'], $email_content, 'Nixers Newsletter', true, $db);
	}
}

