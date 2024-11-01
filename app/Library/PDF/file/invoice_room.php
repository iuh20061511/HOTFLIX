<?php

use Dompdf\Dompdf;
use Dompdf\Options;

// Thiết lập tùy chọn cho Dompdf
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

// Khởi tạo Dompdf
$dompdf = new Dompdf($options);

$imagePath = _WEB_ROOT . "/public/assets/img/daumoc.jpg";
if (file_exists($imagePath)) {
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
} else {
    $imageSrc = '';
}

$imageData = base64_encode(file_get_contents($imagePath));
$imageSrc = 'data:image/jpeg;base64,' . $imageData;

$customerFullname = $invoiceRoom[2]['full_name'];
$phone = $invoiceRoom[2]['phone'];
$company = $invoiceRoom[0]['company'];
if(empty($company)){
    $company = 'Không có';
}
$service = $invoiceRoom[0]['service'];
$note = $invoiceRoom[0]['note'];
$transactionDate = $invoiceRoom[0]['create_date'];
$timestamp = strtotime($transactionDate);
$transactionDate = date('d-m-Y', $timestamp);
$final_total = number_format($invoiceRoom[0]['final_total']);

$cinema  = $invoiceRoom[1]['cinema_name'];
$address  = $invoiceRoom[1]['address'];
$rentDate =  $invoiceRoom[0]['date_rent'];
$timestamp = strtotime($rentDate);
$rentDate = date('d-m-Y', $timestamp);

$room = $invoiceRoom[0]['room_name'];
$roomType = $invoiceRoom[0]['RoomType_name'];
$number_seat = $invoiceRoom[0]['number_seat'];
$start_time  = $invoiceRoom[0]['start_time'];
$end_time  = $invoiceRoom[0]['end_time'];

function format24HourWithAMPM($time) {
    $hour = (int)substr($time, 0, 2);
    $minute = substr($time, 3, 2);
    $suffix = $hour < 12 ? 'AM' : 'PM';
    return sprintf('%02d:%s%s', $hour, $minute, $suffix);
}
// Áp dụng định dạng cho cả start_time và end_time
$start_time_formatted = format24HourWithAMPM($start_time);
$end_time_formatted = format24HourWithAMPM($end_time);
$time_range = "$start_time_formatted - $end_time_formatted";

$html = "<html>
<head>
<meta charset='UTF-8'>
<title>Vé Xem Thuê Phòng Rạp Điện Tử</title>
<style>
    /* Reset margins and set full height */
    body,
    html {
        overflow: hidden;
        font-family: DejaVu Sans, sans-serif;
    }

    /* General container styling */
    .container {
        max-width: 800px;
        margin: 10px auto;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Header and main title */
    h1 {
        color: #1B11A1;
        text-align: center;
        margin-bottom: 0;
    }

    h2 {
        color: red;
        text-align: center;
        margin-top: 5px;
    }

    /* Divider styling */
    hr {
        margin: 20px 0;
        border: 1px solid #1B11A1;
    }

    /* Section for rental information */
    .info-rent,
    .info-left,
    .info-right {
        margin-bottom: 20px;
    }

    /* Align left and right columns */
    .info-left,
    .info-right {
        display: inline-block;
        vertical-align: top;
        width: 48%;
    }

    /* Styling each section */
    .info-rent div,
    .info-left div,
    .info-right div {
        margin: 5px 0;
    }

    /* Footer section with alignment to the right */
    .footer {
        text-align: right;
        margin-top: 20px;
        margin-right: 20px;
    }

    /* Specific styling for confirmation and seal on the right */
    .confirmation {
        display: inline-block;
        text-align: right;
    }

    /* Image styling */
    .confirmation img {
        display: block;
        margin-top: 10px;
        width: 120px;
    }

    /* Thank you message */
    .thank-you {
        text-align: center;
        margin-top: 50px;
        font-size: 14px;
        color: #333;
    }
</style>
</head>
<body>
    <div class='container'>
        <!-- Main title and subtitle -->
        <h1 style='margin-bottom: 20px;'>HOTFLIX</h1>
        <p style='text-align: center; margin-top: -20px;'>Rạp chiếu phim HOTFLIX</p>
        <hr>

        <!-- Ticket title -->
        <h2>PHIẾU THUÊ PHÒNG</h2>

        <!-- Rental Information Section -->
        <div class='info-rent'>
            <div><strong>Họ tên người thuê:</strong> $customerFullname</div>
            <div><strong>Số điện thoại:</strong> $phone</div>
            <div><strong>Tên công ty (nếu có):</strong> $company</div>
            <div><strong>Mục đích thuê:</strong> $service</div>
            <div><strong>Ghi chú (nếu có):</strong> $note</div>
            <div><strong>Ngày giao dịch:</strong> $transactionDate</div>
            <div><strong>Tổng tiền thanh toán:</strong> $final_total VND</div>
        </div>
        <hr>

        <!-- Left and Right Information Section -->
        <div class='info-left'>
            <div><strong>Tên rạp:</strong> $cinema</div>
            <div><strong>Địa chỉ:</strong> $address</div>
            <div><strong>Ngày cho thuê:</strong> $rentDate</div>
        </div>
        <div class='info-right'>
            <div><strong>Tên phòng:</strong> $room</div>
            <div><strong>Loại phòng:</strong> $roomType</div>
            <div><strong>Số lượng ghế:</strong> $number_seat</div>
            <div><strong>Thời gian thuê:</strong> $time_range</div>
        </div>
        <hr>

        <!-- Confirmation Footer with Seal aligned to the right -->
        <div class='footer'>
            <div class='confirmation'>
                <div><strong>Xác nhận thuê:</strong></div>
                <img src='$imageSrc' alt='con dấu mộc'>
            </div>
        </div>

        <!-- Thank you note -->
        <p class='thank-you'>
            Kính gửi quý khách hàng, xin trân trọng cảm ơn quý khách đã lựa chọn sử dụng dịch vụ của công ty HOTFLIX
            Việt Nam.
        </p>
    </div>
</body>
</html>";


$dompdf->loadHtml($html, 'UTF-8');

$dompdf->render();

$pdfContent = $dompdf->output();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview PDF</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        iframe {
            border: none;
            width: 100%;
            height: 100%;

        }
    </style>
</head>

<body>
    <iframe src="data:application/pdf;base64,<?= base64_encode($pdfContent); ?>"></iframe>

</body>

</html>