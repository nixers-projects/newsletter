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

define('URL', 'https://newsletter.nixers.net/');
define('TIMEOUT_DELETION',' 2 days ');

define('NEWSLETTER_TITLE','Nixers Newsletter');
define('NEWSLETTER_LINK','https://newsletter.nixers.net/');
define('NEWSLETTER_DESCRIPTION','The Nixers.net Newsletter');

//Feed Structure
define('NEWSLETTER_HEADER','<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
<title>'.NEWSLETTER_TITLE.'</title>
<link>'.NEWSLETTER_LINK.'</link>
<description>'.NEWSLETTER_DESCRIPTION.'</description>');
define('NEWSLETTER_FOOTER','</channel></rss>');
//End Feed Structure

define('NEWSLETTER_RSS_PATH','feed.xml'); //the local place of the feed
define('NEWSLETTER_DIR','./newsletters');
define('NEWSLETTER_FILE_EXTENSION','html');
define('NEWSLETTER_RSS_PLACE','feed.xml'); //the url of the feed URL.NEWSLETTER_RSS_PLACE
