<?php

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

// Khởi tạo Dompdf
$dompdf = new Dompdf($options);

$name_customer = $info_invoice[0]['full_name'];
$email = $info_invoice[0]['email'];
$phone = $info_invoice[0]['phone'];
$date = $info_invoice[0]['hold_expiry'];
$showtime = date("H:i d/m/Y", strtotime($date));
$room_name = $info_invoice[0]['room_name'];
$total = number_format($info_invoice[0]['price'], 0, ',', '.') . ' VNĐ';
$cinema = $cinema[0]['cinema_name'];


$html = "<!DOCTYPE html>
<html lang='vi'>
<head>
    <meta charset='UTF-8'>
    <title>Vé Xem Phim Điện Tử</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 5px;
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
        img {
            width: 150px;
            border: 1px solid #000;
            border-radius: 10px;
            display: block;
            margin: 20px auto; /* Canh giữa hình ảnh */
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Để xóa khoảng cách giữa các ô */
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #1B11A1; /* Kẻ khung cho bảng */
            padding: 10px; /* Thêm khoảng cách bên trong ô */
            text-align: center; /* Canh giữa nội dung ô */
        }
        th {
            background-color: #e0e0e0; /* Màu nền cho hàng tiêu đề */
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>HOTFLIX</h1>
        <p style='text-align: center; margin-top:-30px'>$cinema</p>

        <hr>

        <h2>HÓA ĐƠN </h2>
        <div class='info'>
            <div><strong>Khách hàng:</strong> $name_customer</div>
            <div><strong>Email: </strong> $email</div>
            <div><strong>Số điện thoại: </strong> $phone</div>
            <div><strong>Số phòng: </strong>$room_name</div>
            <div><strong>Ngày xem: </strong> $showtime</div>


        </div>
        
       
        <table>
            <thead>
                <tr>
                    <th>Tên Mặt Hàng</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>";


foreach ($items as $item) {
    if (!empty($item['item_name'])) {
        $item_name =  $item['item_name'];
        $price  =  number_format($item['price'], 0, ',', '.') . ' VNĐ';
        $quantity = $item['quantity'];
        $sum =   number_format($item['quantity'] * $item['price'], 0, ',', '.') . ' VNĐ';
        $html .=
            "
                <tr>
                    <td>$item_name</td>
                    <td>$price</td>
                    <td>$quantity</td>
                    <td>$sum</td>
                </tr>
           ";
    }
}
$html .= "
            </tbody>
        </table>
        <p style='text-align: right;'><strong>Tiền phòng: </strong>2.000.000 VNĐ</p>
        <p style='text-align: right;'><strong>Tổng Tiền phòng và mặt hàng: </strong>$total</p>
        <p style='text-align: center; margin-top: 20px;'>Kính gửi quý khách hàng, Xin trân trọng cảm ơn quý khách đã lựa chọn sử dụng dịch vụ của công ty HOTFLIX Việt Nam.</p>
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