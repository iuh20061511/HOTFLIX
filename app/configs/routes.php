<?php

$routes['default_controller'] = 'Home';



$routes['trang-chu.html'] = 'Home';
$routes['chi-tiet-phim-(.+).html'] = 'Home/movieDetail/$1';
$routes['thong-tin-rap-(.+).html'] = 'Home/cinemaDetail/$1';
$routes['khuyen-mai.html'] = 'Home/promotion/';
$routes['dang-nhap.html'] = 'Account/login';
$routes['dang-xuat.html'] = 'Account/logout';
$routes['dang-ki.html'] = 'Account/register';
$routes['quen-mat-khau.html'] = 'Account/forgot';
$routes['dat-lai-mat-khau.html'] = "Account/reset";
$routes['xac-thuc-tai-khoan.html'] = "Account/verify";
$routes['thong-tin-tai-khoan.html'] = "client/InforUser/profileInfo";
$routes['lich-su-giao-dich.html'] = "client/InforUser/transaction";
$routes['danh-sach-qua.html'] = "client/InforUser/getlistmygift";
//ADMIN
//--USER
$routes['quan-ly.html'] = 'admin/Dashboard';
$routes['quan-ly-tai-khoan.html'] = 'admin/Users';
$routes['them-tai-khoan.html'] = 'admin/Users/addNewStaff';
$routes['cap-nhat-tai-khoan-(.+).html'] = 'admin/Users/updateStaff/$1';
$routes['xoa-tai-khoan.html'] = 'admin/Users/deleteStaff';
$routes['danh-sach-thanh-vien.html'] = 'admin/Users/listMembers';



//--Cinema
$routes['quan-ly-rap-phim.html'] = 'admin/Cinemas';
$routes['them-rap-phim.html'] = 'admin/Cinemas/addNewCinema';
$routes['cap-nhat-rap-phim-(.+).html'] = 'admin/Cinemas/updateCinema/$1';
$routes['xoa-rap-phim.html'] = 'admin/Cinemas/deleteCinema';
$routes['them-phong-chieu.html'] = 'admin/Cinemas/addNewRoomForCinema';
$routes['cap-nhat-phong-chieu-(.+).html'] = 'admin/Cinemas/updateRoomForCinema/$1';
$routes['xoa-phong-chieu.html'] = 'admin/Cinemas/deleteRooomForCinema';
//Movies
$routes['quan-ly-phim.html'] = 'admin/Movies';
$routes['them-bo-phim.html'] = 'admin/Movies/addNewMovie';
$routes['cap-nhat-phim-(.+).html'] = 'admin/Movies/updateMovie/$1';
$routes['xoa-bo-phim.html'] = 'admin/Movies/deleteMovie';
//ShowTimes
$routes['quan-ly-suat-chieu.html'] = 'admin/Showtime/addShowTime';
$routes['xoa-suat-chieu-(.+).html'] = 'admin/Showtime/deleteShowTime/$1';


//Menu_items

$routes['quan-ly-bap-nuoc.html'] = 'admin/Menu_Items ';
$routes['them-bap-nuoc.html'] = 'admin/Menu_Items /addNewItem';
$routes['cap-nhat-bap-nuoc-(.+).html'] = 'admin/Menu_Items /updateItem/$1';
$routes['xoa-bap-nuoc.html'] = 'admin/Menu_Items /deleteItem';

//Voucher
$routes['quan-ly-voucher.html'] = 'admin/Voucher';
$routes['them-voucher.html'] = 'admin/Voucher/addNewVoucher';
$routes['xoa-voucher.html'] = 'admin/Voucher/deleteVoucher';
$routes['cap-nhat-voucher-(.+).html'] = 'admin/Voucher/updateVoucher/$1';
$routes['quan-ly-qua-tang.html'] = 'admin/Voucher/listGift';
$routes['them-qua-tang.html'] = 'admin/Voucher/addNewGift';
$routes['xoa-qua-tang.html'] = 'admin/Voucher/deleteGift';

