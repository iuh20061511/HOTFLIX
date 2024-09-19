<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web = 'http://' . $_SERVER['HTTP_HOST'];
}

$_SESSION['login'] = 1;



$folder = str_replace((strtolower($_SERVER['DOCUMENT_ROOT'])), '', strtolower(str_replace('\\', '/', __DIR__)));

$link = $web . $folder;

define('_WEB', $web);

define('_LINK', $link);










require_once "./app/Bridge.php";
$myApp = new App();


require_once "./app/Core/Auth.php";

// authCheck($myApp);



?>