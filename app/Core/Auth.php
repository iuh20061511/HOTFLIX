<?php

/**
 * CUSTOMER - Khách hàng
 * CHAIN_MANAGER - Quản lý cụm rạp
 * CINEMA_MANAGER - Quản lý rạp phim
 * TICKET_CLERK - Nhân viên quầy vé
 * TICKET_CHECKER - Nhân viên soát vé
 * ADMIN - Quản trị viên
 */



$authenticated = [
    "Home/error_404"              =>      [CUSTOMER, CHAIN_MANAGER, CINEMA_MANAGER, TICKET_CLERK, TICKET_CHECKER, ADMIN],
    "Home/index"                  =>      [CUSTOMER, CHAIN_MANAGER, CINEMA_MANAGER, TICKET_CLERK, TICKET_CHECKER, ADMIN],
    "admin/dashboard/index"       =>      [CUSTOMER, CHAIN_MANAGER, CINEMA_MANAGER, TICKET_CLERK, TICKET_CHECKER, ADMIN],
    "admin/Showtime/addShowTime"  =>      [CINEMA_MANAGER]

];
