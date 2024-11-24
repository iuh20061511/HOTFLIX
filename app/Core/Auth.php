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
    //Home
    "Home/error_404"              =>      [CUSTOMER, CHAIN_MANAGER, CINEMA_MANAGER, TICKET_CLERK, TICKET_CHECKER, ADMIN],
    "Home/index"                  =>      [CUSTOMER, CHAIN_MANAGER, CINEMA_MANAGER, TICKET_CLERK, TICKET_CHECKER, ADMIN],
    //Dashboard
    "admin/dashboard/index"       =>      [CUSTOMER, CHAIN_MANAGER, CINEMA_MANAGER, TICKET_CLERK, TICKET_CHECKER, ADMIN],
    //Cinemas
    "admin/Cinemas/index"                 =>      [CHAIN_MANAGER, CINEMA_MANAGER, ADMIN],
    "admin/Cinemas/addNewCinema"          =>      [CHAIN_MANAGER, ADMIN],
    "admin/Cinemas/updateCinema"          =>      [CHAIN_MANAGER, ADMIN],
    "admin/Cinemas/deleteCinema"          =>      [CHAIN_MANAGER, ADMIN],
    "admin/Cinemas/addNewRoomForCinema"   =>      [CHAIN_MANAGER, ADMIN],
    "admin/Cinemas/updateRoomForCinema"   =>      [CHAIN_MANAGER, ADMIN],
    "admin/Cinemas/deleteRooomForCinema"  =>      [CHAIN_MANAGER, ADMIN],
    //Movies
    "admin/Movies/index"                  =>      [CHAIN_MANAGER, CINEMA_MANAGER, ADMIN],
    "admin/Movies/addNewMovie"            =>      [CHAIN_MANAGER, ADMIN],
    "admin/Movies/updateMovie"            =>      [CHAIN_MANAGER, ADMIN],
    "admin/Movies/deleteMovie"            =>      [CHAIN_MANAGER, ADMIN],
    //Menu_Items
    "admin/Menu_Items/index"              =>      [CHAIN_MANAGER, CINEMA_MANAGER, ADMIN],
    "admin/Menu_Items/addNewItem"         =>      [CHAIN_MANAGER, ADMIN],
    "admin/Menu_Items/updateItem"         =>      [CHAIN_MANAGER, ADMIN],
    "admin/Menu_Items/deleteItem"         =>      [CHAIN_MANAGER, ADMIN],
    //Showtime
    "admin/Showtime/addShowTime"          =>      [CINEMA_MANAGER],
    "admin/Showtime/deleteShowTime"       =>      [CINEMA_MANAGER],
    //User
    "admin/Users/index"                   =>      [CHAIN_MANAGER, ADMIN],
    "admin/Users/listMembers"             =>      [CHAIN_MANAGER, ADMIN],
    "admin/Users/addNewStaff"             =>      [ADMIN],
    "admin/Users/updateStaff"             =>      [ADMIN],
    "admin/Users/deleteStaff"             =>      [ADMIN],
    //Voucher & Gift
    "admin/Voucher/index"                 =>      [CHAIN_MANAGER],
    "admin/Voucher/addNewVoucher"         =>      [CHAIN_MANAGER],
    "admin/Voucher/deleteVoucher"         =>      [CHAIN_MANAGER],
    "admin/Voucher/updateVoucher"         =>      [CHAIN_MANAGER],
    "admin/Voucher/listGift"              =>      [CHAIN_MANAGER],
    "admin/Voucher/addNewGift"            =>      [CHAIN_MANAGER],
    "admin/Voucher/deleteGift"            =>      [CHAIN_MANAGER],
    //Search
    "admin/Search/index"                  =>      [TICKET_CLERK],
    "admin/Search/approve"                =>      [TICKET_CLERK],

    //Client/BookTickets
    "client/BookTickets/book"             => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/selectSeat"       => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/chooseFood"       => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/backChooseFood"   => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/pay"              => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/backPay"          => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/cancelSeat"       => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/proceedPay"       => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/success"          => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/QR"               => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/PDF"              => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/PDFTotalInvoice"  => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/PDFInvoiceDetails"=> [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/book_ticket"      => [CUSTOMER,TICKET_CLERK],
    "client/BookTickets/chooseTimeRoomPrivate" => [CUSTOMER],
    "client/BookTickets/bookPrivateRoom"       => [CUSTOMER],
    "client/BookTickets/chooseFoodForPrivate"  => [CUSTOMER],
    "client/BookTickets/payRoomPrivate"        => [CUSTOMER],
    "client/BookTickets/checkPayRoomPrivate"   => [CUSTOMER],
    "client/BookTickets/PaySucessRoomPrivate"  => [CUSTOMER],
    "client/BookTickets/PDFTotalInvoicePrivate"=> [CUSTOMER],

    //Client/RentRoooms
    "client/Rent_room/index"             => [CUSTOMER],
    "client/Rent_room/chooseTime_room"   => [CUSTOMER],
    "client/Rent_room/paySuccessRoom"    => [CUSTOMER],
    "client/Rent_room/PDF"               => [CUSTOMER],

    //Client/LuckyWheel
    "client/LuckyWheel/index" => [CUSTOMER],
    "client/LuckyWheel/spin" => [CUSTOMER],
    //Client/Exchange Gifts
    "client/ExchangeGifts/index" => [CUSTOMER],
    //Client/ChangeTickets
    "client/ChangeTickets/selectSeat" => [CUSTOMER],
    "client/ChangeTickets/handleShowTime" => [CUSTOMER],
    //InforUser
    "client/InforUser/profileInfo" => [CUSTOMER, CHAIN_MANAGER, CINEMA_MANAGER, TICKET_CLERK, TICKET_CHECKER, ADMIN],
    "client/InforUser/transaction" => [CUSTOMER],
    "client/InforUser/getShowtimeList" => [CUSTOMER],
    "client/InforUser/getListMyGift" => [CUSTOMER],




];
