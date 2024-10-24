
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
                                <a href="chon-rap-phong-chieu.html"><button id="1-tab" type="button" role="tab" aria-controls="tab-1" aria-selected="false">Chọn rạp & phòng</button></a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="2-tab" data-bs-toggle="tab" class="active" data-bs-target="#tab-2" type="button" role="tab" aria-controls="tab-2" aria-selected="true">Chọn khung giờ</button>
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
                        <div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
                            <form action="" method='post' id="chooseTime">
                                <div class="row">
                                    <!-- form choose time -->
                                    <div class="col-lg-6 col-12 d-flex justify-content-center align-items-center">
                                        <div class="row">
                                            <label for="" class="text-white me-2">Chọn giờ (chọn ít nhất 3 khung giờ liền kề nhau):</label>
                                            <?php
                                                foreach ($times as $index => $time) {
                                                    $timeStart = explode("-", $time['value'])[0]; // lấy start_time từ value
                                                    $timeEnd = explode("-", $time['value'])[1]; // lấy end_time từ value
                                                    // Mặc định là không disable
                                                    $isDisabled = false;
                                                    // Kiểm tra nếu khung giờ trùng với khoảng thời gian trong $showTimes
                                                    foreach ($showTimes as $showTime) {
                                                        if ($timeStart >= $showTime['start_time'] && $timeEnd <= $showTime['end_time']) {
                                                            $isDisabled = true;
                                                            break; // Nếu đã tìm thấy thời gian trùng, không cần kiểm tra thêm
                                                        }
                                                    }
                                                    $disabledAttr = $isDisabled ? 'disabled' : '';
                                                    $opacityClass = $isDisabled ? 'opacity-50' : '';
                                                    ?>
                                                    <div class="col-lg-3 col-5 m-1" style="border: 1px solid #ff55a5; padding:5px;">
                                                        <div class="form-check">
                                                            <input id="<?php echo $index; ?>" class="form-check-input" type="checkbox" name="timeRent" value="<?php echo $time['value']; ?>" <?php echo $disabledAttr; ?> onchange="updateTimeValue()">
                                                            <label for="<?php echo $index; ?>" class="text-white <?php echo $opacityClass; ?>"><?php echo $time['label']; ?></label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                            <?php if (isset($error['timeRent'])): ?>
                                                <p class="error text-danger"><?php echo $error['timeRent']; ?></p>
                                            <?php endif; ?>
                                            <label for="" class="text-white mt-3">Công ty(nếu có):</label>
                                            <input type="text" class="sign__input" placeholder="Tên công ty" name="company"
                                                value="<?php echo isset($_POST['company']) ? $_POST['company'] : ''; ?>" style="border: 1px solid #ff55a5; width:80%">
                                            <label for="" class="text-white mt-3">Chọn dịch vụ:</label>
                                            <select class="form-control sign__select" name="select_service" style="border-color: #ff55a5;width:80%">
                                                <option value="Sự kiện doanh nghiệp">Sự kiện doanh nghiệp</option>
                                                <option value="Ra mắt sản phẩm - quảng cáo">Ra mắt sản phẩm - quảng cáo</option>
                                                <option value="Lễ kỷ niệm">Lễ kỷ niệm</option>
                                                <option value="Hoạt động từ thiện và sự kiện gây quỹ">Hoạt động từ thiện và sự kiện gây quỹ</option>
                                                <option value="Hoạt động từ thiện và sự kiện gây quỹ">Hoạt động khác</option>
                                            </select>
                                            <label for="" class="text-white mt-3">Ghi chú(nếu có):</label>
                                            <textarea id="text" name="note" class="sign__textarea" placeholder="Ghi chú" style="border: 1px solid #ff55a5; width:80%"><?php echo isset($_POST['note']) ? $_POST['note'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <!-- form choose time -->

                                    <!-- Info invoice -->
                                    <div class="col-lg-6 col-12 d-flex flex-column justify-content-center align-items-left mt-4">
                                        <div class="row d-flex align-items-center" style="border-bottom: 1px solid #ff55a5; border-top: 1px solid #ff55a5;">
                                            <div class="col-12 mt-2">
                                                <h3 class="text-white">Hóa đơn thuê phòng</h3>
                                            </div>
                                        </div>

                                        <div class="row mt-1">
                                            <div class="col-12 m-1">
                                                <h5 class="text-white"><b>Tên rạp: </b><?= $cinemaName[0]['cinema_name']?></h5>
                                                <input type="text" id="idCinema" name="idCinema" value="<?php echo $cinemaName[0]['id_cinema'] ?>" class="sign__input" style="display:none">
                                            </div>
                                        </div>

                                        <div class="row mt-1">
                                            <div class="col-12 m-1">
                                                <h5 class="text-white"><b><?= $roomRent[0]['room_name']?></b> - <?= $roomRent[0]['number_seat']?> ghế</h5>
                                                <input type="text" id="idRoom" name="idRoom" value="<?php echo $roomRent[0]['id_room'] ?>" class="sign__input" style="display:none">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 m-1">
                                                <h5 class="text-white"><b>Ngày thuê:</b> <?php echo date('d/m/Y', strtotime($dateRent)) ?></h5>
                                                <input type="text" id="dateTime" name="dateTime" value="<?php echo $dateRent ?>" class="sign__input" style="display:none">
                                            </div>
                                        </div>

                                        <div class="row mt-1">
                                            <div class="col-12 m-1">
                                                <h5 class="text-white"><b>Giờ thuê:</b> <span id="rentalHours"></span></h5>
                                                <input type="text" id="selectedTime" name="selectedTime" value="" class="sign__input" style="display:none">
                                            </div>
                                        </div>

                                        <div class="row mt-2" style="border-top: 1px solid #ff55a5; border-bottom: 1px solid #ff55a5;">
                                            <div class="col-12 mt-2">
                                                <h5 class="text-white" id="totalPriceDisplay"><b>Tổng cộng: </b>0đ</h5>
                                                <input type="text" id="totalPrice" name="totalPrice" value="" class="sign__input" style="display:none">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <input type="submit" value="Thanh toán" id="continuePay" class="sign__btn sign__btn--small" name="continuePay">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Info invoice -->
                                </div>
                            </form>
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
    <script>
    function updateTimeValue() {
        const checkboxes = document.querySelectorAll('input[name="timeRent"]:checked');
        const selectedTimes = Array.from(checkboxes).map(checkbox => checkbox.value);
        const selectedLabels = Array.from(checkboxes).map(checkbox => document.querySelector(`label[for="${checkbox.id}"]`).innerText.trim());

        // Lấy giá mỗi giờ từ PHP
        const pricePerHour = <?php echo $pricePerHour; ?>;

        // Kiểm tra nếu không có checkbox nào được chọn hoặc chỉ chọn ít hơn ba checkbox
        if (selectedTimes.length < 3) {
            document.getElementById('selectedTime').value = ""; // Nếu không chọn đủ, set giá trị rỗng
            document.getElementById('rentalHours').innerText = ""; // Cập nhật nội dung thẻ h5
            document.getElementById('totalPrice').value = ""; // Xóa giá trị tổng tiền
            document.getElementById('totalPriceDisplay').innerText = "Tổng cộng: 0đ"; // Hiển thị tổng tiền = 0
            return;
        }

        // Lấy thời gian bắt đầu và thời gian kết thúc từ các khung giờ đã chọn
        const timeRanges = selectedTimes.map(time => {
            const [start, end] = time.split('-').map(t => t.trim());
            return { start, end };
        });

        // Kiểm tra các khung giờ có liền kề không
        let areAdjacent = true;
        let prevEndTime = timeRanges[0].end;

        for (let i = 1; i < timeRanges.length; i++) {
            if (timeRanges[i].start !== prevEndTime) {
                areAdjacent = false;
                break;
            }
            prevEndTime = timeRanges[i].end;
        }

        if (!areAdjacent) {
            // Bỏ chọn tất cả checkbox
            checkboxes.forEach(checkbox => checkbox.checked = false);
            document.getElementById('selectedTime').value = ""; // Nếu không liền kề, set giá trị rỗng
            document.getElementById('rentalHours').innerText = ""; // Cập nhật nội dung thẻ h5
            document.getElementById('totalPrice').value = ""; // Xóa giá trị tổng tiền
            document.getElementById('totalPriceDisplay').innerText = "Tổng cộng: 0đ"; // Hiển thị tổng tiền = 0
            alert("Vui lòng chọn các khung giờ liền kề.");
            return;
        }

        // Nếu đã qua tất cả các kiểm tra, cập nhật giờ thuê
        let startTime = timeRanges[0].start; // Thời gian bắt đầu
        let endTime = timeRanges[timeRanges.length - 1].end; // Thời gian kết thúc
        const rentalHours = `${startTime}-${endTime}`;
        const startTimeCustom = startTime.split(':').slice(0, 2).join(':');
        const endTimeTimeCustom = endTime.split(':').slice(0, 2).join(':');
        const rentalh5 = `${startTimeCustom}-${endTimeTimeCustom}`;

        document.getElementById('selectedTime').value = rentalHours; // Cập nhật giá trị vào input
        document.getElementById('rentalHours').innerText = rentalh5; // Cập nhật nội dung thẻ h5

        // Tính tổng số tiền dựa trên số giờ đã chọn và giá mỗi giờ
        const totalHours = selectedTimes.length;
        const totalPrice = totalHours * pricePerHour;
        
        // Cập nhật tổng số tiền vào input và hiển thị
        document.getElementById('totalPrice').value = totalPrice;
        document.getElementById('totalPriceDisplay').innerText = `Tổng cộng: ${totalPrice.toLocaleString()}đ`;
    }
    </script>




