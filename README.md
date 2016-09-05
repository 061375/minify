# Minify PHP
I have had a few instances where I was building a simple website that would either not have any dynamic aspects, or every dynamic aspect would be created through the use of Javascript (or some other script respectively).

In these case I still wanted my development process to be organized and allow for dynamic creation of certain aspects.

And, it would be nice to export the end result as minified HTML.

So, I created a simple script that usig cURL grabs the HTML output, minifies it and creates a static HTML file.

##History
I, for reasons I cannot remember, happened to look at the raw source code of the website www.netflix.com and noticed that all the whitespace, line breaks and comments had been stripped.
It was minified...I thought. That's clever. Combine this with server-side compression and minified CSS and JS files and you will likely reduce dowload time by a signifigant factor.

##What Gets Minified
The script strips:
- Line break characters '\n\r'
- Non HTML tabs '\t'
- multiple spaces
- HTML comments '<!-- content -->'

Some have suggested that its not necessary to minify HTML if the page is using server-side compression (GZIP etc...)
This is "mostly" true. The HTML is really not the large load when viewing a page. Images and media generally are and to a lesser degree
stylesheets and scripts. And that the benefit isn't very great.

BUT, when the PHP file (resulting HTML) is compressed the file size IS larger without minification because the tabs and line-breaks etc
are characters that need to be compressed before downloading.

So, one could make the argument that every little bit helps. Just like there is an advantage to minifying CSS and JS files.

##Usage
In the subdirectory _/components/php find the working files 
To compress the output HTML in your browser navigate to the working directory
The program will output the compressed HTML to the root as index.html

###Multiple Files
Its possible to have compress multiple files to produce a traditional HTML document.
Simply add the following code to the head of any file in the working directory
Name the file whatever you want (as long as it has a PHP extension)
Navigate to the document in your browser and it will be added to the root with the file name.

<?php
        require_once('compress.php');
        $compress = new Compress(array(
            'filepath'=>$_SERVER['DOCUMENT_ROOT'].'/',
            'workurl'=>'http://192.168.1.154/_/components/php/', /* this is the path to your website or localhost */
            'devip'=>array('::1','192.168.1.157','192.168.1.154') /* this is a whitelist */
        ));
?>
    
##Other Workflow Suggestions
Generally I like to use Grunt www.gruntjs.com with SASS www.sass-lang.com to create and compress my stylesheets and javascript files.




