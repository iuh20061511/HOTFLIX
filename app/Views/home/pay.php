<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/book/css/book.css">

<section class="content" style="margin-top: 150px;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <!-- Khuyến mãi -->
                <form action="pay.html" method="post">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Khuyến mãi</h5>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mã khuyến mãi" id="promoCode" name="promoCode">
                                <p class="text-danger"><b><?php if (isset($check_promotions)) {
                                                                echo $check_promotions;
                                                            } ?></b></p>
                                <p class="text-primary"><b><?php if (isset($check_promotions_true)) {
                                                                echo $check_promotions_true;
                                                            } ?></b></p>
                                <input type="hidden" name="image" value="<?php echo $image ?>">
                                <?php if (isset($_POST['image'])) $image  == $_POST['image'] ?>
                                <input type="hidden" name="movie_name" value="<?php echo $movie_name ?>">
                                <?php if (isset($_POST['movie_name'])) $movie_name  == $_POST['movie_name'] ?>
                                <input type="hidden" name="projection_format" value="<?php echo $projection_format ?>">
                                <?php if (isset($_POST['projection_format'])) $projection_format  == $_POST['projection_format'] ?>
                                <input type="hidden" name="cinema" value="<?php echo $cinema ?>">
                                <?php if (isset($_POST['cinema'])) $cinema  == $_POST['cinema'] ?>
                                <input type="hidden" name="time" value="<?php echo $time ?>">
                                <?php if (isset($_POST['time'])) $time  == $_POST['time'] ?>
                                <input type="hidden" name="seats" value="<?php echo $seats ?>">
                                <?php if (isset($_POST['seats'])) $seats  == $_POST['seats'] ?>
                                <input type="hidden" name="total" value="<?php echo $total ?>">
                                <?php if (isset($_POST['total'])) $total  == $_POST['total'] ?>
                                <input type="hidden" name="id_showtime" value="<?php echo $id_showtime ?>">
                                <?php if (isset($_POST['id_showtime'])) $id_showtime  == $_POST['id_showtime'] ?>
                                <input type="hidden" name="id_movie" value="<?php echo $id_movie ?>">
                                <?php if (isset($_POST['id_movie'])) $id_movie  == $_POST['id_movie'] ?>
                                <input type="hidden" name="id_room" value="<?php echo $id_room ?>">
                                <?php if (isset($_POST['id_room'])) $id_room  == $_POST['id_room'] ?>
                            </div>
                            <button class="btn btn-success mt-2">Áp Dụng</button>
                        </div>
                    </div>
                </form>
                <form action="thanh-toan.html" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">

                    <?php if ($_SESSION['is_login']['id_role'] == 1) { ?>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Phương thức thanh toán</h5>


                                <div class="form-check m-3">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/momo.png" alt=""
                                        style="width: 40px;">
                                    <input class="form-check-input" type="radio" name="payment" id="momo" value="momo">
                                    <label class="form-check-label" for="momo">
                                        Ví Điện Tử MoMo
                                    </label>
                                </div>
                                <div class="form-check m-3">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/ATM_momo.jpg" alt=""
                                        style="width: 40px;">
                                    <input class="form-check-input" type="radio" name="payment" id="ATM" value="ATM">
                                    <label class="form-check-label" for="momo">
                                        ATM MoMo
                                    </label>
                                </div>
                                <div class="form-check m-3">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/zalopay.webp" alt=""
                                        style="width: 40px;">
                                    <input class="form-check-input" type="radio" name="payment" id="zalopay" value="zalopay">
                                    <label class="form-check-label" for="zalopay">
                                        ZaloPay - Bạn mới ZaloPay nhập mã GLX50 - Giảm 50k cho đơn từ 200k
                                    </label>
                                </div>
                                <div class="form-check m-3">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/vnpay.png" alt=""
                                        style="width: 40px;">
                                    <input class="form-check-input" type="radio" name="payment" id="vnpay" value="vnpay">
                                    <label class="form-check-label" for="vnpay">
                                        VNPAY
                                    </label>
                                </div>



                                <small class="form-text text-muted mt-3"><span class="text-danger">(*)</span> Bằng việc
                                    click/chạm vào THANH TOÁN, bạn đã xác
                                    nhận hiểu rõ các Quy Định Giao Dịch Trực Tuyến của FLIXGO.</small>
                            </div>
                        </div>
                    <?php } ?>
            </div>

            <div class="col-md-4">

                <div class="card ">
                    <div class="timer mb-3 text-center shadow-sm p-3 bg-body rounded">Thời gian giữ ghế:<span id="countdown"></span></div>

                    <table>
                        <th> <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $image ?>"
                                class="card-img-top movie-poster"></th>
                        <?php $_SESSION['back']['image']  = $image ?>
                        <th>
                            <div class="m-3">
                                <h5 class="card-title"><?php echo $movie_name ?></h5>
                                <?php $_SESSION['back']['movie_name']  = $movie_name ?>
                                <p class="card-text"><?php echo $projection_format ?></p>
                                <?php $_SESSION['back']['projection_format']  = $projection_format ?>

                            </div>

                    </table>



                    <div class="card-body">

                        <p><?php echo $cinema ?></p>
                        <?php $_SESSION['back']['cinema']  = $cinema ?>

                        <p>Suất: <?php echo $time ?></p>
                        <?php $_SESSION['back']['time']  = $time ?>

                        <hr>
                        <p>Ghế: <?php echo $seats ?></p>
                        <?php $_SESSION['back']['seats']  = $seats ?>

                        <hr>
                        <div id="selected-combos">
                            <?php
                            if (isset($_POST['item'])) {
                                $_SESSION['back']['item']  = $_POST['item'];
                                foreach ($_POST['item'] as $item) {
                                    if ($item['quantity'] > 0) {
                            ?>
                                        <p><?php echo 'x' . $item['quantity'] .  ' '  . $item['name_item'] ?></p>
                                        <input type="hidden" name="id_item[<?php echo $item['id_item']  ?>]" value="<?php echo $item['quantity']  ?>">

                                    <?php }
                                }
                            } else {
                                foreach ($_SESSION['back']['item'] as $item) {
                                    if ($item['quantity'] > 0) {
                                    ?>
                                        <p><?php echo 'x' . $item['quantity'] .  ' '  . $item['name_item'] ?></p>
                                        <input type="hidden" name="id_item[<?php echo $item['id_item']  ?>]" value="<?php echo $item['quantity']  ?>">

                                <?php }
                                } ?>

                            <?php   }
                            ?>
                        </div>
                        <hr>
                        <p class="d-flex justify-content-between"><strong>Tổng cộng</strong> <span
                                class="text-danger" id="total-price"><?php echo $total ?></span></p>
                        <?php $_SESSION['back']['total']  = $total ?>
                        <p class="d-flex justify-content-between"><strong>Giảm giá</strong> <span
                                class="text-danger" id="total-price"><?php if (isset($discount)) {
                                                                            echo $discount;
                                                                        } else {
                                                                            echo "0 ₫";
                                                                        } ?></span></p>
                        <?php $_SESSION['back']['discount']  = $total ?>

                        <p class="d-flex justify-content-between"><strong>Tiền phải trả</strong> <span
                                class="text-danger" id="total-price"><?php if (isset($total_after_discount)) {
                                                                            echo $total_after_discount;
                                                                        } else {
                                                                            echo $total;
                                                                        } ?></span></p>
                        <?php $_SESSION['back']['total_after_discount']  = $total ?>

                        <div class="d-flex justify-content-between">
                            <input type="hidden" name="id_showtime" value="<?php echo $id_showtime ?>">
                            <?php $_SESSION['back']['id_showtime']  = $id_showtime ?>

                            <input type="hidden" name="id_movie" value="<?php echo $id_movie ?>">
                            <?php $_SESSION['back']['id_movie']  = $id_movie ?>

                            <input type="hidden" name="id_room" value="<?php echo  $id_room ?>">
                            <?php $_SESSION['back']['id_room']  = $id_room  ?>

                            <input type="hidden" name="seats" value="<?php echo  $seats ?>">
                            <?php $_SESSION['back']['seats']  = $seats ?>

                            <input type="hidden" name="total" value="<?php echo  $total ?>">

                            <input type="hidden" name="discount" value="<?php if (isset($discount)) {
                                                                            echo $discount;
                                                                        } else {
                                                                            echo "0";
                                                                        }  ?>">

                            <input type="hidden" name="total_after_discount" value="<?php if (isset($total_after_discount)) {
                                                                                        echo $total_after_discount;
                                                                                    } else {
                                                                                        echo $total;
                                                                                    } ?>">


                            <button class="btn btn-primary">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</form>
