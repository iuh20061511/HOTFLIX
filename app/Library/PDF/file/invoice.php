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
$id_ticket = $ticket[0]['id_ticket'];
$price = number_format($ticket[0]['price'], 0, ',', '.') . ' VNĐ';
$date = $ticket[1]['show_date'];
$timestamp = strtotime($date);
$date = date('d-m-Y', $timestamp);

$movie_name  = $ticket[1]['movie_name'];
$room_name  = strtoupper($ticket[1]['room_name']);
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
$format = $ticket[1]['projection_format'];



$cinema_name = strtoupper($ticket[2]['cinema_name']);
$cinema_address = $ticket[2]['address'];



$html = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
</head>
<style>

    body {
        width: 100%;
        height: 100vh;
        margin: 0;
        padding: 0;
        margin-left: 40px;
    }

    .center {
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
    }

    .ticket {
        width: 900px;
        height: 280px;
        background-color: rgb(241, 232, 207);
        position: relative;
        display: inline-block;
        vertical-align: top;
        border: 1px solid #ff55a5;
    }

    .left, .right {
        display: inline-block;
        vertical-align: top;
    }

    .left {
        width: 300px;
        height: 100%;
        position: relative;
        text-align: center;
    }

    .right {
        width: 585px;
        height: 100%;
        border-left: 4px dashed  black;
    }

    .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fff;
    }

    .circles {
        position: absolute;
        width: fit-content;
        height: 300px; /* Đặt chiều cao bằng chiều cao vé */
        top: 0;
        left: 286px;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .circle:first-child {
    margin-top: -25px;
    }

    .circle:last-child {
        margin-top: 250px;
    }

    .cut {
        width: 16px;
        height: 16px;
        background: #fff;
        border-radius: 50%;
        margin-bottom: 11px;
    }

    .cuts {
        position: absolute;
        top: 10px;
        left: -9px;
        width: fit-content;
        height: 280px;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .right .cuts {
        left: auto;
        right: -9px;
    }

    .ticket_main {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 100%;
    }

    .id_ticket,
    .seat {
        font-size: 15px;
        color: rgb(58, 48, 32);
    }

    .ticket_main img {
        width: 150px;
        height: auto;
        border: 0.5px solid rgb(92, 83, 54);
        border-radius: 8px;
        padding: 5px;
    }

    .content {
        width: 90%;
        height: 90%;
        border: 0.5mm solid rgb(92, 83, 54);
        box-sizing: border-box;
        margin-left: 40px;
        margin-top: 10px;
        border-radius: 1mm;
    }

    .top {
        text-align: center;
        font-size: 15px;
        margin-top: 0px;
        color: rgb(58, 48, 32);
    }

    .top .cinema {
        margin-top: 5px;
        margin-bottom: 0;
    }

    .bottom {
        display: flex;
        padding-left: 25px;
        margin-top: 0px;
    }

    .movie-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        padding-left: 25px;
        text-align: left;
        color: #ff55a5;
        font-style: italic;
        margin-top: 0px;
        padding-top: 0px;
    }

    .content-bt-left,
    .content-bt-right {
        width: 48%;
        display: inline-block;
        vertical-align: top;
    }

    .content-bt-left p,
    .content-bt-right p {
        margin: 5px 0;
        font-size: 12px;
        font-style: italic;
    }

    .bottom-content {
        display: flex;
        justify-content: space-between;
        /* Đặt hai cột cách đều */
    }

    .watermark {
        position: absolute;
        top: 15%;
        left: 600px;
        transform: rotate(-25deg) translate(-50%, -50%);
        font-size: 50px;
        font-weight: bold;
        color: rgba(0, 0, 0, 0.05);
        white-space: nowrap;
        z-index: 0;
    }
</style>

<body>
    <div class='center'>
        <div class='ticket'>
            <div class='left'>
                <div class='cuts'>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                </div>

                <div class='ticket_main'>
                    <p class='id_ticket' style='margin-bottom:8px; margin-top:0px; font-style: italic;'>NO ID: <span style='color:#ff55a5;font-weight: bold;font-size: 20px;'>$id_ticket</span></p>
                    <img src='$imageSrc' alt='qrcode'>
                    <p class='seat' style='margin-top:8px; margin-bottom:0px;font-style: italic;'>Ghế/Seat: <span style='color:#ff55a5;font-weight: bold;font-size: 20px;'>$seat</span></p>
                    <p class='seat' style='margin-top:0px; color:#ff55a5; font-weight: bold;font-size: 20px;'>$room_name</p>
                </div>
            </div>
            <div class='right'>
                <div class='watermark'>CINEMA TICKET</div>
                <div class='content'>
                    <div class='top'>
                        <h3 class='cinema'>HỆ THỐNG RẠP <span style='color:#ff55a5'>HOT</span><span style='color:rgb(120, 115, 115);'>FLIX</span></h3>
                        <h4 class='cinema' style='color:#ff55a5'>$cinema_name</h4>
                        <p style='text-align: center; font-size: 11px; padding-left: 40px; padding-right: 35px;'>$cinema_address</p>
                        <p class='movie-title'>$movie_name</p>
                    </div>
                    <div class='bottom'>
                            <div class='content-bt-left'>
                                <p>Ngày/Date: <span style='color:#ff55a5;font-weight: bold;'>$date</span></p>
                                <p>Thời lượng/Duration: <span style='color:#ff55a5;font-weight: bold;'>$duration phút</span></p>
                                <p>Định dạng/Format: <span style='color:#ff55a5;font-weight: bold;'>$format</span></p>
                            </div>
                            <div class='content-bt-right'>
                                <p>Suất/Show: <span style='color:#ff55a5;font-weight: bold;'>$start_time</span></p>
                                <p>Giá/Price: <span style='color:#ff55a5;font-weight: bold;'>$price </span></p>
                            </div>
                    </div>
                </div>
                <div class='cuts'>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                    <div class='cut'></div>
                </div>
            </div>

            <div class='circles'>
                <div class='circle'></div>
                <div class='circle'></div>
            </div>
        </div>
    </div>
</body>

</html>";


$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'landscape');

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