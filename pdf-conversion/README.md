# NodeJS to reading-view

With `node app.js [URL]` this parses the URL to a reading-view, similar to Firefox, using 'readability-node' package.

Uses node lts/boron.

# TODO:

* Have a colon/separator file:
```
ARTICLE NAME===INTRO TEXT===URL===SHOULD FETCH CONTENT
```
* Fetch the content of the articles that are marked as so
* Gather every HTML file in a directory
* Convert the HTML to markdown
* Join back with the non-fetch content
* Convert to PDF (maybe: wkhtmltopdf?)
