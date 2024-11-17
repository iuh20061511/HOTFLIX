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


function authCheck($app)
{
    $auth = $app->urlCheck . '/' . $app->action;
    $auth = strtolower($auth);



    require './app/Core/Auth.php';

    $unauthenticated = [
        "Home/index",
        "Home/error_404",
        "home/movieDetail",
        "account/login",
        "account/register",
        "account/forgot",
        "account/reset",
        "account/verify",
        "client/BookTickets/book",
        "client/BookTickets/book_ticket"
    ];
    $isAuthorized = false;
    if (!empty($_SESSION['is_login']['id_account'])) {

        $loginLevel = $_SESSION['is_login']['id_role'];
        foreach ($authenticated as $page => $roles) {
            if ($auth == strtolower($page) && in_array($loginLevel, $roles)) {
                $isAuthorized = true;
            }
        }

        if (!$isAuthorized) {
            if (in_array(strtolower($auth), array_map('strtolower', $unauthenticated))) {
                $isAuthorized = true;
            }
        }

        if (!$isAuthorized) {
            echo '<script>window.location.href = "404.html";</script>';
        }
    } elseif (in_array(strtolower($auth), array_map('strtolower', $unauthenticated))) {
        $isAuthorized = true;
    } else {
        echo '<script>window.location.href = "dang-nhap.html";</script>';
    }
}
