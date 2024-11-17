<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/rooms/css/roomAgv.css">
<style>
    .maxSeat {
        background-color: #000 !important;
        cursor: not-allowed !important;

    }
</style>
<?php if ($_SESSION['is_login']['id_role'] == 1) { ?>
    <div class="container d-flex justify-content-center align-items-center" style="position: absolute; top:30%; z-index: 800; right: 15%;">
        <div class="card p-4" style="width: 800px;  height: 450px;   box-shadow: 5px 5px 8px 5px blue; <?php echo $check ? 'display: none;' : ''; ?>">
            <h4 class="text-center text-primary"><b>Chính sách đổi suất chiếu</b></h4>
            <p> Quý khách chỉ có thể thực hiện thay đổi số lượng ghế trong phạm vi các ghế mà quý khách đã đặt trước, bao gồm:<br>
                <?php if ($_POST['tn'] > 0) { ?>
                    <span class="text-danger"><b><?php echo $_POST['tn'] . " ghế thường" ?></b></span><br>
                <?php } ?>
                <?php if ($_POST['tv'] > 0) { ?>
                    <span class="text-danger"><b><?php echo $_POST['tv'] . " ghế VIP" ?></b></span><br>
                <?php } ?>
                <?php if ($_POST['tdb'] > 0) { ?>
                    <span class="text-danger"><b><?php echo $_POST['tdb'] . " ghế đôi" ?></b></span><br>
                <?php } ?>
            </p>
            <p> Việc thay đổi số lượng ghế không được phép giảm bớt so với số ghế ban đầu mà quý khách đã chọn.
                Trong trường hợp quý khách có nhu cầu đặt thêm ghế, vui lòng thực hiện quy trình mua vé mới, giống như khi quý khách đặt vé lần đầu tiên.</p>
            <p>Chúng tôi khuyến nghị quý khách kiểm tra kỹ lưỡng số lượng và loại ghế trước khi thực hiện đặt vé để đảm bảo sự hài lòng và tiện lợi trong suốt quá trình sử dụng dịch vụ.</p>
            <p class="text-center text-danger"><b>Cảm ơn quý khách đã lựa chọn dịch vụ của chúng tôi!</b></p>

            <button onclick="closeCard()" class="btn btn-success">Xác nhận</button>

        </div>
    </div>
<?php } ?>
<form action="xu-ly-doi-suat-chieu.html" method="POST" onsubmit="return checkSeats();" id="myForm">
    <input type="hidden" name="movie_name" value="<?php echo $movie[0]['movie_name'] ?>">
    <input type="hidden" name="image" value="<?php echo $movie[0]['poster'] ?>">
    <input type="hidden" name="cinema" value="<?php echo $cinema[0]['cinema_name'] ?>">
    <input type="hidden" name="projection_format" value="<?php echo $movie[0]['projection_format'] ?>">
    <input type="hidden" name="time" value="<?php echo substr($movie[0]['start_time'], 0, 5)  . ' - ' . substr($movie[0]['end_time'], 0, 5) . ', ' . date('d/m/Y', strtotime($movie[0]['show_date']));  ?>">

    <input type="hidden" name="id_showtime" value="<?php echo $id_showTime ?>">
    <input type="hidden" name="id_movie" value="<?php echo $id_movie ?>">
    <input type="hidden" name="id_room" value="<?php echo $id_room ?>">
    <input type="hidden" name="id_invoice" value="<?php echo $id_invoice ?>">
    <input type="hidden" name="id_showTime_old" value="<?php echo $id_showTime_old ?>">

    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="content__title">Discover</h2>

                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 80px;">
            <div class="row">

                <div class="col-12 col-lg-9 seat_move">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab"
                            tabindex="0">
                            <div class="col-12 p-0" style="overflow-x: auto;">
                                <div class="theatre row no-gutters"
                                    style="min-width: 1150px; height: 600px; white-space: nowrap;">

                                    <div class="screen text-center col-8 p-3">
                                        <h1>Màn hình</h1>
                                    </div>

                                    <div class="d-flex row" style="margin-top: -100px; margin-left: 8%;">
                                        <div class="col-2 d-flex">
                                            <div class="empty-seats">
                                            </div><span class="text-light m">: Ghế trống</span>
                                        </div>

                                        <div class="col-2 d-flex">
                                            <div class="select-seats">
                                            </div> <span class="text-light">: Ghế bạn chọn</span>
                                        </div>

                                        <div class="col-2 d-flex">
                                            <div class="empty_seat_vip">
                                            </div>
                                            <span class="text-light">: Ghế vip trống</span>
                                        </div>

                                        <div class="col-2 d-flex">
                                            <div class="empty_double_seats">
                                            </div>
                                            <span class="text-light">: Ghế đôi còn trống</span>
                                        </div>

                                        <div class="col-2 d-flex">
                                            <div class="sell-seats">
                                            </div>
                                            <span class="text-light">: Ghế đã bán</span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="cinema-seats1 cinema-seats">
                                            <?php
                                            $rows = range('A', 'L');
                                            $excludedSeats = ['A1', 'A2', 'A14', 'A13', 'B1', 'B14', 'C1', 'C14'];

                                            for ($j = 0; $j < 12; $j++) {
                                            ?>
                                                <div class="cinema-row row-<?php echo $j + 1; ?>" style="margin-left: 15%;">
                                                    <?php
                                                    for ($i = 0; $i < 14; $i++) {
                                                        $seat = $rows[$j] . ($i + 1);
                                                        if (in_array($seat, $excludedSeats)) {
                                                            echo '<span class="empty-seat" style="display:inline-block; width:30px;"></span>';
                                                            continue;
                                                        }

                                                        $isGreenSeat = in_array($rows[$j], ['F', 'G', 'H', 'I', 'J', 'K']) && $i >= 2 && $i <= 11;
                                                        $isDisabled = in_array($seat, array_column($seats_buy, 'location'));
                                                    ?>
                                                        <label class="seat <?php echo $isGreenSeat ? 'seat-vip text-white' : ''; ?>">
                                                            <div class="seat-sub1"></div>
                                                            <?php if ($isDisabled) { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>" disabled>
                                                                <span style="background-color: #000; cursor: not-allowed"><?php echo $seat; ?></span>
                                                            <?php } else { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>" class="checkbox<?php echo $seat; ?>">
                                                                <span class="<?php echo $seat ?> "><?php echo $seat; ?></span>
                                                                <?php if ($isGreenSeat) { ?>
                                                                    <input type="checkbox" name="seat[<?php echo $seat; ?>][price]" id="" value="<?php echo $movie[0]['vip_seat_price'] ?>">
                                                                <?php } else { ?>
                                                                    <input type="checkbox" name="seat[<?php echo $seat; ?>][price]" id="" value="<?php echo $movie[0]['single_seat_price'] ?>">
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <div style="margin-left: 15%;">
                                                <?php for ($i = 1; $i < 8; $i++) {
                                                    $seat = "Z" . $i;
                                                    $isDisabled = in_array($seat, array_column($seats_buy, 'location'));

                                                    if ($isDisabled) {
                                                ?>
                                                        <label class="seat seat_double">
                                                            <input type="checkbox" name="seat[]" value="<?php echo "Z" . $i; ?>" disabled>
                                                            <span style="background-color: #000; cursor: not-allowed"><b><?php echo "Z" . $i; ?></b></span>
                                                        </label>
                                                    <?php } else { ?>
                                                        <label class="seat seat_double">
                                                            <input type="checkbox" name="seat[]" value="<?php echo "Z" . $i; ?>" class="checkboxDB<?php echo $i; ?>">
                                                            <span class="<?php echo "Z" . $i ?>"><b><?php echo "Z" . $i; ?></b></span>
                                                            <input type="checkbox" name="seat[<?php echo $seat; ?>][price]" id="" value="<?php echo $movie[0]['double_seat_price'] ?>">
                                                        </label>
                                                <?php  }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-3">
                    <div class="row">

                        <div class="col-12 col-sm-8 col-lg-12">
                            <div class="item ">
                                <div class="row p-2" style="border-bottom:1px solid #fff ;">
                                    <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movie[0]['poster'] ?>" alt=""
                                        class="col-5 m-2" style="width: 150px;">
                                    <div class="col-5">

                                        <h6 class="text-warning "><?php echo $movie[0]['movie_name'] ?></h6><br>
                                        <span class="text-info"><?php echo $movie[0]['projection_format'] ?></span>
                                    </div>

                                    <div class="col-6">
                                        <span class="text-light"><i class="fa-solid fa-tag"></i> Thể loại:</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-light"><?php echo $movie[0]['genre'] ?></span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-light"><i class="fa-regular fa-clock"></i>Thời lượng:</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-light"><?php echo $movie[0]['duration'] ?> phút</span>
                                    </div>
                                </div>

                                <div class="">
                                    <p class="text-info"><i class="fa-solid fa-film m-1 mt-2"></i><b>Rạp chiếu : <?php echo $cinema[0]['cinema_name'] ?></b>
                                    </p>
                                    <span class="text-light"><i class="fa-solid fa-calendar-days m-1"></i>Thời gian: <?php echo substr($movie[0]['start_time'], 0, 5)  . ' - ' . substr($movie[0]['end_time'], 0, 5) . ', ' . date('d/m/Y', strtotime($movie[0]['show_date']));  ?>
                                    </span><br>
                                    <span class="text-light"><i class="fa-solid fa-tv m-1"></i>Phòng chiếu: <?php echo $cinema[0]['room_name'] ?>
                                    </span><br><br>
                                </div>
                                <div class="">
                                    <span class="text-light count_seat_buy">Ghế ngồi: </span><br>
                                    <label for="" class="text-light">Tổng tiền : </label><input class="text-light total" name="total" type="text" readonly value=" 0 " style="background: 0;border: none;">


                                </div>

                                <input type="submit" value="Tiếp tục" class="btn btn-primary">
                                <input type="reset" value="reset" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</form>
<script>
    var a = <?php echo $movie[0]['single_seat_price'] ?>;
    var b = <?php echo $movie[0]['vip_seat_price'] ?>;
    var c = <?php echo $movie[0]['double_seat_price'] ?>;
</script>

<script src="<?php echo _WEB_ROOT ?>/public/client/rooms/js/roomBig.js"></script>
<script>
    function checkSeats() {

        const seats = document.querySelectorAll('input[name="seat[]"]:checked');
        var countSeatTM = <?php echo json_encode($_POST['tn']); ?>;
        var countSeatTDB = <?php echo json_encode($_POST['tdb']); ?>;
        var countSeatTVIP = <?php echo json_encode($_POST['tv']); ?>;
        var sum = parseInt(countSeatTM) + parseInt(countSeatTDB) + parseInt(countSeatTVIP);
        if (seats.length === 0) {
            alert("Vui lòng chọn ghế!");
            return false;
        } else if (sum > seats.length) {
            alert("Vui lòng chọn đủ số lượng ghế!");
            return false;
        }
        return true;
    }
</script>

<script>
    function applySeatConfig(start, end, limit, count, regex, include, isDB = false) {
        for (let i = start; i <= end; i++) {
            let letter = String.fromCharCode(i);
            for (let j = 1; j <= limit; j++) {
                let maxseat = `${letter}${j}`;
                let seatElement = document.querySelector(`.${maxseat}`);
                let checkbox = isDB ? document.querySelector(`.checkboxDB${j}`) : document.querySelector(`.checkbox${maxseat}`);
                if (count == 0 && seatElement && regex.test(maxseat) === include) {
                    seatElement.classList.add('maxSeat');
                    checkbox.disabled = true;
                }
            }
        }
    }

    // thường
    applySeatConfig(65, 76, 14, <?php echo json_encode($_POST['tn']); ?>, /^[F-K](?:[3-9]|1[0-2])$/, false);

    // vip
    applySeatConfig(65, 76, 14, <?php echo json_encode($_POST['tv']); ?>, /^[F-K](?:[3-9]|1[0-2])$/, true);

    // db
    applySeatConfig(90, 90, 10, <?php echo json_encode($_POST['tdb']); ?>, /^Z/, true, true);



    document.querySelectorAll('input[type="checkbox"][name="seat[]"]').forEach(function(seatCheckbox) {
        seatCheckbox.addEventListener('change', function() {

            let totalSelectedSeats = 0;
            let selectedSeatValues = [];
            var check = false;
            const selectedSeats = document.querySelectorAll('input[type="checkbox"][name="seat[]"]:checked');
            selectedSeats.forEach(function(seat) {
                var seatVal = seat.value;
                totalSelectedSeats++;
                if (!selectedSeatValues.includes(seatVal)) {
                    selectedSeatValues.push(seatVal);
                }

            });

            let selectedChangeSeatValues = [];
            selectedSeats.forEach(function(seat) {
                var seatVal = seat.value;
                if (!selectedChangeSeatValues.includes(seatVal)) {
                    selectedChangeSeatValues.push(seatVal);
                }
            });

            var countSeatTM = <?php echo json_encode($_POST['tn']); ?>;
            var countSeatTDB = <?php echo json_encode($_POST['tdb']); ?>;
            var countSeatTVIP = <?php echo json_encode($_POST['tv']); ?>;

            var SeatTM = 0,
                SeatTDB = 0,
                SeatVIP = 0;

            const regex = /^[F-K](?:[3-9]|1[0-2])$/;
            const regexZ = /^Z/;

            selectedChangeSeatValues.forEach(seat => {
                if (regex.test(seat) && SeatVIP < countSeatTVIP) {
                    SeatVIP++;
                } else if (regexZ.test(seat) && SeatTDB < countSeatTDB) {
                    SeatTDB++;
                } else if (SeatTM < countSeatTM) {
                    SeatTM++;
                }
            });

            for (let i = 65; i <= 90; i++) {
                let letter = String.fromCharCode(i);
                for (let j = 1; j <= 50; j++) {
                    let maxseat = `${letter}${j}`;
                    let seatElement = document.querySelector(`.${maxseat}`);
                    var checkbox = document.querySelector(`.checkbox${maxseat}`);
                    var checkboxDB = document.querySelector(`.checkboxDB${j}`);

                    if (seatElement && !selectedSeatValues.includes(maxseat)) {
                        let isMaxSeat =
                            (regex.test(maxseat) && SeatVIP >= countSeatTVIP) ||
                            (regexZ.test(maxseat) && SeatTDB >= countSeatTDB) ||
                            (!regex.test(maxseat) && !regexZ.test(maxseat) && SeatTM >= countSeatTM);

                        seatElement.classList.toggle('maxSeat', isMaxSeat);

                        if (checkbox && SeatVIP >= countSeatTVIP) {
                            if (regex.test(maxseat)) {
                                checkbox.disabled = true;
                            }
                        } else if (checkbox && SeatVIP < countSeatTVIP) {
                            if (regex.test(maxseat)) {
                                checkbox.disabled = false;
                            }
                        }
                        if (checkbox && SeatTM >= countSeatTM) {
                            if (!regex.test(maxseat)) {
                                checkbox.disabled = true;
                            }
                        } else if (checkbox && SeatTM < countSeatTM) {
                            if (!regex.test(maxseat)) {
                                checkbox.disabled = false;
                            }
                        }
                        if (checkboxDB && SeatTDB >= countSeatTDB) {
                            if (regexZ.test(maxseat)) {
                                checkboxDB.disabled = true;
                            }
                        } else if (checkboxDB && SeatTDB < countSeatTDB) {
                            if (regexZ.test(maxseat)) {
                                checkboxDB.disabled = false;
                            }
                        }
                    }
                }
            }





            // if (check == true) {
            //     setTimeout(function() {
            //         alert('Bạn chỉ được phép chọn tối đa 6 ghế');
            //     }, 200);
            // }





            const seatValue = this.value;
            const priceCheckbox = document.querySelector(`input[type="checkbox"][name="seat[${seatValue}][price]"]`);

            if (priceCheckbox) {

                priceCheckbox.checked = this.checked;
            }
        });
    });
</script>
<script>
    function closeCard() {
        const card = document.querySelector('.card');
        card.style.display = 'none';
    }
</script>
<script>
    window.onload = function() {
        document.getElementById("myForm").reset();
    }
</script>
<script>
    window.onload = function() {
        document.getElementById("myForm").reset();
    }
</script>