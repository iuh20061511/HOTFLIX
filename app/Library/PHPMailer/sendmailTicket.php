<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require __DIR__ . "/src/Exception.php";
require __DIR__ . "/src/PHPMailer.php";
require __DIR__ . "/src/SMTP.php";


$mail = new PHPMailer(true);
try {
    // Cấu hình server email
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->CharSet = "utf-8";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = 'minhhuan190102@gmail.com';                     //SMTP username
    $mail->Password = 'vcho tlpc agae yome';

    // Thiết lập thông tin người gửi và người nhận
    $mail->setFrom('minhhuan190102@gmail.com', 'HOTFLIX');
    $email = $_SESSION['is_login']['email'];

    $mail->addAddress($email);
    $link = _LINK;
    // Nội dung email
    // Nội dung email
    $html = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Your Tickets</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background: #f9f9f9;
                padding: 20px;
                border-radius: 8px;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
            }
            .header h1 {
                color: #2c3e50;
                margin: 0;
                padding: 0;
            }
            .ticket-container {
                background: #ffffff;
                border: 1px solid #e0e0e0;
                border-radius: 6px;
                padding: 15px;
                margin-bottom: 15px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .ticket-header {
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }
            .ticket-number {
                font-size: 14px;
                color: #666;
            }
            .download-button {
                display: inline-block;
                background-color: red;
                color: #fff !important;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 4px;
                margin-top: 10px;
            }
            .footer {
                margin-top: 30px;
                text-align: center;
                font-size: 12px;
                color: #666;
            }
            .download-invoice{
                 display: inline-block;
                background-color: #a87f32;
                color: #fff !important;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 4px;
                margin-botom: 10px;
                margin-left: 40%;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Vé của bạn</h1>
                <p>Cảm ơn bạn đã lựa chọn dịch vụ của chúng tôi</p>
            </div>
            <div>
             <a href='" . htmlspecialchars($invoice) . "' class='download-invoice'>
                    Tải hóa đơn
                </a>
            </div>
            ";


    // Loop through tickets
    foreach ($link_ticket as $index => $ticket) {
        $html .= "
            <div class='ticket-container'>
                <div class='ticket-header'>
                    <div class='ticket-number'>Ticket #" . ($index + 1) . "</div>
                </div>
                <a href='" . htmlspecialchars($ticket) . "' class='download-button'>
                    Tải vé
                </a>
            </div>";
    }

    $html .= "
            <div class='footer'>
                <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với nhóm hỗ trợ của chúng tôi.</p>
            </div>
        </div>
    </body>
    </html>";


    $mail->isHTML(true);
    $mail->Subject = "VÉ XEM PHIM";
    $mail->Body = $html;

    $mail->send();
} catch (Exception $e) {
    echo "<script>alert('Lỗi ! Email không được gửi');</script>";
}
