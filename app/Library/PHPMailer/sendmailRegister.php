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
    $mail->addAddress($email);
    $link = _LINK;
    // Nội dung email
    $html = "
 <!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Email Confirmation</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
      color: #444;
      line-height: 1.6;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      animation: fadeIn 1s ease-in-out;
      background: #0b6567;
      border-radius: 10px;
    }
      .hot1 {
         color : #f807b7;
       }
     
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(-20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .card-header {
      background-color: #fff; /* Nền trắng */
      color: #007bff; /* Màu chữ để tương phản */
      padding: 20px;
      position: relative;
      display: flex;
      align-items: center; /* Căn giữa theo chiều dọc */
      justify-content: center; /* Căn giữa theo chiều ngang */
      border-bottom: 1px solid #e9ecef; /* Đường viền dưới để phân cách */
      height: 120px; /* Chiều cao cố định để logo và tiêu đề canh giữa */
    }
    .card-header img {
     width: 110px;
     height: 95px;
   
    }
    .card-header h2 {
      font-size: 24px;
      margin: 0;
      text-transform: uppercase;
      color: #444; /* Màu chữ cho tiêu đề */
      margin-left: 30%;
      margin-top: 25px;
    }
    .card-body {
      padding: 30px 20px;
      text-align: center;
    }
    .card-body p {
      margin-bottom: 20px;
      font-size: 16px;
      color: #555;
    }
    .card-body .btn {
      display: inline-block;
      padding: 12px 25px;
      background-color: #28a745;
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
      font-size: 16px;
      font-weight: bold;
      letter-spacing: 1px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .card-body .btn:hover {
      background-color: #218838;
      transform: translateY(-2px);
    }
    .card-body .btn:active {
      transform: translateY(0);
    }
    .card-body p.note {
      font-size: 14px;
      color: #888;
      margin-top: 20px;
    }
    .card-footer {
      background-color: #f8f9fa;
      text-align: center;
      padding: 10px;
      font-size: 14px;
      color: #6c757d;
      border-top: 1px solid #e9ecef;
    }
    
    @media (max-width: 600px) {
      .card-header h2 {
        font-size: 20px;
      }
      .card-body {
        padding: 20px;
      }
      .card-body .btn {
        padding: 10px 20px;
        font-size: 14px;
      }
    
    }
  </style>
</head>
<body>
  <div class='container'>
    <div class='card'>
      <div class='card-header'>
        <h2><span class='hot1'>HOTFLIX</span> CINEMA</h2>
      </div>
      <div class='card-body'>
        <p>Xin chào bạn!</p>
        <p>Chúng tôi đã nhận được yêu cầu tạo tài khoản của bạn. Để hoàn tất quá trình, vui lòng nhấp vào liên kết bên dưới:</p>
<a class='btn btn-primary' href='$link/xac-thuc-tai-khoan.html?token=$token' role='button'>Xác nhận tài khoản</a>
<p class='mt-3 text-muted'>Lưu ý: Liên kết này sẽ hết hạn trong vòng 24 giờ. Nếu bạn không yêu cầu tạo tài khoản, bạn có thể bỏ qua email này.</p>

      </div>
      <div class='card-footer'>
        &copy; 2024 HOTFLIX cinema All rights reserved.
      </div>
    </div>
  </div>
</body>
</html>




    ";

    $mail->isHTML(true);
    $mail->Subject = "Khôi phục mật khẩu";
    $mail->Body = $html;

    $mail->send();

} catch (Exception $e) {
    echo "<script>alert('Lỗi ! Email không được gửi');</script>";
}


?>