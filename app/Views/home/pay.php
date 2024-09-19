<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/book/css/book.css">

<form action="" method="GET">
    <section class="content" style="margin-top: 150px;">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8">
                    <!-- Khuyến mãi -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Khuyến mãi</h5>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mã khuyến mãi">
                            </div>
                            <button class="btn btn-success mt-2">Áp Dụng</button>
                        </div>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Phương thức thanh toán</h5>
                            <form>

                                <div class="form-check m-3">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/momo.png" alt=""
                                        style="width: 40px;">
                                    <input class="form-check-input" type="radio" name="payment" id="momo">
                                    <label class="form-check-label" for="momo">
                                        Ví Điện Tử MoMo
                                    </label>
                                </div>
                                <div class="form-check m-3">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/zalopay.webp" alt=""
                                        style="width: 40px;">
                                    <input class="form-check-input" type="radio" name="payment" id="zalopay">
                                    <label class="form-check-label" for="zalopay">
                                        ZaloPay - Bạn mới ZaloPay nhập mã GLX50 - Giảm 50k cho đơn từ 200k
                                    </label>
                                </div>
                                <div class="form-check m-3">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/vnpay.png" alt=""
                                        style="width: 40px;">
                                    <input class="form-check-input" type="radio" name="payment" id="vnpay">
                                    <label class="form-check-label" for="vnpay">
                                        VNPAY
                                    </label>
                                </div>

                            </form>

                            <small class="form-text text-muted mt-3"><span class="text-danger">(*)</span> Bằng việc
                                click/chạm vào THANH TOÁN, bạn đã xác
                                nhận hiểu rõ các Quy Định Giao Dịch Trực Tuyến của FLIXGO.</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="card ">
                        <div class="timer mb-3 text-center shadow-sm p-3 bg-body rounded">Thời gian giữ ghế: <span
                                id="countdown">06:00</span></div>

                        <table>
                            <th> <img src="<?php echo _WEB_ROOT ?>/public/assets/img/covers/12.png"
                                    class="card-img-top movie-poster" alt="Ma Da"></th>
                            <th>
                                <div class="m-3">
                                    <h5 class="card-title">Thám Tử Lừng Danh Conan: Ngôi Sao 5 Cánh 1 Triệu Đô<span
                                            class="age-rating">T16</span></h5>
                                    <p class="card-text">2D Phụ Đề</p>
                                </div>

                        </table>



                        <div class="card-body">

                            <p>Galaxy Nguyễn Du - RAP 3</p>
                            <p>Suất: 17:15 - Thứ Hai, 19/08/2024</p>
                            <hr>
                            <p>1x Người Lớn - Member</p>
                            <p>Ghế: H4</p>
                            <p>80.000 đ</p>
                            <hr>
                            <div id="selected-combos">
                                <!-- Selected combos will be added here dynamically -->
                            </div>
                            <hr>
                            <p class="d-flex justify-content-between"><strong>Tổng cộng</strong> <span
                                    class="text-danger" id="total-price">80.000 đ</span></p>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary">Quay lại</button>
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