req = require('request');
r = require('readability-node');
jsdom = require('node-jsdom').jsdom;
fs = require('fs');

var args = process.argv.slice(2);
var uri = args[0] || "https://nixers.net/newsletter/feed.xml";
var src = '';

req.get(uri, function(err, res, body){
    if(!err && res.statusCode == 200){
        var doc = jsdom(body, { 
            features: {
                FetchExternalResources: false,
                ProcessExternalResources: false
            }});

        var article = new r.Readability(uri, doc).parse();

        fs.writeFile("article.html", '<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"><h1>' + article.title + '</h1>\n\n' + article.content, function(err){
            if(err){
                console.log(err);
            }
        });
    } else {
        console.log(err);
    }
});
