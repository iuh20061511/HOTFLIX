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
    $mail->Username = 'minhhuan190102@gmail.com';
    $mail->Password = 'vcho tlpc agae yome';

    $mail->setFrom('minhhuan190102@gmail.com', 'HOTFLIX');
    $email = $_SESSION['is_login']['email'];

    $mail->addAddress($email);


    $html = "
   
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>PDF Icon</title>
  <style>
      
      .pdf-icon {
          width: 160px;
          height: 200px;
          background-color: #3498db;
          border-radius: 12px;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          color: white;
          font-family: 'Arial', sans-serif;
          box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
          position: relative;
          transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

  
      .pdf-icon:hover {
          transform: translateY(-5px);
          box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      }

    
      .pdf-icon::before {
          content: '📄';
          font-size: 50px;
          margin-bottom: 20px;
      }

      .pdf-file-icon {
          font-size: 18px;
          font-weight: bold;
          text-transform: uppercase;
          letter-spacing: 1px;
      }


      .pdf-text {
          font-size: 14px;
          font-weight: 500;
          text-transform: uppercase;
          letter-spacing: 1px;
      }

      a {
          text-decoration: none;
          color: inherit;
      }
  </style>
</head>
<body>
  <div class='pdf-icon'>
    <a href='$invoice_url'>
      <div class='pdf-file-icon'></div>
      <div class='pdf-text'>Hóa đơn</div>
    </a>
  </div>
</body>
</html>


    ";




    $mail->isHTML(true);
    $mail->Subject = "HÓA ĐƠN ĐẶT PHÒNG";
    $mail->Body = $html;

    $mail->send();
} catch (Exception $e) {
    echo "<script>alert('Lỗi ! Email không được gửi');</script>";
}
