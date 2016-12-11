<?php
include("header.tpl.php");
?>

<?php

include_once('functions.php');

if (!isset($_GET['email'], $_GET['token'])) {
	print "ERROR";
	exit(1);
}
$email = $_GET['email'];
$token = $_GET['token'];
$db = get_db_handle();


if (confirm_email($email, $token, $db)) {
	print 'subscribed successfully';
}
else {
	print "ERROR";
}

