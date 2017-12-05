<?php
include_once("config.php");
?>
<!doctype html>
<html>

<head>
	<meta charset='utf-8' />
	<title>Newsletter Subscription</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link type="text/css" rel="stylesheet" href="https://nixers.net/css.php?stylesheet=44" />
	<link type="text/css" rel="stylesheet" href="https://nixers.net/cache/themes/theme1/thread_status.css" />
	<link type="text/css" rel="stylesheet" href="https://nixers.net/cache/themes/theme13/css3.css" />
	<link rel="shortcut icon" href="https://i.imgur.com/yzxJYgq.png" />
	<link rel="alternate" type="application/rss+xml" title="Newsletter Feed (RSS)" href="<?=rtrim(URL,'/').'/'.trim(NEWSLETTER_RSS_PLACE,'/');?>" />

<style>
#navlinks li {
	display: inline;
	padding-right: 0.5ex;
	padding-left: 0.5ex;
}
#navlinks li::after {
	content: "     |    ";
}
::selection {
  background: #ffb7b7; /* WebKit/Blink Browsers */
}
::-moz-selection {
  background: #ffb7b7; /* Gecko Browsers */
}
p {
	margin-top: 1ex;
	margin-bottom: 1ex;
}
.feed_content {
	word-wrap: break-word;
}
code {
    overflow: scroll;
    max-width: 100%;
    display: block;
}
</style>

</head>

<body>
<!--
      _)                                  |   
 __ \  |\ \  /  _ \  __| __|   __ \   _ \ __| 
 |   | | `  <   __/ |  \__ \   |   |  __/ |   
_|  _|_| _/\_\\___|_|  ____/_)_|  _|\___|\__| 
                                   
-->

<div id="header">
	<div id="infobar">
		<div id="navcontainer">
			<div id="nixerlogo">
				<a href="<?=URL?>">nixers</a><span style="color:#638B87; font-size: 13px;">' newsletter</span>
			</div>
			<hr/>
			<div id="navlinks">
				<span class="inline_block"> 
					<a href="./feed.xml">RSS</a>
				</span>
				<span>&nbsp;|&nbsp;</span>
				<span class="inline_block"> 
					<a href="./entries.php">Browsable Entries</a>
				</span>
				<span>&nbsp;|&nbsp;</span>
				<span class="inline_block"> 
					<a href="https://nixers.net">Forums</a>
				</span>
				<span>&nbsp;|&nbsp;</span>
				<span class="inline_block"> 
					<a href="https://podcast.nixers.net/what">Podcast</a>
				</span>
				<span>&nbsp;|&nbsp;</span>
				<span class="inline_block"> 
					<a href="https://nixers.net/showthread.php?tid=1939">Other Activities</a>
				</span>
			</div>
			<hr/>
		</div>
	</div>
</div>


<h1>Nixers Newsletter</h1>
