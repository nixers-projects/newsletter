<?php

include_once('functions.php');
define('NEWSLETTER_TITLE','Nixers Newsletter');
define('NEWSLETTER_LINK','http://nixers.net/');
define('NEWSLETTER_DESCRIPTION','Yet another newsletter');

define('NEWSLETTER_HEADER','<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
<title>'.NEWSLETTER_TITLE.'</title>
<link>'.NEWSLETTER_LINK.'</link>
<description>'.NEWSLETTER_DESCRIPTION.'</description>');

define('NEWSLETTER_FOOTER','</channel></rss>');
define('NEWSLETTER_RSS_PATH','feed.xml');

$files = aggregate_newsletters('./newsletters/','html');
$body = "";

foreach ($files as $file){
	$title = $file['title'];
	$link = NEWSLETTER_LINK; //this should be dynamic
	$date = $file['date'];
	$content = $file['content'];
	$body .= 
		"<item>
			<title>$title</title>
			<link>$link</link>
			<pubDate>$date</pubDate>
			<content:encoded><![CDATA[$content]]></content:encoded>
		</item>";
}

$generatedContent = NEWSLETTER_HEADER.$body.NEWSLETTER_FOOTER;

file_put_contents(NEWSLETTER_RSS_PATH,$generatedContent);
