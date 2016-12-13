<?php

include_once('functions.php');
if (count($argv) >= 2) {
	$files = aggregate_newsletters();
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
}
