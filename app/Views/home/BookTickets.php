<style>
    .hover-effect:hover {
        background-color: red;
        /* Màu nền khi hover */
        border-color: #f8f9fa;
        /* Màu viền khi hover */
    }
</style>

<section class="section section--details">
    <!-- details background -->
    <div class="section__details-bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/account.jpg"></div>
    <!-- end details background -->

    <!-- details content -->
    <div class="container">
        <div class="row">
            <!-- title -->
            <div class="col-12">
                <h1 class="section__title section__title--head"><?php echo mb_strtoupper($movieDetail[0]['movie_name'], 'UTF-8'); ?></h1>
            </div>
            <!-- end title -->

            <!-- content -->
            <div class="col-12 col-xl-4">
                <div class="item item--details">
                    <!-- card cover -->
                    <div class="item__cover">
                        <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movieDetail[0]['poster']; ?>" alt="">
                    </div>
                    <!-- end card cover -->

                    <!-- card content -->
                    <div class="item__content">
                        <div class="item__wrap">
                            <span class="item__rate">8.4</span>

                            <ul class="item__list">
                                <li>Full HD</li>
                                <li>18+</li>
                            </ul>
                        </div>

                        <ul class="item__meta">
                            <li><span>Thể loại:</span> <span class="text-pink"><?php echo $movieDetail[0]['genre']; ?></span></li>
                            <li><span>Thời lượng:</span> <span class="text-pink"><?php echo $movieDetail[0]['duration']; ?> phút</span></li>
                            <li><span>Quốc gia:</span> <span class="text-pink"><?php echo $movieDetail[0]['nation']; ?></span></li>
                            <li><span>Ngày khởi chiếu:</span> <span class="text-pink"><?php echo date('d/m/Y', strtotime($movieDetail[0]['release_date'])); ?> </span></li>
                        </ul>

                        <ul class="item__meta item__meta--second">
                            <li><span>Đạo diễn:</span> <span class="text-pink"><?php echo $movieDetail[0]['director']; ?></span></li>
                            <li><span>Diễn viên:</span> <span class="text-pink"><?php echo $movieDetail[0]['actor']; ?></span></li>
                        </ul>
                    </div>

                    <div class="item__description item__description--details">
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8 ">
                <div class="col-12">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_cinema'])) {
                        $_SESSION['id_cinema_customer'] = $_GET['id_cinema'];
                    }
                    ?>
                    <form action="" method="GET">
                        <select name="id_cinema" id="" class="form-control mb-2" onchange="this.form.submit()">
                            <?php foreach ($cinemas as $cinema) { ?>
                                <option value="<?php echo $cinema['id_cinema']; ?>" <?php echo (isset($_SESSION['id_cinema_customer']) && $_SESSION['id_cinema_customer'] == $cinema['id_cinema']) ? 'selected' : ''; ?>>
                                    <?php echo $cinema['cinema_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="day" value="<?php echo $_GET['day'] ?>">

                        <input type="submit" value="" name="add_cinema" style="display: none;">
                    </form>

                </div>
                <div class="d-flex mt-3">

                    <?php
                    $today = new DateTime();
                    $today->setTime(0, 0, 0);
                    $daysOfWeek = [
                        1 => 'Thứ 2',
                        2 => 'Thứ 3',
                        3 => 'Thứ 4',
                        4 => 'Thứ 5',
                        5 => 'Thứ 6',
                        6 => 'Thứ 7',
                        7 => 'Chủ nhật'
                    ];

                    $days = [];

                    for ($i = 0; $i < 8; $i++) {
                        $day = clone $today;
                        $day->modify("+$i days");
                        $dayOfWeek = $day->format('N');

                        if ($i == 0) {
                            $dayFormatted = 'Hôm nay: ' . $day->format('d/m/Y');
                            $dayValue = $day->format('Y-m-d');
                        } else {
                            $dayFormatted = $daysOfWeek[$dayOfWeek] . ' ' . $day->format('d/m/Y');
                            $dayValue = $day->format('Y-m-d');
                        }

                        $days[] = [
                            'formatted' => $dayFormatted,
                            'value' => $dayValue
                        ];
                    }

                    foreach ($days as $day) {

                        if (isset($_GET['id_cinema'])) {
                            $id_cinema = $_GET['id_cinema'];
                        } else {
                            $id_cinema = $listCinema[0]['id_cinema'];
                        }
                        if ($day['value'] == $_GET['day']) {
                            echo "<div class='text-center'>
                        <a class='text-light btn btn-primary  m-2' href='?id_cinema=$id_cinema&day={$day['value']}'>{$day['formatted']}</a>
                                 </div>";
                        } else {
                            echo "<div class='text-center'>
                            <a class='text-light btn btn-light text-dark m-2' href='?id_cinema=$id_cinema&day={$day['value']}'>{$day['formatted']}</a>
                                 </div>";
                        }
                    }
                    ?>



                </div>
                <?php

                $groupedShowTimes = [];

                foreach ($show_time as $time) {
                    $format = $time['projection_format'];
                    if (!isset($groupedShowTimes[$format])) {
                        $groupedShowTimes[$format] = [];
                    }
                    $groupedShowTimes[$format][] = $time;
                }
                foreach ($groupedShowTimes as $format => $times) { ?>
                    <div class="d-flex m-3 row">
                        <span class="text-light mt-3 col-2"><?php echo $format ?></span>
                        <?php
                        foreach ($times as $time) {

                            $start_time  = date('H:i', strtotime($time['start_time'] . ' +30 minutes'));



                        ?>
                            <div class="border border-2 m-2 p-2 col-2 hover-effect text-center rounded-3">
                                <a href="chon-ghe-<?php echo $time['id_showTime'] ?>.html"><?php echo $start_time  ?></a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }


                ?>
            </div>


        </div>
    </div>
</section>
<script>
    localStorage.removeItem('endTime');
    localStorage.removeItem('remainingTime');
</script>