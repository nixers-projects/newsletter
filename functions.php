<?php

include_once('config.php');


function get_db_handle() {
	global $db_config;
	return new PDO($db_config['host'], $db_config['user'], $db_config['password']);
}

function validate_email($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_already_in_emails($email, $psql) {
	$query = "SELECT email
		FROM maillist ";
	$sth = $psql->prepare($query);
	$sth->execute(array());
	$result = $sth->fetchAll();
	foreach($result as $m) {
		if ($m['email'] === $email) {
			return true;
		}
	}
	return false;
}

function get_subscribed_emails($psql) {
	$query = "SELECT email
		FROM maillist where confirm='T' ";
	$sth = $psql->prepare($query);
	$sth->execute(array());
	$result = $sth->fetchAll();
	return $result;
}


function add_to_maillist($email, $psql) {
	$query = "INSERT INTO maillist
		(email, confirm, token, timestamp) values(?,'F',?,now())";
	$sth = $psql->prepare($query);
	$result = $sth->execute(array($email, uniqid('nixers_').md5(rand())));
	send_email(
	$email,
	"Hello $email,

You're receiving this email because you've subscribed to the Nixers Newsletter.

To confirm your subscription please follow this link:
".URL."confirm.php?email=".$email.'&token='.get_associated_token($email,$psql)."\r\n\r\n",
	"Nixers Newsletter Confirm Subscription",
	false,
	$psql
);
	return $result;
}

function get_associated_token($email, $psql) {
	$query = "SELECT token
		FROM maillist WHERE email=? LIMIT 1";
	$sth = $psql->prepare($query);
	$sth->execute(array($email));
	$result = $sth->fetchAll();
	return @$result[0]['token'];
}

function unsubscribe_email($email, $token, $psql) {
	$token_db = get_associated_token($email, $psql);
	if ($token_db != $token) {
		return false;
	}
	$query = "DELETE FROM maillist
		where email = ?";
	$sth = $psql->prepare($query);
	$result = $sth->execute(array($email));
	return $result;

}

function confirm_email($email, $token, $psql) {
	$token_db = get_associated_token($email, $psql);
	if ($token_db != $token) {
		return false;
	}

	$query = "UPDATE maillist
		set confirm = 'T' where email = ?";
	$sth = $psql->prepare($query);
	$result = $sth->execute(array($email));
	return $result;
}

function delete_not_confirmed($psql) {
	$query = "DELETE from maillist
		where now()-timestamp >= ".TIMEOUT_DELETION."
		and confirm = 'F'";
	$sth = $psql->prepare($query);
	$result = $sth->execute(array());
	return $result;
}

function send_email($email, $content, $subject, $append_unsubscribe=false, $psql) {
	global $mail_config;

	if ($append_unsubscribe) {
		$query = "SELECT token FROM MAILLIST WHERE email=? LIMIT 1";
		$sth = $psql->prepare($query);
		$sth->execute(array($email));
		$result = $sth->fetchAll();
		if (count($result) != 1) {
			return -1;
		}
		$token = $result[0]['token'];
		$content .= "\r\n\r\nunsucscribe:\r\n".URL.'unsusbscribe.php?email='.$email.'&token='.$token."\r\n";
	}

	//$content = wordwrap($content, 79, "\r\n");
	$headers = "From: newsletter@nixers.net";
	//print $email.":".$content;
	mail($email, $subject, $content, $headers);

	/*
	 * Use another server to send the mails
	 * pear install Mail Net_SMTP
	 */
	//$headers = array(
	//	'From' => $mail_config['from'],
	//	'To' => $email,
	//	'Subject' => $subject
	//);
	//$smtp = &Mail::factory(
	//	'smtp',
	//	array(
	//		'host' => $mail_config['host'],
	//		'port' => $mail_config['port'],
	//		'auth' => true,
	//		'debug' => DEBUG,
	//		'username' => $mail_config['username'],
	//		'password' => $mail_config['password']
	//	)
	//);
	//if (PEAR::isError($smtp)) {
	//	return 0;
	//	/*printf("PEAR Mail Factory error: %s\n", $smtp->getMessage());
	//	printf("SMTP Object: %s\n", $smtp->toString());
	//	printf("SMTP Debug info: %s\n", $smtp->getDebugInfo());
	//	die("\n\ttestmail.php failed\n\n");*/
	//}
	//$mail = $smtp = $smtp->send($email, $headers, $content);
	//if (PEAR::isError($mail)) {
	//	//echo("<p>" . $mail->getMessage() . "</p>");
	//	return 0;
	//} else {
	//	return 1;
	//}
}


function startsWith($haystack, $needle) {
	// search backwards starting from haystack length characters from the end
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
	// search forward starting from end minus needle length characters
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function aggregate_newsletters($newslettersDir = NEWSLETTER_DIR, $extension = NEWSLETTER_FILE_EXTENSION){
	if (!file_exists($newslettersDir) || (file_exists($newslettersDir) && is_dir($newslettersDir) === false))
		return false;

	$files = array(); //the return array

	$dircontent = scandir($newslettersDir);
	foreach ($dircontent as $item){
		if ( (is_dir($item) === false) && (pathinfo($item, PATHINFO_EXTENSION) == $extension) ){ 
			$file = array();
			
			//filenames are TITLE_YYYYMMDD.EXT
			$basename = basename($item, '.'.$extension);
			$file['title'] = explode('_',$basename)[0];
			$date = date_create(explode('_',$basename)[1]);
			$file['date'] = date_format($date, 'Y-m-d H:i:s');
			$file['content'] = file_get_contents(rtrim($newslettersDir,'/').'/'.$item);
			$files[] = $file;
		}
	}

	return $files;
}
