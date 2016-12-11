<?php

include_once('functions.php');

$db = get_db_handle();
delete_not_confirmed($db);
