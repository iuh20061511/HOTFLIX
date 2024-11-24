<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/book/css/book.css">

<form action="check-ttoan-pnhom.html" method="POST">
    <section class="content" style="margin-top: 150px;">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8">

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
                        <div class="timer mb-3 text-center shadow-sm p-3 bg-body rounded"></div>

                        <table>
                            <th> <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $_POST['image'] ?>"
                                    class="card-img-top movie-poster"></th>
                            <th>
                                <div class="m-3">
                                    <h5 class="card-title">Phim: <?php echo $_POST['movie_name'] ?></h5>
                                </div>

                        </table>

                        <div class="card-body">
                            <hr>
                            <div id="selected-combos">
                                <?php
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
                                    class="text-danger" id="total-price"><?php echo $_POST['total'] ?></span></p>


                            <div class="d-flex justify-content-between">
                                <input type="hidden" name="id_movie" value="<?php echo $_POST['id_movie'] ?>">
                                <input type="hidden" name="id_room" value="<?php echo  $_POST['id_room'] ?>">
                                <input type="hidden" name="total" value="<?php echo  $_POST['total'] ?>">
                                <input type="hidden" name="date" value="<?php echo $_POST['date'] ?>">
                                <input type="hidden" name="time" value="<?php echo $_POST['time'] ?>">





                                <button class="btn btn-primary">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>


<script src="<?php echo _WEB_ROOT ?>/public/client/book/js/book.js"></script>
<script src="<?php echo _WEB_ROOT ?>/public/client/book/js/time.js"></script>
<?php if ($_SESSION['is_login']['id_role'] == 1) { ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const paymentButton = document.querySelector(".btn-primary");

            paymentButton.addEventListener("click", function(event) {
                const momoOption = document.getElementById("momo");
                const ATM = document.getElementById("ATM");
                const vnpayOption = document.getElementById("vnpay");

                if (!momoOption.checked && !vnpayOption.checked && !ATM.checked) {
                    event.preventDefault();
                    alert("Vui lòng chọn một phương thức thanh toán.");
                    return;
                }



            });
        });
    </script>
<?php } ?>