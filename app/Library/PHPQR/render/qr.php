<?php
$start_seconds = strtotime($start_time);
$end_seconds = strtotime($end_time);
$total_duration = $end_seconds - $start_seconds;
$average_start = $start_seconds + ($total_duration / 2);
$half_duration = ($duration * 60) / 2;

$average_start_time = date("H:i:s", $average_start - $half_duration);
$average_end_time = date("H:i:s", $average_start + $half_duration);

$start_time = substr($average_start_time, 0, 5);
$end_time = substr($average_end_time, 0, 5);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vé Xem Phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                <h6 class="card-title mt-2"> <strong>Tên phim: </strong><?php echo $movie_name ?></h6>
                <p class="card-text"><strong>Địa Điểm: </strong><?php echo $cinema_name ?></p>
                <p class="card-text"><strong>Thời gian: </strong><?php echo $start_time . ' - ' . $end_time ?> <?php echo date("d/m/Y", strtotime($time));  ?> </p>
                <span class="card-text"><strong>Phòng: </strong> <?php echo $room ?></span>
                <span class="card-text"> - Ghế: <?php echo $seat ?></span>

                <div>
                    <?php if ($checkIn == 1) { ?>
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: #28a745;"></i>
                    <?  } ?>
                </div>
                <div class="my-3">
                    <form action="" method="post">
                        <input type="hidden" name="id_ticket" value="<?php echo $id_ticket ?>">
                        <input type="submit" value="Xác nhận" name="checkIn">
                    </form>
                </div>

            </div>
            <div class="card-footer text-muted">
                <small>Chúc bạn có một buổi xem phim vui vẻ!</small>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>