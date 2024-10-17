	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Quản lý Voucher</h2>

						<span class="main__title-stat">Số lượng: <?php echo count($listPromotion)?></span>

						<div class="main__title-wrap">
						<a href="them-voucher.html">
							<button type="button" data-bs-toggle="modal" class="main__title-link main__title-link--wrap">Thêm voucher</button>
						</a>

						</div>
					</div>
				</div>
				<!-- end main title -->

				<!-- users -->
				<div class="col-12">
					<div class="catalog catalog--1">
						<table class="catalog__table">
							<thead>
								<tr>
									<th>STT</th>
									<th>Tên chương trình</th>
                                    <th>Mã CODE</th>
									<th>Ngày bắt đầu</th>
									<th>Ngày kết thúc</th>
                                    <th>Giá giảm</th>
									<th>Chức năng</th>
								</tr>
							</thead>

							<tbody>
							<?php
                                $stt = 0;
                                foreach ($listPromotion as $index => $promotion) { ?>
								<tr>
									<td>
										<div class="catalog__text"><?php echo ++$stt?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $promotion['promotion_name']; ?></div>
									</td>
                                    <td>
										<div class="catalog__text"><?php echo $promotion['promotion_code']; ?></div>
									</td>
                                    <td>
										<div class="catalog__text"><?php echo date('d/m/Y', strtotime($promotion['date_start'])) ?></div>
									</td>
                                    <td>
										<div class="catalog__text"><?php echo date('d/m/Y', strtotime($promotion['date_end'])) ?></div>
									</td>
									<td>
                                    <?php if ($promotion['discount_type'] == '%' ): ?>
										<div class="catalog__text"><?php echo $promotion['discount_value']; ?>%</div>
									<?php endif; ?>
									<?php if ($promotion['discount_type'] == 'Tiền' ): ?>
										<div class="catalog__text"><?php echo number_format($promotion['discount_value'], 0, ',', '.');;?>đ</div>
									<?php endif; ?>
									</td>
									<td>
										<div class="catalog__btns">
                                            <button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--view" data-bs-target="#modal-view" 
												data-poster="<?php echo _WEB_ROOT ?>/public/admin/img/promotion/<?php echo $promotion['image'] ?>"
												data-movie='<?php echo htmlspecialchars(json_encode($promotion, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8'); ?>'>
												<i class="ti ti-eye"></i>
											</button>
											<a href="cap-nhat-voucher-<?php echo $promotion['id_promotion'] ?>.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-movie-id="<?php echo $promotion['id_promotion'] ?>" data-movie-name="<?php echo $promotion['promotion_name'] ?>" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- end users -->

				<!-- paginator -->
				<div class="col-12">
					<div class="main__paginator">
						<!-- amount -->
						<span class="main__paginator-pages">10 of 169</span>
						<!-- end amount -->

						<ul class="main__paginator-list">
							<li>
								<a href="#">
									<i class="ti ti-chevron-left"></i>
									<span>Prev</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>Next</span>
									<i class="ti ti-chevron-right"></i>
								</a>
							</li>
						</ul>

						<ul class="paginator">
							<li class="paginator__item paginator__item--prev">
								<a href="#"><i class="ti ti-chevron-left"></i></a>
							</li>
							<li class="paginator__item"><a href="#">1</a></li>
							<li class="paginator__item paginator__item--active"><a href="#">2</a></li>
							<li class="paginator__item"><a href="#">3</a></li>
							<li class="paginator__item"><a href="#">4</a></li>
							<li class="paginator__item"><span>...</span></li>
							<li class="paginator__item"><a href="#">29</a></li>
							<li class="paginator__item"><a href="#">30</a></li>
							<li class="paginator__item paginator__item--next">
								<a href="#"><i class="ti ti-chevron-right"></i></a>
							</li>
						</ul>
					</div>
				</div>
				<!-- end paginator -->
			</div>
		</div>
	</main>
	<!-- end main content -->

    <!-- view modal -->
	<div class="modal fade" id="modal-view" tabindex="-1" aria-labelledby="modal-view" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header" style="background-color: black; border: 2px solid #ff55a5; border-bottom: none;">
					<h5 class="modal-title movie-name" style="color: #ff55a5;"></h5>
					<button type="button" class="btn-close" style="background-color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal__content modal__content--view" style="border: 2px solid #ff55a5; border-top: none; border-top-left-radius: 0; border-top-right-radius: 0;">
					<!-- Phần chứa ảnh và các thông tin khác -->
					<div class="row p-3">
						<!-- Cột chứa poster -->
						<div class="col-md-4 col-sm-12 d-flex justify-content-center">
							<img src="" alt="Poster" class="movie-poster" style="width: 100%; max-width: 200px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
						</div>

						<div class="col-md-8 col-sm-12">

							<!-- Thông tin phim với nhãn và nội dung -->
							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Mã CODE:</strong>
								</div>
								<div class="col-9 movie-duration text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Ngày bắt đầu:</strong>
								</div>
								<div class="col-9 movie-release-date text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Ngày kết thúc:</strong>
								</div>
								<div class="col-9 movie-genre text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Loại voucher:</strong>
								</div>
								<div class="col-9 movie-nation text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Giá giảm:</strong>
								</div>
								<div class="col-9 movie-director text-white"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<p class="movie-description m-3 px-3 text-white"></p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- end view modal -->

	<!-- delete modal -->
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="xoa-voucher.html" class="modal__form" method="post">
						<h6 class="modal__title">Xóa voucher: <span id="movie-name"></span></h6>
						<h6 class="modal__title">ID: <span id="movie-id"></span></h6>
						<input type="hidden" name="id_promotion" id="movie-id-input" value="">
						<p class="modal__text">Bạn có chắc chắn xóa vĩnh viễn voucher này?</p>

						<div class="modal__btns">
							<input type="submit" value="Xóa" class="sign__btn sign__btn--small m-2" name="deleteVoucher">
							<input type="button" value="Hủy" class="sign__btn sign__btn--small m-2" data-bs-dismiss="modal" aria-label="Close" name="close">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end delete modal -->

	<!-- Popup hiện poster -->
	<div class="popup-poster" id="popupPoster">
		<span class="close-popup">&times;</span>
		<img src="" alt="Movie Poster" class="popup-poster-image" id="popupPosterImage">
	</div>
	<!-- Popup hiện poster -->

	<script>
		// <-------------Modal view detail movie--------------->
		// Gán sự kiện click cho từng nút button
		const posterButtons = document.querySelectorAll('.catalog__btn--view');

		posterButtons.forEach(button => {
			button.addEventListener('click', function() {
				// Lấy thông tin
				const movieData = JSON.parse(button.getAttribute('data-movie'));
				const posterUrl = button.getAttribute('data-poster');
				// Gọi hàm loadModalDataMovie và truyền vào dữ liệu
				loadModalDataMovie(movieData, posterUrl);
			});
		});

		function loadModalDataMovie(movie, posterUrl) {
			// Tên
			document.querySelector('.movie-name').textContent = movie.promotion_name;
			// Ảnh
			document.querySelector('.movie-poster').src = posterUrl; // Cập nhật với posterUrl
			//Thời
			document.querySelector('.movie-duration').textContent = movie.promotion_code;
			//Ngày phát hành
			const releaseDate = new Date(movie.date_start);
			const formattedDate = releaseDate.getDate().toString().padStart(2, '0') + '/' +
								(releaseDate.getMonth() + 1).toString().padStart(2, '0') + '/' +
								releaseDate.getFullYear(); // Định dạng ngày/tháng/năm

			document.querySelector('.movie-release-date').textContent = formattedDate;
			//Ngày kết thúc
			const endDate = new Date(movie.date_end);
			const formatEndDate = endDate.getDate().toString().padStart(2, '0') + '/' +
								(endDate.getMonth() + 1).toString().padStart(2, '0') + '/' +
								endDate.getFullYear(); // Định dạng ngày/tháng/năm
			document.querySelector('.movie-genre').textContent = formatEndDate;
			//Loại
			document.querySelector('.movie-nation').textContent = movie.discount_type;
			//Giá trị
            let discountValue;
            if(movie.discount_type == '%'){
                discountValue = movie.discount_value+"%";
            }else{
                const VND = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                });
                discountValue = VND.format(movie.discount_value)
            }
			document.querySelector('.movie-director').textContent = discountValue;
			//Mô tả
            let formattedText = movie.description.replace(/\./g, '.<br>');
			document.querySelector('.movie-description').innerHTML  = formattedText;
		}
		// <-------------Modal view detail movie--------------->

		// <-------------Modal delete movie--------------->
		document.addEventListener('DOMContentLoaded', function () {
			// Lấy tất cả các nút xóa
			var deleteButtons = document.querySelectorAll('.catalog__btn--delete');

			// Thêm sự kiện click cho từng nút xóa
			deleteButtons.forEach(function (button) {
				button.addEventListener('click', function () {
					var movieId = this.getAttribute('data-movie-id');
					var movieName = this.getAttribute('data-movie-name');
					document.getElementById('movie-id').textContent = movieId;
					document.getElementById('movie-name').textContent = movieName;
					document.getElementById('movie-id-input').value = movieId;
				});
			});
		});

	</script>

