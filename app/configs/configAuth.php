<?php

/**
 * 1 là khác hàng
 * 2 quản lý cụm rạp
 * 3 quản lý rạp phim
 * 4 nhân viên quầy vé
 * 5 nhân viên soát vé
 * 6 quản trị viên
 */

const CUSTOMER = 1;
const CHAIN_MANAGER = 2;
const CINEMA_MANAGER = 3;
const TICKET_CLERK = 4;
const TICKET_CHECKER = 5;
const ADMIN = 6;


function authCheck($controller, $action)
{
    $auth = $controller . '/' . $action;
    $auth = strtolower($auth);

    require './app/Core/Auth.php';

    $isAuthorized = true;

    foreach ($authenticated as $page => $roles) {

        if ($auth === strtolower($page)) {
            if (!empty($_SESSION['is_login']['id_account'])) {
                $loginLevel = $_SESSION['is_login']['id_role'];
                if (!in_array($loginLevel, $roles)) {
                    $isAuthorized = false;
                    break;
                }
            } else {
                echo '<script>window.location.href = "dang-nhap.html";</script>';
                exit;
            }
        }
    }

    if (!$isAuthorized) {
        echo '<script>window.location.href = "404.html";</script>';
        exit;
    }
}
