<?php



$folder = str_replace((strtolower($_SERVER['DOCUMENT_ROOT'])), '', strtolower(str_replace('\\', '/', __DIR__)));

$web_root = _WEB . $folder;

define('_WEB_ROOT', $web_root);



require_once "./app/configs/routes.php";

require_once "./app/Core/Route.php";


require_once "./app/Core/App.php";



require_once "./app/Core/Auth.php";

require_once "./app/Core/Database.php";

require_once "./app/Core/Model.php";

require_once "./app/Core/ValidateCheck.php";

require_once "./app/Core/Validates.php";


require_once "./app/Core/Controller.php";