//đặt vé
$routes['dat-ve-(.+).html']  = 'client/BookTickets/book/$1';
$routes['chon-ghe-(.+).html'] = 'client/BookTickets/selectSeat/$1';
$routes['chon-thuc-an.html'] = 'client/BookTickets/chooseFood';
$routes['thanh-toan.html'] = 'client/BookTickets/proceedPay';
$routes['thanh-toan-thanh-cong.html'] = 'client/BookTickets/success';
$routes['pay.html'] = 'client/BookTickets/pay';
$routes['pay-.html'] = 'client/BookTickets/backPay';

$routes['kiem-tra-ve-(.+)-(.+).html'] = 'client/BookTickets/QR/$1/$2';
$routes['ve-da-dat-(.+).html'] = 'client/BookTickets/PDF/$1/';
$routes['dat-ve.html']  = 'client/BookTickets/book_ticket';
$routes['hoa-don-(.+).html']  = 'client/BookTickets/PDFTotalInvoice/$1';

$routes['chon-thuc-an-.html'] = 'client/BookTickets/backChooseFood';

$routes['huy-ghe.html'] = 'client/BookTickets/cancelSeat';

$routes['thue-phong-nhom-(.+).html'] = 'client/BookTickets/bookPrivateRoom/$1';
$routes['chon-thuc-an-phong-nhom.html'] = 'client/BookTickets/chooseFoodForPrivate';
$routes['chon-thoi-gian-dat-phong.html'] = 'client/BookTickets/chooseTimeRoomPrivate';
$routes['thanh-toan-phong-nhom.html'] = 'client/BookTickets/payRoomPrivate';
$routes['check-ttoan-pnhom.html'] = 'client/BookTickets/checkPayRoomPrivate';
$routes['thanh-toan-phong-thanh-cong.html'] = 'client/BookTickets/PaySucessRoomPrivate';
$routes['hoa-don-phong-rieng-(.+).html'] = 'client/BookTickets/PDFTotalInvoicePrivate/$1';

$routes['vnpay-phong-ca-nhan.html'] = 'client/BookTickets/VNPayRoomPrivate';


//Rent_Room
$routes['thue-phong/chon-rap-phong-chieu.html'] = 'book_room/Rent_room';
$routes['thue-phong/chon-khung-gio-thue.html'] = 'book_room/Rent_room/chooseTime_room';
$routes['hoa-don-dat-phong-(.+).html'] = 'book_room/Rent_room/PDF/$1/';


//errror
$routes['404.html'] = 'home/error_404';
///
$routes['thue-phong/chon-rap-phong-chieu.html'] = 'client/Rent_room';
$routes['thue-phong/chon-khung-gio-thue.html'] = 'client/Rent_room/chooseTime_room';
$routes['hoa-don-dat-phong-(.+).html'] = 'client/Rent_room/PDF/$1/';
$routes['thanh-toan-hoa-don-thanh-cong.html'] = 'client/Rent_room/paySuccessRoom';

//Tra cứu thông tin
$routes['tra-cuu-ve.html'] = 'admin/Search';
$routes['in-ve-(.+).html'] = 'client/BookTickets/PDFInvoiceDetails/$1';


//Vòng quay may mắn
$routes['vong-quay-may-man.html'] = 'client/LuckyWheel';
$routes['doi-qua.html'] = 'client/ExchangeGifts';

//Đổi suất chiếu
$routes['doi-suat-chieu.html'] = 'client/ChangeTickets/selectSeat';
$routes['xu-ly-doi-suat-chieu.html'] = 'client/ChangeTickets/handleShowTime';


//Bán vé tại quầy
$routes['ban-ve.html'] = 'admin/SalesIn​Counter';
$routes['in-ve-tai-quay-(.+).html'] = 'client/BookTickets/PDFInvoice_sales_staff/$1';
