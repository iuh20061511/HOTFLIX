<?php

$routes['default_controller'] = 'home';


$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc/(.+)'] = 'news/category/$1';
$routes['tin-tuc/.+-(\d+).html'] = 'news/tin/$1';  ///tin-tuc/thetho-1.html
$routes['xep-hang/.+-(\d+).html'] = 'admin/auth/dashboard/new/$1';  ///tin-tuc/thetho-1.html



$routes['trang-chu.html'] = 'home';
$routes['dang-nhap.html'] = 'account/login';
$routes['dang-ki.html'] = 'account/register';
$routes['quen-mat-khau.html'] = 'account/forgot';







