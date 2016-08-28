# Minify PHP
I have had a few instances where I was building a simple website that would either not have any dynamic aspects, or every dynamic aspect would be created through the use of Javascript (or some other script respectively).

In these case I still wanted my development process to be organized and allow for dynamic creation of certain aspects.

And, it would be nice to export the end result as minified HTML.

So, I created a simple script that usig cURL grabs the HTML output, minifies it and creates a static HTML file.

##History
I, for reasons I cannot remember, happened to look at the raw source code of the website https://www.netflix.com and noticed that all the whitespace, line breaks and comments had been stripped.
It was minified...I thought. That's clever. Combine this with server-side compression and minified CSS and JS files and you will likely reduce dowload time by a signifigant factor.

##What Gets Minified
The script strips:
- Line break characters '\n\r'
- Non HTML tabs '\t'
- multiple spaces
- HTML comments '<!-- content -->'

##Other Workflow Suggestions
Generally I like to use Grunt with SASS to create and compress my stylesheets and javascript files.


