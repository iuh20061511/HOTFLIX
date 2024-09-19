<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/book/css/book.css">

<form action="" method="GET">
    <section class="content" style="margin-top: 150px;">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 shadow-lg p-3 mb-5 bg-body rounded action">
                    <h2 class="mb-4">Chọn Combo</h2>
                    <div class="combo-item d-flex align-items-center" data-price="109000"
                        data-name="iCombo 1 Big Extra STD">
                        <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/sp.jpg" alt="iCombo 1 Big Extra STD"
                            class="combo-image me-3">
                        <div class="flex-grow-1">
                            <h5>iCombo 1 Big Extra STD</h5>
                            <p class="mb-0">1 Ly nước ngọt size L + 01 Hộp bắp + 1 Snack</p>
                            <p class="mb-0"><strong>Giá: 109.000 đ</strong></p>
                        </div>
                        <div class="quantity">
                            <button type="button" class="btn btn-outline-secondary btn-sm decrease">-</button>
                            <span class="mx-2 quantity-value">0</span>
                            <button type="button" class="btn btn-outline-secondary btn-sm increase">+</button>
                        </div>
                    </div>

                    <div class="combo-item d-flex align-items-center" data-price="89000" data-name="iCombo 1 Big STD">
                        <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/sp.jpg" alt="iCombo 1 Big STD"
                            class="combo-image me-3">
                        <div class="flex-grow-1">
                            <h5>iCombo 1 Big STD</h5>
                            <p class="mb-0">01 Ly nước ngọt size L + 01 Hộp bắp</p>
                            <p class="mb-0"><strong>Giá: 89.000 đ</strong></p>
                        </div>
                        <div class="quantity">
                            <button type="button" class="btn btn-outline-secondary btn-sm decrease">-</button>
                            <span class="mx-2 quantity-value">0</span>
                            <button type="button" class="btn btn-outline-secondary btn-sm increase">+</button>
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
                            </div>
                            <hr>
                            <p class="d-flex justify-content-between"><strong>Tổng cộng</strong> <span
                                    class="text-danger" id="total-price">80.000 đ</span></p>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary back">Quay lại</button>
                                <button class="btn btn-primary continue">Tiếp tục</button>
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
<script>
    document.querySelector('.continue').addEventListener('click', function (event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút

        // Thay thế nội dung "Chọn Combo" bằng "Khuyến mãi" và "Phương thức thanh toán"
        let newContent = `
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
                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/momo.png" alt="" style="width: 40px;">
                    <input class="form-check-input" type="radio" name="payment" value="mommo" id="momo">
                    <label class="form-check-label" for="momo">Ví Điện Tử MoMo</label>
                </div>
                <div class="form-check m-3">
                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/zalopay.webp" alt="" style="width: 40px;">
                    <input class="form-check-input" type="radio" name="payment" value="zalopay" id="zalopay">
                    <label class="form-check-label" for="zalopay">ZaloPay - Bạn mới ZaloPay nhập mã GLX50 - Giảm 50k cho đơn từ 200k</label>
                </div>
                <div class="form-check m-3">
                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/vnpay.png" alt="" style="width: 40px;">
                    <input class="form-check-input" type="radio" name="payment" value="vnpay" id="vnpay">
                    <label class="form-check-label" for="vnpay">VNPAY</label>
                </div>
            </form>
            <small class="form-text text-muted mt-3"><span class="text-danger">(*)</span> Bằng việc click/chạm vào THANH TOÁN, bạn đã xác nhận hiểu rõ các Quy Định Giao Dịch Trực Tuyến của FLIXGO.</small>
        </div>
    </div>
    `;

        // Thay thế nội dung của phần tử hiện tại
        document.querySelector('.col-md-8.shadow-lg').innerHTML = newContent;

        // Chuyển đổi nút "Tiếp tục" thành "Thanh toán"
        let continueButton = document.querySelector('.btn-primary');
        continueButton.outerHTML = '<input type="submit" class="btn btn-success pay" value="Thanh toán">';

        // Gán lại sự kiện cho nút "Trở lại" sau khi nội dung thay đổi
        document.querySelector('.back').addEventListener('click', function (event) {
            event.preventDefault();
            replaceWithComboContent();
        });
    });

    document.querySelector('.back').addEventListener('click', function (event) {
        event.preventDefault();
        replaceWithComboContent();
    });

    function replaceWithComboContent() {
        // Thay thế nội dung "Chọn Combo"
        let newContent = `
    <h2 class="mb-4">Chọn Combo</h2>
                <div class="combo-item d-flex align-items-center" data-price="109000"
                    data-name="iCombo 1 Big Extra STD">
                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/sp.jpg" alt="iCombo 1 Big Extra STD"
                        class="combo-image me-3">
                    <div class="flex-grow-1">
                        <h5>iCombo 1 Big Extra STD</h5>
                        <p class="mb-0">1 Ly nước ngọt size L + 01 Hộp bắp + 1 Snack</p>
                        <p class="mb-0"><strong>Giá: 109.000 đ</strong></p>
                    </div>
                    <div class="quantity">
                        <button type="button" class="btn btn-outline-secondary btn-sm decrease">-</button>
                        <span class="mx-2 quantity-value">0</span>
                        <button type="button" class="btn btn-outline-secondary btn-sm increase">+</button>
                    </div>
                </div>

                <div class="combo-item d-flex align-items-center" data-price="89000" data-name="iCombo 1 Big STD">
                    <img src="<?php echo _WEB_ROOT ?>/public/client/book/image/sp.jpg" alt="iCombo 1 Big STD"
                        class="combo-image me-3">
                    <div class="flex-grow-1">
                        <h5>iCombo 1 Big STD</h5>
                        <p class="mb-0">01 Ly nước ngọt size L + 01 Hộp bắp</p>
                        <p class="mb-0"><strong>Giá: 89.000 đ</strong></p>
                    </div>
                    <div class="quantity">
                        <button type="button" class="btn btn-outline-secondary btn-sm decrease">-</button>
                        <span class="mx-2 quantity-value">0</span>
                        <button type="button" class="btn btn-outline-secondary btn-sm increase">+</button>
                    </div>
                </div>
    `;

        // Thay thế nội dung của phần tử hiện tại
        document.querySelector('.col-md-8.shadow-lg').innerHTML = newContent;

        // Gán lại sự kiện cho nút "Tiếp tục"
        document.querySelector('.continue').addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelector('.col-md-8.shadow-lg').innerHTML = newContent;
        });
    }

</script>