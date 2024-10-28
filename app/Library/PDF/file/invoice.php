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

$qrcode = $ticket[0]['qrcode'];
$imagePath = _WEB_ROOT . "/public/QR/image/$qrcode";
if (file_exists($imagePath)) {
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
} else {
    $imageSrc = '';
}

$imageData = base64_encode(file_get_contents($imagePath));
$imageSrc = 'data:image/jpeg;base64,' . $imageData;

$seat = $ticket[0]['location'];
$date = $ticket[1]['show_date'];
$timestamp = strtotime($date);
$date = date('d-m-Y', $timestamp);

$movie_name  = $ticket[1]['movie_name'];
$start_time  = $ticket[1]['start_time'];
$end_time  = $ticket[1]['end_time'];
$duration  = $ticket[1]['duration'];

$start_seconds = strtotime($start_time);
$end_seconds = strtotime($end_time);
$total_duration = $end_seconds - $start_seconds;
$average_start = $start_seconds + ($total_duration / 2);
$half_duration = ($duration * 60) / 2;

$average_start_time = date("H:i:s", $average_start - $half_duration);
$average_end_time = date("H:i:s", $average_start + $half_duration);

$start_time = substr($average_start_time, 0, 5);
$end_time = substr($average_end_time, 0, 5);



$cinema_name = $ticket[2]['cinema_name'];
$cinema_address = $ticket[2]['address'];


$html = "<html>
<head>
<meta charset='UTF-8'>
<title>Vé Xem Phim Điện Tử</title>
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
    }
    .container {
        max-width: 800px; /* Tăng chiều rộng tối đa cho container */
        margin: 0 auto;
        padding: 20px;
        margin-top: -50px;
    }
    h1, h2 {
        color: #1B11A1;
        text-align: center;
    }
    h2 {
        color: red;
    }
    hr {
        margin: 20px 0;
        border: 1px solid #1B11A1;
    }
    .info, .ticket-info {
        margin-bottom: 20px;
    }
    .info div, .ticket-info div {
        margin: 5px 0;
    }
    img{
        position: absolute;
        left:300px;
        padding:5px;
        width: 150px;
        border: 1px solid #000;
        border-radius:10px;
    }         
</style>
</head>
<body>
    <div class='container'>
        <h1>HOTFLIX</h1>
        <p style='text-align: center; margin-top:-30px'>Rạp chiếu phim HOTFLIX</p>
        <p style='text-align: center; margin-top:-20px'>$cinema_name</p>
        <hr>

        <h2>VÉ XEM PHIM</h2>
        <div class='info'>
            <div><strong>Địa chỉ:</strong> $cinema_address</div>
            <div><strong>Ngày chiếu: </strong>$date</div>
            <div><strong>Tên phim: </strong> $movie_name</div>
            <div><strong>Suất chiếu: </strong>$start_time  - $end_time </div>
            <div><strong>Thời lượng phim: </strong> $duration phút</div>
            <div><strong>Số ghế: </strong>$seat</div>

        </div>
        <p style='text-align:center'>--------------------------------------------------------------------------------------------</p>
          <img src='$imageSrc' alt=''>
          <p style='margin-top:200px'>  Kính gửi quý khách hàng, Xin trân trọng cảm ơn quý khách đã lựa chọn sử dụng dịch vụ của công ty HOTFLIX Việt Nam.</p>
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