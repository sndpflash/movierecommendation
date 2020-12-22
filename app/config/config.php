<?php

//DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Apple123@');
define('DB_NAME', 'tmvc');

    //App Root
  //Gives path to the file  echo __FILE__;
//dirname(__FILE__) gives the parent folder in this case folder where config file is
//wrap it with one more dirname goes to one folder back which is app folder.

define('APPROOT', dirname(dirname(__FILE__)));

// URL Root

define('URLROOT', 'http://localhost/MVC');

// Site Name
define ('SITENAME', 'Movie Recommendation');



?>