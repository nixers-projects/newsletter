<?php

include_once('functions.php');

if (count($argv) >= 2) {
	$db = get_db_handle();
	delete_not_confirmed($db);
}
