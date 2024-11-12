<section class="content " style="margin-top: 100px;">
    <div class="container mt-4 bg-light rounded-3 shadow p-3 mb-5 bg-body rounded">
        <div class="d-flex justify-content-center align-items-start flex-wrap mt-3">

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

            for ($i = 0; $i < 7; $i++) {
                $day = clone $today;
                $day->modify("+$i days");
                $dayOfWeek = $day->format('N');

                if ($i == 0) {
                    $dayFormatted = 'Hôm nay: ' . $day->format('d/m/Y');
                } else {
                    $dayFormatted = $daysOfWeek[$dayOfWeek] . ' ' . $day->format('d/m/Y');
                }

                $dayValue = $day->format('Y-m-d');

                $days[] = [
                    'formatted' => $dayFormatted,
                    'value' => $dayValue
                ];
            }

            $id_cinema = $_GET['id_cinema'] ?? $_SESSION['id_cinema_customer'] ?? null;
            foreach ($days as $day) {
                $activeClass = ($day['value'] == ($_GET['day'] ?? '')) ? 'btn-primary' : 'btn-outline-secondary';
                if (isset($_GET['id_cinema'])) {
                    echo "<div class='m-2'>
            <a class='btn $activeClass shadow-sm rounded px-3 py-2' href='?day=" . htmlspecialchars($day['value']) . "&id_cinema=" . htmlspecialchars($_GET['id_cinema']) . "'>
                " . htmlspecialchars($day['formatted']) . "
            </a>
        </div>";
                } else {
                    echo "<div class='m-2'>
                    <a class='btn $activeClass shadow-sm rounded px-3 py-2' href='?day={$day['value']}'>
                        {$day['formatted']}
                    </a>
                  </div>";
                }
            }
            ?>
        </div>

        <div class="row">

            <div class="col-12 col-md-3 mb-4">
                <div class="list-group">
                    <?php foreach ($cinemas as $cinema) {

                        $activeClass = (isset($_GET['id_cinema']) && $_GET['id_cinema'] == $cinema['id_cinema']) ? 'bg-primary text-light' : 'bg-light';
                    ?>
                        <form action="" method="GET">
                            <input type="hidden" name="day" value="<?php echo $_GET['day'] ?? ''; ?>">
                            <input type="hidden" name="id_cinema" value="<?php echo $cinema['id_cinema'] ?>">
                            <button type="submit" class="list-group-item list-group-item-action text-center shadow-sm rounded mb-2 <?php echo $activeClass; ?>">
                                <?php echo $cinema['cinema_name'] ?>
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </div>

            <div class="col-12 col-md-9">
                <?php if (isset($_GET['id_cinema'])) { ?>
                    <?php foreach ($rooms as $room) { ?>
                        <div class="mb-4">
                            <h6 class="text-dark font-weight-bold mt-2"><?php echo $room['room_name']; ?></h6>
                            <div class="row">
                                <?php
                                $hours = ['08:30', '11:30', '14:30', '17:30', '20:30'];
                                foreach ($hours as $hour) {
                                    $order_found = false;
                                    foreach ($room_order as $order) {
                                        $time = date("H:i", strtotime($order['time']));
                                        if ($hour == $time && $order['show_date'] == $_GET['day'] && $room['room_name'] == $order['room_name']) {
                                            $order_found = true;
                                            break;
                                        }
                                    }
                                    if ($order_found) { ?>
                                        <div class="col-4 col-sm-3 col-md-2 text-center">
                                            <a href=" thue-phong-nhom-<?php echo $room['id_room'] ?>.html?date=<?php echo $_GET['day'] ?>&time=<?php echo $hour ?>" class="d-block" style=" cursor: not-allowed">
                                                <div class="border border-dark p-2 rounded text-light bg-dark shadow-sm">
                                                    <span class="font-weight-bold" style="font-size: 14px;"><?php echo $hour; ?>(đã đặt)</span>
                                                </div>
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-4 col-sm-3 col-md-2 text-center">
                                            <a href="thue-phong-nhom-<?php echo $room['id_room'] ?>.html?date=<?php echo $_GET['day'] ?>&time=<?php echo $hour ?>" class="d-block">
                                                <div class="border border-dark p-2 rounded text-light bg-danger shadow-sm">
                                                    <span class="font-weight-bold" style="font-size: 14px;"><?php echo $hour; ?></span>
                                                </div>
                                            </a>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

    </div>
</section>