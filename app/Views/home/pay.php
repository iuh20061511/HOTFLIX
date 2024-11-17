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
                                <input type="text" class="form-control" placeholder="Mã khuyến mãi" id="promoCode">
                            </div>
                            <button class="btn btn-success mt-2" onclick="applyPromoCode(event)">Áp Dụng</button>
                        </div>
                        <script>
                            function applyPromoCode(event) {
                                event.preventDefault();

                                var promoCode = document.getElementById('promoCode').value;
                                var promo = document.getElementById('total-price');
                                var totalAmount = promo.textContent;
                                var numericValue = parseInt(totalAmount.replace(/[^\d]/g, ''));
                                var promotionCodes = <?php echo json_encode(array_column($promotion, 'promotion_code')); ?>;

                                if (promoCode) {
                                    if (promotionCodes.includes(promoCode)) {
                                        var newAmount = numericValue - 10000;
                                        var formattedAmount = newAmount.toLocaleString('vi-VN') + ' đ';
                                        alert('Mã khuyến mãi áp dụng thành công!');
                                        promo.innerHTML = formattedAmount;
                                    } else {
                                        alert('Mã khuyến mãi không hợp lệ!');
                                    }
                                } else {
                                    alert('Vui lòng nhập mã khuyến mãi!');
                                }
                            }
                        </script>


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
                            $_SESSION['back']['item']  = $_POST['item'];
                            foreach ($_POST['item'] as $item) {
                                if ($item['quantity'] > 0) {
                            ?>
                                    <p><?php echo 'x' . $item['quantity'] .  ' '  . $item['name_item'] ?></p>
                                    <input type="hidden" name="id_item[<?php echo $item['id_item']  ?>]" value="<?php echo $item['quantity']  ?>">

                            <?php }
                            }
                            ?>
                        </div>
                        <hr>
                        <p class="d-flex justify-content-between"><strong>Tổng cộng</strong> <span
                                class="text-danger" id="total-price"><?php echo $total ?></span></p>
                        <?php $_SESSION['back']['total']  = $total ?>

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