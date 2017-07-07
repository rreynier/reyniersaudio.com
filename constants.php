<?php

switch ($_SERVER['SERVER_NAME']) {

    case 'wouter.reyniersaudio.local':
    case 'roeland.reyniersaudio.local':
        define('ROOT', '');
        define('RA_DB_SERVER', 'localhost');
        define('RA_DB_USER', 'root');
        define('RA_DB_PASSWORD', ‘redacted’);
        define('RA_DB_NAME', 'reyniersaudio');

        define('BLOG_DB_NAME', 'reyniersaudioblog');
        define('BLOG_DB_USER', 'root');
        define('BLOG_DB_PASSWORD', ‘redacted’);
        define('BLOG_DB_SERVER', 'localhost');
        break;
    
    case 'reyniersaudio.local':
    case 'test-server-2.bythepixel.com':
        define('ROOT', '');
        define('RA_DB_SERVER', 'localhost');
        define('RA_DB_USER', 'root');
        define('RA_DB_PASSWORD', ‘redacted’);
        define('RA_DB_NAME', 'reyniersaudio');

        define('BLOG_DB_NAME', 'reyniersaudioblog');
        define('BLOG_DB_USER', 'root');
        define('BLOG_DB_PASSWORD', ‘redacted’);
        define('BLOG_DB_SERVER', 'localhost');
        break;    

    case 'reyniersaudio.com':
    case 'www.reyniersaudio.com':
        define('ROOT', '/srv/www/reyniersaudio.com/public_html/');
        define('RA_DB_SERVER', 'localhost');
        define('RA_DB_USER', ‘redacted’);
        define('RA_DB_PASSWORD', ‘redacted’);
        define('RA_DB_NAME', ‘redacted’);
        define('BLOG_DB_NAME', ‘redacted’);
        define('BLOG_DB_USER', ‘redacted’);
        define('BLOG_DB_PASSWORD', ‘redacted’);
        define('BLOG_DB_SERVER', 'localhost');
        break;
}

define('FORM_TO_EMAIL', 'wouter@reyniersaudio.com');