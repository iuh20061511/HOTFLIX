<?php

// function authCheck($app)
// {
//     $auth = $app->urlCheck . '/' . $app->action;


//     $validPaths = [
//         "admin/auth/Dashboard/pages" => [1, 2, 3],
//         "admin/auth/Dashboard/new" => [1, 2, 3],

//     ];

//     if (isset($_SESSION['login'])) {
//         $loginLevel = $_SESSION['login'];
//         if ($app->urlCheck != 'Errors') {

//             if (isset($validPaths[$auth]) && in_array($loginLevel, $validPaths[$auth])) {
//                 $check = true;
//             } else {
//                 header('Location: ' . _LINK . '/Errors/error403');
//                 exit();
//             }
//         }
//     }
// }