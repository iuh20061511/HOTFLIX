<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/rooms/css/roomAgv.css">

<?php if ($_SESSION['is_login']['id_role'] != 1) { ?>
    <div class="container d-flex justify-content-center align-items-center" style="position: absolute; top:40%; z-index: 800;">
        <div class="card p-4" style="width: 400px;  <?php echo $check ? 'display: none;' : ''; ?>">
            <i class="bi bi-x-circle" style="position: absolute; right: 10px; top: 2px; font-size: 20px; cursor: pointer;" onclick="closeCard()"></i>
            <form action="" method="post">
                <h5 class="card-title text-center mb-4">Thông tin khách hàng</h5>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="SĐT hoặc email khách hàng thành viên..." name="info">
                    <span class="text-danger"><?php if (isset($error))  echo $error ?></span>
                </div>
                <input type="submit" class="btn btn-success w-100 mt-3" value="Xác nhận" name="btn_inforCus">
            </form>
        </div>
    </div>
<?php } ?>
<form action="chon-thuc-an.html" method="POST" onsubmit="return checkSeats();">
    <input type="hidden" name="movie_name" value="<?php echo $movie[0]['movie_name'] ?>">
    <input type="hidden" name="image" value="<?php echo $movie[0]['poster'] ?>">
    <input type="hidden" name="cinema" value="<?php echo $cinema[0]['cinema_name'] ?>">
    <input type="hidden" name="projection_format" value="<?php echo $movie[0]['projection_format'] ?>">
    <input type="hidden" name="time" value="<?php echo substr($movie[0]['start_time'], 0, 5)  . ' - ' . substr($movie[0]['end_time'], 0, 5) . ', ' . date('d/m/Y', strtotime($movie[0]['show_date']));  ?>">

    <input type="hidden" name="id_showtime" value="<?php echo $_GET['id_showTime'] ?>">
    <input type="hidden" name="id_movie" value="<?php echo $_GET['id_movie'] ?>">
    <input type="hidden" name="id_room" value="<?php echo $_GET['id_room'] ?>">




    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">

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
                                        <div class="col-2">

                                        </div>

                                        <div class="col-2 d-flex">
                                            <div class="select-seats">
                                            </div> <span class="text-light">: Ghế bạn chọn</span>
                                        </div>

                                        <div class="col-2 d-flex">
                                            <div class="empty_seat_vip">
                                            </div>
                                            <span class="text-light">: Ghế trống</span>
                                        </div>

                                        <div class="col-2 d-flex">
                                            <div class="sell-seats">
                                            </div>
                                            <span class="text-light">: Ghế đã bán</span>
                                        </div>
                                        <div class="col-3">

                                        </div>
                                    </div>
                                    <div class="col-2">
                                    </div>

                                    <div class="col-2">
                                        <div class="cinema-seats1 cinema-seats">
                                            <?php
                                            $rows = range('A', 'L');
                                            for ($j = 0; $j < 6; $j++) { ?>
                                                <div class="cinema-row row-<?php echo $j + 1; ?>">
                                                    <?php for ($i = 0; $i < 2; $i++) {
                                                        $seat = $rows[$j] . ($i + 1);
                                                        $isDisabled = in_array($seat, array_column($seats_buy, 'location'));
                                                    ?>
                                                        <label class="seat seat-vip">
                                                            <div class="seat-sub1"></div>
                                                            <?php if ($isDisabled) { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>" disabled>
                                                                <span style="background-color: #000; cursor: not-allowed"><?php echo $seat; ?></span>
                                                            <?php } else { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>">
                                                                <span><?php echo $seat; ?></span>
                                                                <input type="checkbox" name="seat[<?php echo $seat; ?>][price]" id="" value="<?php echo $movie[0]['vip_seat_price'] ?>">
                                                            <?php } ?>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div class="col-2">
                                        <div class="cinema-seats1 cinema-seats">
                                            <?php
                                            $rows = range('A', 'L');
                                            for ($j = 0; $j < 6; $j++) { ?>
                                                <div class="cinema-row row-<?php echo $j + 1; ?>">
                                                    <?php for ($i = 2; $i < 4; $i++) {
                                                        $seat = $rows[$j] . ($i + 1);
                                                        $isDisabled = in_array($seat, array_column($seats_buy, 'location'));
                                                    ?>
                                                        <label class="seat seat-vip">
                                                            <div class="seat-sub1"></div>
                                                            <?php if ($isDisabled) { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>" disabled>
                                                                <span style="background-color: #000; cursor: not-allowed"><?php echo $seat; ?></span>
                                                            <?php } else { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>">
                                                                <span><?php echo $seat; ?></span>
                                                                <input type="checkbox" name="seat[<?php echo $seat; ?>][price]" id="" value="<?php echo $movie[0]['vip_seat_price'] ?>">
                                                            <?php } ?>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div class="col-2">
                                        <div class="cinema-seats1 cinema-seats">
                                            <?php
                                            $rows = range('A', 'L');

                                            for ($j = 0; $j < 6; $j++) { ?>
                                                <div class="cinema-row row-<?php echo $j + 1; ?>">
                                                    <?php for ($i = 4; $i < 6; $i++) {
                                                        $seat = $rows[$j] . ($i + 1);
                                                        $isGreenSeat = in_array($rows[$j], ['F', 'G', 'H', 'I', 'J', 'K']) && $i >= 2 && $i <= 9;
                                                        $isDisabled = in_array($seat, array_column($seats_buy, 'location'));
                                                    ?>
                                                        <label class="seat seat-vip">
                                                            <div class="seat-sub1"></div>
                                                            <?php if ($isDisabled) { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>" disabled>
                                                                <span style="background-color: #000; cursor: not-allowed"><?php echo $seat; ?></span>
                                                            <?php } else { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>">
                                                                <span><?php echo $seat; ?></span>
                                                                <input type="checkbox" name="seat[<?php echo $seat; ?>][price]" id="" value="<?php echo $movie[0]['vip_seat_price'] ?>">
                                                            <?php } ?>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>


                                    </div>
                                    <div class="col-2">
                                        <div class="cinema-seats1 cinema-seats">
                                            <?php
                                            $rows = range('A', 'L');
                                            for ($j = 0; $j < 6; $j++) { ?>
                                                <div class="cinema-row row-<?php echo $j + 1; ?>">
                                                    <?php for ($i = 6; $i < 8; $i++) {
                                                        $seat = $rows[$j] . ($i + 1);
                                                        $isDisabled = in_array($seat, array_column($seats_buy, 'location'));
                                                    ?>
                                                        <label class="seat seat-vip">
                                                            <div class="seat-sub1"></div>
                                                            <?php if ($isDisabled) { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>" disabled>
                                                                <span style="background-color: #000; cursor: not-allowed"><?php echo $seat; ?></span>
                                                            <?php } else { ?>
                                                                <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>">
                                                                <span><?php echo $seat; ?></span>
                                                                <input type="checkbox" name="seat[<?php echo $seat; ?>][price]" id="" value="<?php echo $movie[0]['vip_seat_price'] ?>">
                                                            <?php } ?>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
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

        if (seats.length === 0) {
            alert("Vui lòng chọn ghế!");
            return false;
        }
        return true;
    }
</script>
<script>
    localStorage.removeItem('endTime');
    localStorage.removeItem('remainingTime');
</script>
<script>
    document.querySelectorAll('input[type="checkbox"][name="seat[]"]').forEach(function(seatCheckbox) {
        seatCheckbox.addEventListener('change', function() {
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