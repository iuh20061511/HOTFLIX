
    <!-- page title -->
	<section class="section section--first section--bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/cinema/10/cinema1.jpg">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title section__title--head">Thuê phòng rạp / Tổ chức sự kiện</h1>
						<!-- end section title -->

						<!-- breadcrumbs -->
						<ul class="breadcrumbs">
							<li class="breadcrumbs__item"><a href="trang-chu.html">Home</a></li>
							<li class="breadcrumbs__item breadcrumbs__item--active">Thuê phòng</li>
						</ul>
						<!-- end breadcrumbs -->
					</div>
				</div>
			</div>
            <div class="row">
				<div class="col-8">
                    <p class="section__text text-white" style="text-align:justify">Chào mừng bạn đến với <b>Hotflix</b>. Bạn đang tìm kiếm một không gian sang trọng và chuyên nghiệp để tổ chức sự kiện công ty? Để họp mặt đối tác, ra mắt sản phẩm mới, hay tổng kết cuối năm? Dịch vụ thuê phòng chiếu tại rạp phim của chúng tôi sẽ mang đến cho doanh nghiệp bạn không gian hoàn hảo nhất!</p>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

    <!-- content -->
    <section class="content">
        <div class="content__head mb-5">
            <div class="container">
                <div class="row">
                <h2 class="content__title">THUÊ PHÒNG NGAY!</h2>
                    <div class="col-12 d-flex justify-content-center">
                        <!-- content tabs nav -->
                        <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Chọn rạp & phòng</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="2-tab" role="tab" aria-controls="tab-2" aria-selected="false">Chọn khung giờ</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="3-tab" type="button" role="tab" aria-controls="tab-3" aria-selected="false">Thanh toán</button>
                            </li>
                        </ul>
                        <!-- end content tabs nav -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- content tabs -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
                            <div class="row">
                               <!-- Chọn rạp -->
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="" method='post' id="chooseCinema" style="width: 45%;">
                                        <div>
                                            <label for="cinema-select" class="text-white me-2">Chọn Rạp:</label>
                                            <select id="cinema-select" class="form-control sign__select mb-2" name="select_cinema" onchange="this.form.submit()" style="border-color: #ff55a5;">
                                            <?php
                                                $cinemaName = 'Chọn rạp - nơi thuê phòng';
                                                $selectedCinemaId = isset($_POST['select_cinema']) ? $_POST['select_cinema'] : 0;

                                                // Nếu đã chọn rạp
                                                if ($selectedCinemaId) {
                                                    foreach ($listCinema as $cinema) {
                                                        if ($cinema['id_cinema'] == $selectedCinemaId) {
                                                            $cinemaName = $cinema['cinema_name'];
                                                            break;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <option value="<?php echo $selectedCinemaId; ?>"><?php echo $cinemaName; ?>
                                                </option>
                                                <?php foreach ($listCinema as $cinema): ?>
                                                    <?php if ($cinema['id_cinema'] != $selectedCinemaId): ?>
                                                        <option value="<?php echo $cinema['id_cinema']; ?>">
                                                            <?php echo $cinema['cinema_name']; ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php if(isset($_POST['select_cinema'])) : ?>
                                            <div style="display: block;" class="mt-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="text-white me-2">Chọn ngày thuê:</label>
                                                        <input type="date" class="form-control sign__input" name="dateRent" style="border-color: #ff55a5;" value="<?php echo isset($_POST['dateRent']) ? $_POST['dateRent'] : ''; ?>">
                                                    </div>
                                                    <?php if (isset($error['dateRent'])): ?>
                                            		    <p class="error text-danger"><?php echo $error['dateRent']; ?></p>
                                        		    <?php endif; ?>
                                                </div>
                                                <div class="row sign__group mt-2">
                                                    <label for="" class="text-white me-2">Phòng cần thuê:</label>
                                                    <?php foreach ($listRoom as $room): ?>
                                                    <div class="col-lg-4 col-md-6 col-12 mt-3">
                                                        <div class="sign__radio" style="border: 1px solid #ff55a5; padding:5px; border-radius: 15px;" >
                                                            <input id="<?php echo $room['id_room']?>" type="radio" name="room" value="<?php echo $room['id_room']?>"
                                                            <?php
                                                                if(isset($_POST['room']) && $_POST['room']==$room['id_room']){
                                                                    echo 'checked';
                                                                }
                                                            ?>
                                                            >
                                                            <label for="<?php echo $room['id_room']?>"><?php echo $room['room_name']?></label>
                                                            <div class="mt-2">
                                                                <p class="text-white m-0">Loại: <?php echo $room['RoomType_name']?></p>
                                                                <p class="text-white m-0">Sức chứa: <?php echo $room['number_seat']?> ghế</p>
                                                                <?php if ($room['id_roomType'] == 1): ?>
                                                                    <p class="text-white m-0">Giá: 800.000đ/giờ</p>
                                                                <?php elseif ($room['id_roomType'] == 2): ?>
                                                                    <p class="text-white m-0">Giá: 400.000đ/giờ</p>
                                                                <?php elseif ($room['id_roomType'] == 3): ?>
                                                                    <p class="text-white m-0">Giá: 500.000đ/giờ</p>
                                                                <?php elseif ($room['id_roomType'] == 4): ?>
                                                                    <p class="text-white m-0">Giá: 600.000đ/giờ</p>
                                                                <?php elseif ($room['id_roomType'] == 5): ?>
                                                                    <p class="text-white m-0">Giá: 700.000đ/giờ</p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php if (isset($error['room'])): ?>
                                            		    <p class="error text-danger"><?php echo $error['room']; ?></p>
                                        		    <?php endif; ?>
                                                </div>
                                                <div class="col-12 mt-3 d-flex justify-content-center">
                                                    <input type="submit" value="Tiếp tục" id="continueChooseTime" class="sign__btn sign__btn--small"
                                                        name="continueChooseTime">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end content tabs -->
                </div>
            </div>
        </div>
    </section>
    	<!-- how it works -->
	<section class="section section--dark">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<h2 class="section__title">Vì sao nên chọn thuê phòng chiếu tại HOTFLIX?</h2>
				</div>
				<!-- end section title -->

				<!-- how box -->
				<div class="col-12 col-lg-4">
					<div class="how">
						<span class="how__number">01</span>
						<h3 class="how__title">Không gian đẳng cấp:</h3>
						<p class="how__text" style="text-align:justify">- Phòng chiếu hiện đại với hệ thống âm thanh, hình ảnh chất lượng cao sẽ tạo ấn tượng mạnh mẽ cho đối tác và nhân viên.</p>
					</div>
				</div>
				<!-- ebd how box -->

				<!-- how box -->
				<div class="col-12 col-lg-4">
					<div class="how">
						<span class="how__number">02</span>
						<h3 class="how__title">Sức chứa linh hoạt:</h3>
						<p class="how__text text-justify" style="text-align:justify">- Phòng chiếu có sức chứa từ 50 đến 300 người, phù hợp cho mọi quy mô sự kiện.</p>
					</div>
				</div>
				<!-- ebd how box -->

				<!-- how box -->
				<div class="col-12 col-lg-4">
					<div class="how">
						<span class="how__number">03</span>
						<h3 class="how__title">Thiết bị công nghệ hiện đại:</h3>
						<p class="how__text" style="text-align:justify">- Máy chiếu độ phân giải cao, âm thanh Dolby sống động giúp bạn truyền tải thông điệp một cách rõ ràng và chuyên nghiệp nhất.</p>
					</div>
				</div>
				<!-- ebd how box -->

                <div class="col-12 col-lg-4">
					<div class="how">
						<span class="how__number">04</span>
						<h3 class="how__title">Dịch vụ hỗ trợ tận tâm:</h3>
						<p class="how__text" style="text-align:justify">- Đội ngũ của chúng tôi sẽ hỗ trợ toàn bộ khâu chuẩn bị từ trang trí, set up âm thanh, ánh sáng cho đến phục vụ tiệc trà, snack.</p>
					</div>
				</div>

                <div class="col-12 col-lg-4">
					<div class="how">
						<span class="how__number">05</span>
						<h3 class="how__title">Tính linh hoạt cao:</h3>
						<p class="how__text" style="text-align:justify">- Dễ dàng tùy chỉnh phòng chiếu để phù hợp với mục đích của sự kiện, từ hội nghị, đào tạo nhân viên, hội thảo đến trình chiếu phim, video quảng cáo.</p>
					</div>
				</div>

                <div class="col-12 col-lg-4">
					<div class="how">
						<span class="how__number">06</span>
						<h3 class="how__title">Lợi ích dành riêng cho doanh nghiệp:</h3>
						<p class="how__text" style="text-align:justify">- Tạo ấn tượng mạnh với khách hàng và đối tác trong một không gian đẳng cấp.</p>
						<p class="how__text" style="text-align:justify">- Nâng cao tinh thần nhân viên với những sự kiện nội bộ chuyên nghiệp.</p>
						<p class="how__text" style="text-align:justify">- Ưu đãi đặc biệt cho các doanh nghiệp đăng ký thuê phòng chiếu dài hạn hoặc tổ chức nhiều sự kiện trong năm.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end how it works -->
