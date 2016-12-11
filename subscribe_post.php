<?php
include("header.tpl.php");
?>

<?php

include_once('functions.php');

//need to validate the email
if (!isset($_POST['email']) || ! validate_email($_POST['email'])){
	print "ERROR";
	exit(1);
}
$email = $_POST['email'];
$db = get_db_handle();

if (is_already_in_emails($email, $db)) {
	print "Already subscribed, confirm by email";
}
else {
	add_to_maillist($email, $db);
	print "Added to nixers newsletter, you'll receive an email shortly";
}
