<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm suất chiếu</h2>

                </div>
            </div>
            <?php
            $ngayXemLich = (new DateTime())->format('Y-m-d');

            $monday = strtotime('this week monday');
            $thu2 = date('d/m/Y', $monday);

            $tuesday = strtotime('this week tuesday');
            $thu3 = date('d/m/Y', $tuesday);

            $thursday = strtotime('this week wednesday');
            $thu4 = date('d/m/Y', $thursday);

            $thursday = strtotime('this week thursday');
            $thu5 = date('d/m/Y', $thursday);

            $friday = strtotime('this week friday');
            $thu6 = date('d/m/Y', $friday);

            $saturday = strtotime('this week saturday');
            $thu7 = date('d/m/Y', $saturday);

            $sunday = strtotime('this week sunday');
            $thu8 = date('d/m/Y', $sunday);
            if (!isset($_SESSION['t2'])) {

                $_SESSION['t2'] = $thu2;
                $_SESSION['t3'] = $thu3;
                $_SESSION['t4'] = $thu4;
                $_SESSION['t5'] = $thu5;
                $_SESSION['t6'] = $thu6;
                $_SESSION['t7'] = $thu7;
                $_SESSION['t8'] = $thu8;
            }

            if (isset($_POST['next'])) {
                $dates = ['t2', 't3', 't4', 't5', 't6', 't7', 't8'];

                foreach ($dates as $date) {
                    $dateTime = DateTime::createFromFormat('d/m/Y', $_SESSION[$date]);
                    $dateTime->modify('+7 days');
                    $_SESSION[$date] = $dateTime->format('d/m/Y');
                }
                $ngayXemLich = DateTime::createFromFormat('d/m/Y', $_SESSION['t2'])->format('Y-m-d');
            } elseif (isset($_POST['prev'])) {
                $dates = ['t2', 't3', 't4', 't5', 't6', 't7', 't8'];

                foreach ($dates as $date) {
                    $dateTime = DateTime::createFromFormat('d/m/Y', $_SESSION[$date]);
                    $dateTime->modify('-7 days');
                    $_SESSION[$date] = $dateTime->format('d/m/Y');
                }

                $ngayXemLich = DateTime::createFromFormat('d/m/Y', $_SESSION['t2'])->format('Y-m-d');
            } elseif (isset($_POST['current'])) {
                $_SESSION['t2'] = $thu2;
                $_SESSION['t3'] = $thu3;
                $_SESSION['t4'] = $thu4;
                $_SESSION['t5'] = $thu5;
                $_SESSION['t6'] = $thu6;
                $_SESSION['t7'] = $thu7;
                $_SESSION['t8'] = $thu8;
            } elseif (isset($_POST['findDate'])) {

                $ngay_dau_tuan = date('Y-m-d', strtotime('monday this week', strtotime($_POST['date'])));
                $ngay_trong_tuan = array();

                $ngay_trong_tuan[] = $ngay_dau_tuan;

                for ($i = 1; $i < 7; $i++) {
                    $ngay_trong_tuan[] = date('Y-m-d', strtotime("+$i day", strtotime($ngay_dau_tuan)));
                }


                $_SESSION['t2'] = date('d/m/Y', strtotime($ngay_trong_tuan[0]));
                $_SESSION['t3'] = date('d/m/Y', strtotime($ngay_trong_tuan[1]));
                $_SESSION['t4'] = date('d/m/Y', strtotime($ngay_trong_tuan[2]));
                $_SESSION['t5'] = date('d/m/Y', strtotime($ngay_trong_tuan[3]));
                $_SESSION['t6'] = date('d/m/Y', strtotime($ngay_trong_tuan[4]));
                $_SESSION['t7'] = date('d/m/Y', strtotime($ngay_trong_tuan[5]));
                $_SESSION['t8'] = date('d/m/Y', strtotime($ngay_trong_tuan[6]));
            }



            $t2 = $_SESSION['t2'];
            $t3 = $_SESSION['t3'];
            $t4 = $_SESSION['t4'];
            $t5 = $_SESSION['t5'];
            $t6 = $_SESSION['t6'];
            $t7 = $_SESSION['t7'];
            $t8 = $_SESSION['t8'];

            ?>

            <div class="row">
                <div class="col-10">

                </div>
                <div class="col-2">
                    <form action="" method="POST">
                        <input type="submit" value="Gửi lịch chiếu" class="btn btn-success" name="send_show_time">
                    </form>
                </div>

                <?php if (isset($_SESSION['room'])) { ?>
                    <div class="col-6">
                        <form action="" method="post">
                            <input type="date" id="selectedDate" class="p-1 rounded-2" name="date" value="<?php if (isset($_POST['findDate'])) {
                                                                                                                echo $_POST['date'];
                                                                                                            } else {
                                                                                                                echo $ngayXemLich;
                                                                                                            } ?>" onchange="submitForm()">
                            <input type="submit" value="Trở về" id="previousWeekButton" name="prev"
                                class="bg-info text-light border-0 rounded" style="padding: 4px 15px;">
                            <input type="submit" value="Hiện Tại" id="currentDateButton" name="current"
                                class="bg-info text-light border-0 rounded" style="padding: 4px 15px;">
                            <input type="submit" value="Tiếp" id="nextWeekButton" name="next"
                                class="bg-info text-light border-0 rounded" style="padding: 4px 15px;">
                            <input type="submit" value="Tìm" id="findDate" name="findDate" style="display: none;">
                        </form>

                    </div>
                <?php } ?>
                <button class="btn btn-danger" style="width: 30%;" id="toggleButton">Chọn Phim và Phòng Chiếu</button>

                <form action="" method="POST">
                    <div class="hidden-content mt-3 bg-warning m-3 p-3 row" id="content">

                        <div class="col-6">
                            <select name="movie" id="movieSelect" class="sign__input bg-secondary" style="width: 200px;" onchange="this.form.submit()">
                                <option>Chọn bộ phim....</option>
                                <?php
                                $selectedMovie = isset($_POST['movie']) ? $_POST['movie'] : '';
                                foreach ($listMovie as $movie) {
                                    $isSelected = ($selectedMovie === ($movie['id_movie'] . ',' . $movie['duration'])) ? 'selected' : '';
                                    if ($_SESSION['id_movie'] == $movie['id_movie']) {
                                ?>
                                        <option selected value='<?php echo $movie['id_movie'] . ',' . $movie['duration']; ?>'
                                            <?php echo $isSelected; ?>>
                                            <?php echo $movie['movie_name']; ?></option>
                                    <?php } else { ?>
                                        <option value='<?php echo $movie['id_movie'] . ',' . $movie['duration']; ?>'
                                            <?php echo $isSelected; ?>>
                                            <?php echo $movie['movie_name']; ?></option>
                                <?php  }
                                } ?>
                            </select>
                        </div>

                        <div class="col-6 d-flex flex-wrap">
                            <?php foreach ($listRoom as $room) { ?>
                                <div class="form-check me-3 p-1 border rounded shadow-sm text-center room-option <?php if (isset($_SESSION['room']) && $room['id_room'] == $_SESSION['room']) echo 'bg-primary text-white'; ?>" style="width: 100px;">
                                    <input
                                        type="radio"
                                        class="form-check-input d-none"
                                        name="room"
                                        id="room-<?php echo $room['id_room']; ?>"
                                        value="<?php echo $room['id_room']; ?>"
                                        <?php if (isset($_SESSION['room']) && $room['id_room'] == $_SESSION['room']) echo 'checked'; ?>
                                        onchange="updateRoomType('<?php echo $room['id_roomType']; ?>'); this.form.submit()">

                                    <label class="form-check-label fw-bold" for="room-<?php echo $room['id_room']; ?>" style="font-size: 12px;">
                                        <?php echo $room['room_name']; ?>
                                    </label>
                                    <div style="font-size: 12px;">
                                        <?php echo $room['number_seat'] . " chỗ"; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <input type="hidden" name="roomType" id="roomType">
                        </div>

                        <script>
                            function updateRoomType(roomType) {
                                document.getElementById('roomType').value = roomType;
                            }
                        </script>



                        <input type="submit" class="btn btn-success" style="width: 100px; margin-left: 50%; display: none;" value="xác nhận">
                    </div>
                </form>


            </div>
            <?php if (isset($_SESSION['room'])) { ?>

                <div>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 text-center rounded">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th class="text-light bg-danger">Thời gian</th>
                                    <th style="height: 60px;">Thứ 2 <?php echo $t2; ?></th>
                                    <th style="height: 60px;">Thứ 3 <?php echo $t3; ?></th>
                                    <th style="height: 60px;">Thứ 4 <?php echo $t4; ?></th>
                                    <th style="height: 60px;">Thứ 5 <?php echo $t5; ?></th>
                                    <th style="height: 60px;">Thứ 6 <?php echo $t6; ?></th>
                                    <th style="height: 60px;">Thứ 7 <?php echo $t7; ?></th>
                                    <th style="height: 60px;">Chủ nhật <?php echo $t8; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-3">
                                    <td class="text-center align-middle bg-warning"></td>
                                    <?php
                                    $currentDate = new DateTime();
                                    $compareDate = DateTime::createFromFormat('d/m/Y', "$t2");
                                    if ($compareDate > $currentDate) { ?>
                                        <td class="bg-light" style="height: 200px;" onclick="handleClick('t2')">
                                        <?php  } else { ?>
                                        <td class="bg-light" style="height: 200px;" onclick="nodate()">

                                        <?php } ?>
                                        <?php
                                        if (isset($show_time_t2)) {
                                            foreach ($show_time_t2 as $show) {
                                        ?>
                                                <div class="shadow-lg rounded m-1" onclick="event.stopPropagation();" style="background-color: <?php echo $show['color_code'] ?>;">
                                                    <span style="font-size: 14px;"><?php echo $show['movie_name']; ?></span>
                                                    <h6 style="font-size: 14px;" class="text-danger"><b><?php echo substr($show['start_time'], 0, 5) . ' - ' .   substr($show['end_time'], 0, 5); ?></b></h6>
                                                    <a href="xoa-suat-chieu-<?php echo $show['id_showTime'] . '.html'; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa !')"><i class="bi bi-trash-fill text-dark"></i></a>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </td>
                                        <?php
                                        $currentDate = new DateTime();
                                        $compareDate = DateTime::createFromFormat('d/m/Y', "$t3");
                                        if ($compareDate > $currentDate) { ?>
                                            <td class="bg-light" style="height: 200px;" onclick="handleClick('t3')">
                                            <?php  } else { ?>
                                            <td class="bg-light" style="height: 200px;" onclick="nodate()">

                                            <?php } ?>
                                            <?php
                                            if (isset($show_time_t3)) {
                                                foreach ($show_time_t3 as $show) {
                                            ?>
                                                    <div class="  shadow-lg rounded m-1" onclick="event.stopPropagation();" style="background-color: <?php echo $show['color_code'] ?>;">
                                                        <span style="font-size: 14px;"><?php echo $show['movie_name']; ?></span>
                                                        <h6 style="font-size: 14px;" class="text-danger"><b><?php echo substr($show['start_time'], 0, 5) . ' - ' .   substr($show['end_time'], 0, 5); ?></b></h6>
                                                        <a href="xoa-suat-chieu-<?php echo $show['id_showTime'] . '.html'; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa !')"><i class="bi bi-trash-fill text-dark"></i></a>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                            </td>
                                            <?php
                                            $currentDate = new DateTime();
                                            $compareDate = DateTime::createFromFormat('d/m/Y', "$t4");
                                            if ($compareDate > $currentDate) { ?>
                                                <td class="bg-light" style="height: 200px;" onclick="handleClick('t4')">
                                                <?php  } else { ?>
                                                <td class="bg-light" style="height: 200px;" onclick="nodate()">

                                                <?php } ?>
                                                <?php
                                                if (isset($show_time_t4)) {
                                                    foreach ($show_time_t4 as $show) {
                                                ?>
                                                        <div class="  shadow-lg rounded m-1" onclick="event.stopPropagation();" style="background-color: <?php echo $show['color_code'] ?>;">
                                                            <span style="font-size: 14px;"><?php echo $show['movie_name']; ?></span>
                                                            <h6 style="font-size: 14px;" class="text-danger"><b><?php echo substr($show['start_time'], 0, 5) . ' - ' .   substr($show['end_time'], 0, 5); ?></b></h6>
                                                            <a href="xoa-suat-chieu-<?php echo $show['id_showTime'] . '.html'; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa !')"><i class="bi bi-trash-fill text-dark"></i></a>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                </td>
                                                <?php
                                                $currentDate = new DateTime();
                                                $compareDate = DateTime::createFromFormat('d/m/Y', "$t5");
                                                if ($compareDate > $currentDate) { ?>
                                                    <td class="bg-light" style="height: 200px;" onclick="handleClick('t5')">
                                                    <?php  } else { ?>
                                                    <td class="bg-light" style="height: 200px;" onclick="nodate()">

                                                    <?php } ?>
                                                    <?php
                                                    if (isset($show_time_t5)) {
                                                        foreach ($show_time_t5 as $show) {
                                                    ?>
                                                            <div class="  shadow-lg rounded m-1" onclick="event.stopPropagation();" style="background-color: <?php echo $show['color_code'] ?>;">
                                                                <span style="font-size: 14px;"><?php echo $show['movie_name']; ?></span>
                                                                <h6 style="font-size: 14px;" class="text-danger"><b><?php echo substr($show['start_time'], 0, 5) . ' - ' .   substr($show['end_time'], 0, 5); ?></b></h6>
                                                                <a href="xoa-suat-chieu-<?php echo $show['id_showTime'] . '.html'; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa !')"><i class="bi bi-trash-fill text-dark"></i></a>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    </td>
                                                    <?php
                                                    $currentDate = new DateTime();
                                                    $compareDate = DateTime::createFromFormat('d/m/Y', "$t6");
                                                    if ($compareDate > $currentDate) { ?>
                                                        <td class="bg-light" style="height: 200px;" onclick="handleClick('t6')">
                                                        <?php  } else { ?>
                                                        <td class="bg-light" style="height: 200px;" onclick="nodate()">

                                                        <?php } ?>
                                                        <?php
                                                        if (isset($show_time_t6)) {
                                                            foreach ($show_time_t6 as $show) {
                                                        ?>
                                                                <div class="  shadow-lg rounded m-1" onclick="event.stopPropagation();" style="background-color: <?php echo $show['color_code'] ?>;">
                                                                    <span style="font-size: 14px;"><?php echo $show['movie_name']; ?></span>
                                                                    <h6 style="font-size: 14px;" class="text-danger"><b><?php echo substr($show['start_time'], 0, 5) . ' - ' .   substr($show['end_time'], 0, 5); ?></b></h6>
                                                                    <a href="xoa-suat-chieu-<?php echo $show['id_showTime'] . '.html'; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa !')"><i class="bi bi-trash-fill text-dark"></i></a>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        </td>
                                                        <?php
                                                        $currentDate = new DateTime();
                                                        $compareDate = DateTime::createFromFormat('d/m/Y', "$t7");
                                                        if ($compareDate > $currentDate) { ?>
                                                            <td class="bg-light" style="height: 200px;" onclick="handleClick('t7')">
                                                            <?php  } else { ?>
                                                            <td class="bg-light" style="height: 200px;" onclick="nodate()">

                                                            <?php } ?>
                                                            <?php
                                                            if (isset($show_time_t7)) {
                                                                foreach ($show_time_t7 as $show) {
                                                            ?>
                                                                    <div class="  shadow-lg rounded m-1" onclick="event.stopPropagation();" style="background-color: <?php echo $show['color_code'] ?>;">
                                                                        <span style="font-size: 14px;"><?php echo $show['movie_name']; ?></span>
                                                                        <h6 style="font-size: 14px;" class="text-danger"><b><?php echo substr($show['start_time'], 0, 5) . ' - ' .   substr($show['end_time'], 0, 5); ?></b></h6>
                                                                        <a href="xoa-suat-chieu-<?php echo $show['id_showTime'] . '.html'; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa !')"><i class="bi bi-trash-fill text-dark"></i></a>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                            </td>
                                                            <?php
                                                            $currentDate = new DateTime();
                                                            $compareDate = DateTime::createFromFormat('d/m/Y', "$t8");
                                                            if ($compareDate > $currentDate) { ?>
                                                                <td class="bg-light" style="height: 200px;" onclick="handleClick('t8')">
                                                                <?php  } else { ?>
                                                                <td class="bg-light" style="height: 200px;" onclick="nodate()">

                                                                <?php } ?>
                                                                <?php
                                                                if (isset($show_time_t8)) {
                                                                    foreach ($show_time_t8 as $show) {
                                                                ?>
                                                                        <div class="  shadow-lg rounded m-1" onclick="event.stopPropagation();" style="background-color: <?php echo $show['color_code'] ?>;">
                                                                            <span style="font-size: 14px;"><?php echo $show['movie_name']; ?></span>
                                                                            <h6 style="font-size: 14px;" class="text-danger"><b><?php echo substr($show['start_time'], 0, 5) . ' - ' .   substr($show['end_time'], 0, 5); ?></b></h6>
                                                                            <a href="xoa-suat-chieu-<?php echo $show['id_showTime'] . '.html'; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa !')"><i class="bi bi-trash-fill text-dark"></i></a>
                                                                        </div>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php

                    if (isset($time_t2)) {
                        $showDays = [
                            't2' => $time_t2,
                            't3' => $time_t3,
                            't4' => $time_t4,
                            't5' => $time_t5,
                            't6' => $time_t6,
                            't7' => $time_t7,
                            't8' => $time_t8
                        ];

                        foreach ($showDays as $day => $times) { ?>
                            <div class="modal fade" id="exampleModal_<?php echo $day; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog bg-light">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Chọn giờ lênh lịch <?php
                                                                                                                if ($day == 't2') {
                                                                                                                    echo 'Thứ 2';
                                                                                                                } else if ($day == 't3') {
                                                                                                                    echo 'Thứ 3';
                                                                                                                } else if ($day == 't4') {
                                                                                                                    echo 'Thứ 4';
                                                                                                                } else if ($day == 't5') {
                                                                                                                    echo 'Thứ 5';
                                                                                                                } else if ($day == 't6') {
                                                                                                                    echo 'Thứ 6';
                                                                                                                } else if ($day == 't7') {
                                                                                                                    echo 'Thứ 7';
                                                                                                                } else {
                                                                                                                    echo 'Chủ nhật';
                                                                                                                }
                                                                                                                ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if (count($times) > 0) { ?>
                                                <form action="" method="post" onsubmit="return validateCheckboxes()">
                                                    <div class="form-group row">
                                                        <?php
                                                        foreach ($times as $time) { ?>
                                                            <div class="form-check col-4">


                                                                <input type="checkbox" class="form-check-input" name="<?php echo $time[0] . ',' . $time[1]; ?>">

                                                                <label class="form-check-label" for="">
                                                                    <?php echo $time[0] . 'h' . ' - ' . $time[1] . 'h'; ?>
                                                                </label>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <label for="">Chọn định dạng chiếu:</label>
                                                    <select class="form-control m-1" name="projection_format" id="">
                                                        <option value="Phim 2D">Phim 2D</option>
                                                        <option value="Phim 3D">Phim 3D</option>
                                                        <option value="IMAX">IMAX</option>
                                                        <option value="Phim lồng tiếng">Phim lồng tiếng</option>
                                                        <option value="Phim thuyết minh">Phim thuyết minh</option>
                                                        <option value="Phim tài liệu">Phim tài liệu</option>
                                                        <option value="Phim hoạt hình">Phim hoạt hình</option>

                                                    </select>
                                                    <input type="hidden" name="date_time" value="<?php echo $$day ?>">
                                                    <?php



                                                    if ($id_roomType == 2 || $id_roomType == 3 || $id_roomType == 4) {

                                                    ?>
                                                        <input type="number" name="single_seat_price" id="single_seat_price" class="form-control m-1" placeholder="Nhập giá tiền của ghế đơn..." min="10000" value="45000" required>
                                                        <input type="number" name="double_seat_price" id="double_seat_price" class="form-control m-1" placeholder="Nhập giá tiền của ghế đôi..." min="10000" value="90000" required>
                                                    <?php }
                                                    ?>
                                                    <input type="number" name="vip_seat_price" id="vip_seat_price" class="form-control m-1" placeholder="Nhập giá tiền của ghế vip..." min="10000" value="60000" required>


                                                    <input type="submit" value="xác nhận" class="btn btn-success m-3" name="submit" style="margin-left: 40%;">
                                                </form>
                                            <?php } else { ?>
                                                <h5 class="text-center text-danger">Lịch chiếu đã đầy, Vui lòng chọn ngày khác hoặc phòng khác</h5>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            <?php } ?>
            <script>
                function submitForm() {
                    document.getElementById("findDate").click();
                }
            </script>

        </div>
    </div>
</main>



<script>
    function handleClick(day) {
        var modal = new bootstrap.Modal(document.getElementById('exampleModal_' + day));
        <?php if (isset($_SESSION['movie'])) { ?>
            modal.show();
        <?php } ?>
    }

    function nodate() {
        alert("Chỉ được phép lên lịch chiếu từ ngày mai")
    }
</script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#toggleButton').click(function() {
            $('#content').slideToggle();
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomOptions = document.querySelectorAll('.room-option');
        roomOptions.forEach(option => {
            option.addEventListener('click', function() {
                roomOptions.forEach(opt => opt.classList.remove('bg-primary', 'text-white'));
                this.classList.add('bg-primary', 'text-white');
                this.querySelector('input[type="radio"]').checked = true;
                this.querySelector('input[type="radio"]').dispatchEvent(new Event('change'));
            });
        });
    });
</script>
<script>
    function validateCheckboxes() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let checked = false;

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                checked = true;
            }
        });

        if (!checked) {
            alert('Bạn phải chọn ít nhất một thời gian.');
            return false; // Ngăn không cho gửi biểu mẫu
        }

        return true; // Cho phép gửi biểu mẫu
    }
</script>