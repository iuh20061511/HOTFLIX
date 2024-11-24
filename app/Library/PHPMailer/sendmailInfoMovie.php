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


  foreach ($infoShow as $email => $info) {
    $mail->addAddress($email);


    $html = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Lịch Chiếu Phim Tuần Này</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f2f5;
                    color: #333;
                    line-height: 1.6;
                }
                .container {
                    max-width: 1000px;
                    margin: 30px auto;
                    padding: 20px;
                }
                .title {
                    text-align: center;
                    font-size: 28px;
                    margin-bottom: 30px;
                    color: #007bff;
                    font-weight: bold;
                }
                .movie-card {
                    background-color: #fff;
                    border-radius: 10px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    margin-bottom: 20px;
                    padding: 20px;
                    transition: transform 0.2s;
                }
                .movie-card:hover {
                    transform: translateY(-5px);
                }
                .movie-title {
                    font-size: 24px;
                    color: #333;
                    margin-bottom: 15px;
                    font-weight: bold;
                }
                .theater-info {
                    font-size: 18px;
                    color: #0056b3;
                    margin-bottom: 10px;
                    font-weight: bold;
                }
                .day-card {
                    background-color: #e9ecef;
                    border-radius: 8px;
                    padding: 15px;
                    margin: 10px 0;
                }
                .day-title {
                    font-size: 20px;
                    color: #0056b3;
                    margin-bottom: 10px;
                    font-weight: bold;
                }
                .time-slots {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 10px;
                }
                .time {
                    display: inline-block;
                    padding: 10px 15px;
                    background-color: #007bff;
                    color: #fff;
                    border-radius: 5px;
                    font-size: 16px;
                    margin: 4px;
                    transition: background-color 0.3s;
                }
                .time:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2 class='title'>Lịch Chiếu Phim Tuần Này</h2>";
    foreach ($info['movie'] as $movieTitle => $theaters) {
      $html .= "<div class='movie-card'>";
      $html .= "<h3 class='movie-title'>Phim: $movieTitle</h3>";

      foreach ($theaters as $theaterName => $days) {
        $html .= "<div class='theater-info'>$theaterName</div>";
        foreach ($days as $day => $dates) {
          foreach ($dates as $date => $times) {
            $formattedDate = date('d/m/Y', strtotime($date));
            $html .= "<div class='day-card'>";
            $html .= "<h4 class='day-title'>$day - $formattedDate</h4>";
            $html .= "<div class='time-slots'>";
            foreach ($times as $time) {
              $html .= "<span class='time'>" . date('H:i', strtotime($time)) . "</span>";
            }
            $html .= "</div></div>";
          }
        }
      }

      $html .= "</div>";
    }

    $html .= "
            </div>
        </body>
        </html>
        ";


    $mail->isHTML(true);
    $mail->Subject = "Lịch Chiếu Phim";
    $mail->Body = $html;
    $mail->send();
    $mail->clearAddresses();
  }
} catch (Exception $e) {
  echo "<script>alert('Lỗi! Email không được gửi');</script>";
}
