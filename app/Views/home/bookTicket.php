<div class="container-fluid px-5" style="margin-top: 100px; margin-bottom: 200px;">
    <div class="row">
        <div class="col-md-3">
            <div class=" bg-light">
                <div style="background-color: #ccc;">
                    <h5 class="text-center p-3"> <img src="<?php echo _WEB_ROOT ?>/public/assets/img/logo_edited_v2.svg" alt=""></h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($cinemas as $cinema) : ?>
                        <a href="#" class="list-group-item list-group-item-action cinema-link p-3" data-cinema="hotflix<?php echo $cinema['id_cinema']; ?>">
                            <?php echo $cinema['cinema_name']; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-center mb-4">
                <div class="btn-group" style="width: 100%;">
                    <?php
                    $startDate = new DateTime();
                    $daysOfWeek = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];

                    $todayDate = $startDate->format('d/m/Y');

                    for ($i = 0; $i < 7; $i++) {
                        $currentDate = clone $startDate;
                        $currentDate->modify("+$i days");
                        $formattedDate = $currentDate->format('d/m/Y');
                        $dayOfWeek = $currentDate->format('w');
                        $displayDate = $formattedDate . '<br>' . $daysOfWeek[$dayOfWeek];
                        $activeClass = ($formattedDate === $todayDate) ? 'active' : '';

                        echo "<button class='btn btn-outline-light date-btn $activeClass' data-date='$formattedDate'>$displayDate</button>";
                    }
                    ?>
                </div>
            </div>


            <div class="alert alert-info text-center shadow-sm">
                Nhấn vào suất chiếu để tiến hành mua vé
            </div>

            <div id="movie-schedule-container" class="bg-light p-4 rounded shadow-sm" style=" overflow: scroll; max-height: 450px;"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php

$schedules = [];

foreach ($show_time as $value) {
    $date = date('d/m/Y', strtotime($value['show_date']));
    $cinemaId = "hotflix" . $value['id_cinema'];

    // Kiểm tra và khởi tạo các cấp dữ liệu nếu chưa tồn tại
    if (!isset($schedules[$date])) {
        $schedules[$date] = [];
    }
    if (!isset($schedules[$date][$cinemaId])) {
        $schedules[$date][$cinemaId] = [];
    }

    // Tìm phim trong mảng
    $movieExists = false;
    foreach ($schedules[$date][$cinemaId] as &$movie) {
        if ($movie['title'] === $value['movie_name']) {
            // Tìm định dạng projection_format trong phim
            $formatExists = false;
            foreach ($movie['formats'] as &$format) {
                if ($format['projection_format'] === $value['projection_format']) {
                    $format['times'][] = [
                        'time' => date('H:i', strtotime($value['start_time'] . ' +30 minutes')),
                        'data_time' => $value['id_showTime']
                    ];
                    $formatExists = true;
                    break;
                }
            }

            // Nếu chưa có định dạng, thêm mới
            if (!$formatExists) {
                $movie['formats'][] = [
                    'projection_format' => $value['projection_format'],
                    'times' => [[
                        'time' => date('H:i', strtotime($value['start_time'] . ' +30 minutes')),
                        'data_time' => $value['id_showTime']
                    ]]
                ];
            }

            $movieExists = true;
            break;
        }
    }

    // Nếu chưa có phim, thêm mới
    if (!$movieExists) {
        $schedules[$date][$cinemaId][] = [
            'title' => $value['movie_name'],
            'poster' => _WEB_ROOT . '/public/admin/img/movies/' . $value['poster'],
            'duration' => $value['duration'],
            'formats' => [[
                'projection_format' => $value['projection_format'],
                'times' => [[
                    'time' => date('H:i', strtotime($value['start_time'] . ' +30 minutes')),
                    'data_time' => $value['id_showTime']
                ]]
            ]]
        ];
    }
}

$jsonSchedules = json_encode($schedules);
?>


<script>
    const schedules = <?php echo $jsonSchedules; ?>;
    let selectedDate = new Date().toLocaleDateString('en-GB');
    let selectedCinema = "hotflix1";

    function loadSchedule() {
        const container = $("#movie-schedule-container");
        container.empty();

        const cinemaSchedules = schedules[selectedDate]?.[selectedCinema];
        if (cinemaSchedules) {
            cinemaSchedules.forEach(movie => {
                let scheduleHTML = `
                    <div class="movie-schedule mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <img src="${movie.poster}" alt="Movie Poster" class="me-3 rounded" style="width: 80px;">
                            <div>
                                <h6 class="mb-0">${movie.title}</h6>
                                <small class="text-muted">Thời gian: ${movie.duration} phút</small>
                            </div>
                        </div>
                `;

                // Chia các suất chiếu theo loại chiếu (2D, 3D, ...)
                movie.formats.forEach(format => {
                    scheduleHTML += `
                        <div class="mb-3">
                            <h6 class="text-primary">${format.projection_format}</h6>
                            <div>
                    `;

                    // Thêm các suất chiếu theo giờ
                    format.times.forEach(time => {
                        scheduleHTML += `
                            <a class="btn btn-outline-dark me-2 mb-2 time-btn" 
                                    href="chon-ghe-${time.data_time}.html">
                                ${time.time}
                            </a>
                        `;
                    });

                    scheduleHTML += `
                            </div>
                        </div>
                    `;
                });

                scheduleHTML += `</div><hr>`;
                container.append(scheduleHTML);
            });
        } else {
            container.append("<p class='text-center'>Vui lòng chọn rạp</p>");
        }
    }

    $(document).ready(function() {
        loadSchedule();

        $(".cinema-link").on("click", function(e) {
            e.preventDefault();
            $(".cinema-link").removeClass("active");
            $(this).addClass("active");

            selectedCinema = $(this).data("cinema");
            loadSchedule();
        });

        $(".date-btn").on("click", function() {
            $(".date-btn").removeClass("active");
            $(this).addClass("active");

            selectedDate = $(this).data("date");
            loadSchedule();
        });
    });
</script>