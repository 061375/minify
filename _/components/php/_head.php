<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width">
<meta name="robots" content="INDEX,FOLLOW" />
<meta name="description" content="Demonstration on how one might use this PHP Minify Script" />
<meta name="keywords" content="minify, php, grunt, javascript, uglify, sass, css" />
<meta name="ICBM" content="33.9798378,-117.3801188,15z" /> 
<meta name="city" content="Redlands" /> 
<meta name="country" content="United States (USA)" /> 
<meta name="state" content="CA" /> 
<meta name="zip code" content="92373" />
<link rel="apple-touch-icon" sizes="57x57" href="/_/favicons/apple-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="60x60" href="/_/favicons/apple-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="72x72" href="/_/favicons/apple-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="/_/favicons/apple-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/_/favicons/apple-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="/_/favicons/apple-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="/_/favicons/apple-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="/_/favicons/apple-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/_/favicons/apple-icon-180x180.png" />
<link rel="icon" type="image/png" sizes="192x192"  href="/_/favicons/android-icon-192x192.png" />
<link rel="icon" type="image/png" sizes="32x32" href="/_/favicons/favicon-32x32.png" />
<link rel="icon" type="image/png" sizes="96x96" href="/_/favicons/favicon-96x96.png" />
<link rel="icon" type="image/png" sizes="16x16" href="/_/favicons/favicon-16x16.png" />
<link rel="manifest" href="/_/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff" />
<meta name="msapplication-TileImage" content="/_/favicons/ms-icon-144x144.png" />
<meta name="theme-color" content="#ffffff" />
<link type="text/plain" rel="author" href="/humans.txt" />
<meta property="og:image" content="/_/images/screenshot.jpg"/>
<link rel="stylesheet" href="/_/css/style.css?c=<?php echo strtotime('now'); ?>" />
<?php
    $compress->script(
        '/var/www/html/dev/minify/_/components/js'
        ,'/_/components/js',
        '/_/js/script.js',
        array('/_/jquery.js'));
?>
