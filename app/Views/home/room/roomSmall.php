<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/rooms/css/roomAgv.css">


<form action="" method="GET">

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
        <div class="container">
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
                                            for ($j = 0; $j < 12; $j++) { ?>
                                                <div class="cinema-row row-<?php echo $j + 1; ?>" style="margin-left: 15%;">
                                                    <?php for ($i = 0; $i < 14; $i++) {
                                                        $seat = $rows[$j] . ($i + 1);
                                                        $isGreenSeat = in_array($rows[$j], ['F', 'G', 'H', 'I', 'J', 'K']) && $i >= 2 && $i <= 11;
                                                        ?>
                                                        <label
                                                            class="seat <?php echo $isGreenSeat ? 'seat-vip text-white' : ''; ?>">
                                                            <div class="seat-sub1"></div>
                                                            <input type="checkbox" name="seat[]" value="<?php echo $seat; ?>">
                                                            <span><?php echo $seat; ?></span>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <div style="margin-left: 15%;">
                                                <?php for ($i = 1; $i < 8; $i++) { ?>
                                                    <label class="seat seat_double">
                                                        <input type="checkbox" name="seat_double[]"
                                                            value="<?php echo "DB" . $i; ?>">
                                                        <span><b><?php echo "DB" . $i ?></b></span>
                                                    </label>
                                                <?php } ?>
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
                                    <img src="<?php echo _WEB_ROOT ?>/public/assets/img/covers/7.png" alt=""
                                        class="col-5 m-2" style="width: 150px;">
                                    <div class="col-5">
                                        <h6 class="text-warning "> Phim Shin Cậu Bé Bút Chì: Nhật Ký Khủng Long Của
                                            Chúng Mình</h6><br>
                                        <span class="text-info">2D Lồng tiếng</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="text-light"><i class="fa-solid fa-tag"></i> Thể loại:</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-light">Kinh dị</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-light"><i class="fa-regular fa-clock"></i>Thời lượng:</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-light">135 phút</span>
                                    </div>
                                </div>

                                <div class="">
                                    <p class="text-info"><i class="fa-solid fa-film m-1"></i><b>Rạp chiếu : Hồ Chí
                                            Minh</b>
                                    </p>
                                    <span class="text-light"><i class="fa-solid fa-calendar-days m-1"></i>Thời gian: 18h
                                        17/08/2024
                                    </span><br>
                                    <span class="text-light"><i class="fa-solid fa-tv m-1"></i>Phòng chiếu: P12
                                    </span><br><br>
                                </div>
                                <div class="">
                                    <span class="text-light count_seat_buy">Ghế ngồi: </span><br>
                                    <p class="text-light total">Tổng tiền: </p>
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
    var a = 50000;
    var b = 70000;
    var c = 130000;
</script>

<script src="<?php echo _WEB_ROOT ?>/public/client/rooms/js/roomBig.js"></script>