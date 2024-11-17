<div class="container py-5" style="margin-top: 40px;">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <!-- Card Container -->
            <div class="card border-0 shadow-lg rounded-4">
                <!-- Card Header -->
                <div class="card-header bg-gradient-to-r from-blue-500 to-teal-500 text-white text-center py-1">
                    <h5 class="display-6 fw-bold text-danger mb-0">Thông Báo Đổi Vé Thành Công</h5>
                </div>

                <!-- Card Body with Scroll -->
                <div class="card-body px-5 py-4" style="max-height: 500px; overflow-y: auto;">
                    <div class="mb-2">
                        <p class="lead text-dark">Kính gửi Quý Khách Hàng,</p>
                        <p class="text-muted">Chúng tôi thông báo rằng yêu cầu đổi vé của Quý khách đã được xử lý thành công.
                            <b class="text-danger">Vé đã được gửi về email của bạn</b>.
                            Cảm ơn Quý khách đã tin tưởng lựa chọn dịch vụ của chúng tôi.
                        </p>
                    </div>

                    <div class="border-top pt-4 mt-2">
                        <h5 class="text-dark">Thông Tin Vé Mới:</h5>
                        <ul class="list-unstyled">
                            <li><strong>Tên phim:</strong> <span class="text-muted"><?php echo $_POST['movie_name'] ?></span></li>
                            <li><strong>Thời gian:</strong> <span class="text-muted"><?php echo $_POST['time'] ?></span></li>
                            <li><strong>Số ghế:</strong> <span class="text-muted">
                                    <?php foreach ($_POST['seat'] as $seat => $value) {
                                        if (!is_numeric($seat)) {
                                            echo $seat . ". ";
                                        }
                                    } ?>
                                </span></li>

                        </ul>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted">Chúng tôi xin lưu ý rằng vé cũ đã bị hủy và không còn hiệu lực. Quý khách vui lòng sử dụng vé mới vào đúng giờ chiếu đã thay đổi.</p>
                        <p class="text-muted">Để đảm bảo chính xác, Quý khách vui lòng kiểm tra kỹ thông tin vé mới trước khi đến rạp. Vé mới có hiệu lực ngay lập tức và có thể được sử dụng ngay cho suất chiếu đã thay đổi.</p>
                    </div>

                    <div class="mt-4">
                        <h5 class="text-dark">Phương Thức Nhận Vé:</h5>
                        <ul class="list-unstyled">
                            <li><strong>Vé điện tử:</strong> <span class="text-muted">Vé có thể được tải qua email của quý khách .</span></li>
                            <li><strong>Vé giấy:</strong> <span class="text-muted">Quý khách có thể đến trực tiếp quầy vé để nhận vé giấy mới trước giờ chiếu ít nhất 30 phút.</span></li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h5 class="text-dark">Điều Kiện Đổi Vé:</h5>
                        <p class="text-muted">Vé có thể được đổi trước 24h chiếu. Đổi vé chỉ áp dụng cho các suất chiếu có cùng mức giá. Lưu ý rằng vé cho sự kiện đặc biệt, chương trình khuyến mãi hoặc vé giảm giá có thể không áp dụng chính sách đổi vé.</p>
                    </div>

                    <div class="mt-2 mb-3">
                        <h5 class="text-dark">Liên Hệ Hỗ Trợ:</h5>
                        <ul class="list-unstyled">
                            <li><strong>Số điện thoại:</strong>0369200219</li>
                            <li><strong>Email:</strong> support@hotflix-vn.com</li>
                            <li><strong>Giờ làm việc:</strong>8h - 17h, thứ 2 đến thứ 6</li>
                        </ul>
                    </div>

                    <p class="text-muted">Chúng tôi xin chân thành cảm ơn Quý khách đã tin tưởng và lựa chọn dịch vụ của chúng tôi. Chúc Quý khách có một buổi xem phim thú vị và trọn vẹn!</p>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-light text-center ">
                    <a href="mailto:[Email]" class=" rounded-pill px-5">Liên Hệ Hỗ Trợ</a>
                </div>
            </div>
        </div>
    </div>
</div>