<?php
$hod =  $hold_chairs[0]['hold_expiry'];
$targetTime = strtotime($hod);
$currentTime = time();
$timeDifferenceInSeconds = $targetTime - $currentTime;
$_SESSION['hold_expiry_location'] = $hold_chairs[0]['location'];
$_SESSION['hold_expiry_id_showTime'] = $hold_chairs[0]['id_showTime'];

?>
<script>
    var time = <?php echo $timeDifferenceInSeconds ?>
</script>

<script src="<?php echo _WEB_ROOT ?>/public/client/book/js/book.js"></script>
<script src="<?php echo _WEB_ROOT ?>/public/client/book/js/time.js"></script>
<?php if ($_SESSION['is_login']['id_role'] == 1) { ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const paymentButton = document.querySelector(".btn-primary");

            paymentButton.addEventListener("click", function(event) {
                const momoOption = document.getElementById("momo");
                const ATM = document.getElementById("ATM");

                const zalopayOption = document.getElementById("zalopay");
                const vnpayOption = document.getElementById("vnpay");

                if (!momoOption.checked && !zalopayOption.checked && !vnpayOption.checked && !ATM.checked) {
                    event.preventDefault();
                    alert("Vui lòng chọn một phương thức thanh toán.");
                    return;
                }

                if (zalopayOption.checked) {
                    event.preventDefault();
                    alert("Hiện tại chưa hỗ trợ thanh toán qua ZaloPay.");
                }
                if (vnpayOption.checked) {
                    event.preventDefault();
                    alert("Hiện tại chưa hỗ trợ thanh toán qua VNPay.");
                }
            });
        });
    </script>
<?php } ?>