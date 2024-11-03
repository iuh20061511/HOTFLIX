<div class="container-fluid px-5" style="margin-top: 150px; margin-bottom: 200px;">
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

            <div id="movie-schedule-container" class="bg-light p-4 rounded shadow-sm"></div>
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

    if (!isset($schedules[$date])) {
        $schedules[$date] = [];
    }
    if (!isset($schedules[$date][$cinemaId])) {
        $schedules[$date][$cinemaId] = [];
    }
    $movieExists = false;

    foreach ($schedules[$date][$cinemaId] as &$movie) {
        if ($movie['title'] === $value['movie_name']) {
            $movie['times'][] = [
                'time' => date('H:i', strtotime($value['start_time'] . ' +30 minutes')),
                'data_time' => "id_showTime=" . $value['id_showTime'] . "&id_movie=" . $value['id_movie'] . "&id_room=" . $value['id_room']
            ];
            $movieExists = true;
            break;
        }
    }

    if (!$movieExists) {
        $schedules[$date][$cinemaId][] = [
            'title' => $value['movie_name'],
            'times' => [[
                'time' => date('H:i', strtotime($value['start_time'] . ' +30 minutes')),
                'data_time' => "id_showTime=" . $value['id_showTime'] . "&id_movie=" . $value['id_movie'] . "&id_room=" . $value['id_room']
            ]],
            'poster' => _WEB_ROOT . '/public/admin/img/movies/' . $value['poster'],
            'duration' => $value['duration'],
            'projection_format' => $value['projection_format']
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
              
                    <div class="movie-schedule mb-4 ">
                        <div class="d-flex align-items-center mb-2">
                            <img src="${movie.poster}" alt="Movie Poster" class="me-3 rounded" style="width: 80px;">
                            <div>
                                <h6 class="mb-0">${movie.title}</h6>
                                <small class="text-muted">${movie.projection_format}</small><br>
                                <small class="text-muted">Thời gian: ${movie.duration} phút</small>

                            </div>
                        </div>
                        <div>`;

                movie.times.forEach(time => {
                    scheduleHTML += `
                        <a class="btn btn-outline-dark me-2 mb-2 time-btn" 
                                href="chon-ghe.html?${time.data_time}">
                            ${time.time}
                        </a> `;
                });

                scheduleHTML += `</div>  <hr></div>`;
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