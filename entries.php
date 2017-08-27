<?php
include("header.tpl.php");

$rss = new DOMDocument();
$load_result = $rss->load('./feed.xml');
if (!$load_result) {
        print "Error Loading RSS";
        exit;
}

$feed = array();
foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array ( 
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
        );
        array_push($feed, $item);
}

?>
<div id='container'>
<div id='content'>
<?php
$count = count($feed);
foreach ($feed as $f) {
        print "<table id='".$count."' class='tborder postbit_table' style='margin-top: 3.3em;' cellspacing='1' cellpadding='4' border='1'>
                <tbody>
                        <tr style='border-bottom: none;'>
                                <td class='trow1 posttop'>
                                        <table class='avatartable' style='border: none !important;' cellspacing='0' cellpadding='0' border='0'>
                                        <tbody><tr>
                                        <td class='post_author' style=''>
                                                <span class='largetext usernames'>
                                                        nixers newsletter issue
                                                </span> |
                                                <span class='smalltext'> ".$f['date']." </span> |
                                                <span class='smalltext'> <a href='#".$count."'>$count</a> </span>

                                        </td></tr>
                                        </tbody>
                                        </table>
                                </td>
                        </tr>
                        <tr>
                                <td class='trow1 post_content'>
                                        <div class='post_body'>
                                                <div class='feed_content'>".$f['content']."</div>
                                        </div>
                                </td>
                        </tr>
                </tbody>
        </table>";
        $count--;
}

?>
</div>
</div>

</body>

</html>
