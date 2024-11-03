<?php

$routes['default_controller'] = 'home';


$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc/(.+)'] = 'news/category/$1';
$routes['tin-tuc/.+-(\d+).html'] = 'news/tin/$1';  ///tin-tuc/thetho-1.html
$routes['xep-hang/.+-(\d+).html'] = 'admin/auth/dashboard/new/$1';  ///tin-tuc/thetho-1.html



$routes['trang-chu.html'] = 'home';
$routes['chi-tiet-phim-(.+).html'] = 'home/movieDetail/$1';
$routes['thong-tin-rap-(.+).html'] = 'home/cinemaDetail/$1';
$routes['khuyen-mai.html'] = 'home/promotion/';
$routes['dang-nhap.html'] = 'account/login';
$routes['dang-ki.html'] = 'account/register';
$routes['quen-mat-khau.html'] = 'account/forgot';
$routes['dat-lai-mat-khau.html'] = "account/reset";
$routes['xac-thuc-tai-khoan.html'] = "account/verify";
$routes['thong-tin-tai-khoan.html'] = "account/profileInfo";
$routes['lich-su-giao-dich.html'] = "account/transaction";
//ADMIN
//--USER
$routes['quan-ly.html'] = 'admin/dashboard';
$routes['quan-ly-tai-khoan.html'] = 'admin/users';
$routes['them-tai-khoan.html'] = 'admin/users/addNewStaff';
$routes['cap-nhat-tai-khoan-(.+).html'] = 'admin/users/updateStaff/$1';
$routes['xoa-tai-khoan.html'] = 'admin/users/deleteStaff';
$routes['danh-sach-thanh-vien.html'] = 'admin/users/listMembers';



//--Cinema
$routes['quan-ly-rap-phim.html'] = 'admin/cinemas';
$routes['them-rap-phim.html'] = 'admin/cinemas/addNewCinema';
$routes['cap-nhat-rap-phim-(.+).html'] = 'admin/cinemas/updateCinema/$1';
$routes['xoa-rap-phim.html'] = 'admin/cinemas/deleteCinema';
$routes['them-phong-chieu.html'] = 'admin/cinemas/addNewRoomForCinema';
$routes['cap-nhat-phong-chieu-(.+).html'] = 'admin/cinemas/updateRoomForCinema/$1';
$routes['xoa-phong-chieu.html'] = 'admin/cinemas/deleteRooomForCinema';
//Movies
$routes['quan-ly-phim.html'] = 'admin/movies';
$routes['them-bo-phim.html'] = 'admin/movies/addNewMovie';
$routes['cap-nhat-phim-(.+).html'] = 'admin/movies/updateMovie/$1';
$routes['xoa-bo-phim.html'] = 'admin/movies/deleteMovie';
//ShowTimes
$routes['quan-ly-suat-chieu.html'] = 'admin/Showtime/addShowTime';
$routes['xoa-suat-chieu-(.+).html'] = 'admin/Showtime/deleteShowTime/$1';


//Menu_items
$routes['quan-ly-bap-nuoc.html'] = 'admin/menu_items';
$routes['them-bap-nuoc.html'] = 'admin/menu_items/addNewItem';
$routes['cap-nhat-bap-nuoc-(.+).html'] = 'admin/menu_items/updateItem/$1';
$routes['xoa-bap-nuoc.html'] = 'admin/menu_items/deleteItem';

//Voucher
$routes['quan-ly-voucher.html'] = 'admin/voucher';
$routes['them-voucher.html'] = 'admin/voucher/addNewVoucher';
$routes['xoa-voucher.html'] = 'admin/voucher/deleteVoucher';
$routes['cap-nhat-voucher-(.+).html'] = 'admin/voucher/updateVoucher/$1';
$routes['quan-ly-qua-tang.html'] = 'admin/voucher/listGift';
$routes['them-qua-tang.html'] = 'admin/voucher/addNewGift';
$routes['xoa-qua-tang.html'] = 'admin/voucher/deleteGift';

//đặt vé
$routes['dat-ve-(.+).html']  = 'client/BookTickets/book/$1';
$routes['chon-ghe.html'] = 'client/BookTickets/selectSeat';
$routes['chon-thuc-an.html'] = 'client/BookTickets/chooseFood';
$routes['thanh-toan.html'] = 'client/BookTickets/proceedPay';
$routes['thanh-toan-thanh-cong.html'] = 'client/BookTickets/success';
$routes['pay.html'] = 'client/BookTickets/pay';
$routes['kiem-tra-ve-(.+)-(.+).html'] = 'client/BookTickets/QR/$1/$2';
$routes['ve-da-dat-(.+).html'] = 'client/BookTickets/PDF/$1/';
$routes['dat-ve.html']  = 'client/BookTickets/book_ticket';
$routes['hoa-don-(.+).html']  = 'client/BookTickets/PDFTotalInvoice/$1';





//Rent_Room
$routes['thue-phong/chon-rap-phong-chieu.html'] = 'book_room/rent_room';
$routes['thue-phong/chon-khung-gio-thue.html'] = 'book_room/rent_room/chooseTime_room';
$routes['hoa-don-dat-phong-(.+).html'] = 'book_room/rent_room/PDF/$1/';
