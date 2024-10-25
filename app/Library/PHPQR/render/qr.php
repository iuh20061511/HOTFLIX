<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vé Xem Phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .movie-card {
            max-width: 500px;
            margin: auto;
        }

        .movie-poster {
            max-height: 250px;
            object-fit: cover;
        }

        .qr-code {
            max-width: 150px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5 ">
        <div class="card movie-card text-center shadow-lg rounded border-primary" style="background-color: #a5a8ff;">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Vé Xem Phim</h4>
            </div>
            <div class="card-body">
                <img src="<?php echo _WEB_ROOT ?>/public/assets/img/logo_edited_v2.svg" class="img-fluid movie-poster rounded mb-3"><br>
                <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movie_image; ?>" alt="QR Code" class="img-fluid" style="width: 100px;" alt="Movie Poster">
                <h6 class="card-title">Tên phim: <strong><?php echo $movie_name ?></strong></h6>
                <p class="card-text"><strong>Địa Điểm:</strong><?php echo $cinema_name ?></p>
                <p class="card-text"><strong>Thời gian:</strong><?php echo $start_time ?> <?php echo $time ?> </p>
                <span class="card-text"><strong>Phòng:</strong> <?php echo $room ?></span>
                <span class="card-text"> - Ghế: <?php echo $seat ?></span>
                <div class="my-3">
                    <img src="<?php echo $file; ?>" alt="QR Code" class="img-fluid qr-code">
                </div>
                <p class="card-text">Quét mã QR để xác nhận vé.</p>
            </div>
            <div class="card-footer text-muted">
                <small>Chúc bạn có một buổi xem phim vui vẻ!</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>