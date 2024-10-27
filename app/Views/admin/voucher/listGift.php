	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Quản lý quà tặng</h2>

						<span class="main__title-stat">Số lượng: <?php echo count($listGift)?></span>

						<div class="main__title-wrap">
						<a href="them-qua-tang.html">
							<button type="button" data-bs-toggle="modal" class="main__title-link main__title-link--wrap">Thêm quà tặng</button>
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
									<th>Hình ảnh</th>
                                    <th>Tên quà</th>
									<th>Điểm đổi quà</th>
									<th>Chức năng</th>
								</tr>
							</thead>

							<tbody>
							<?php
                                $stt = 0;
                                foreach ($listGift as $index => $gift) { ?>
								<tr>
									<td>
										<div class="catalog__text"><?php echo ++$stt?></div>
									</td>
									<td>
										<?php $img= _WEB_ROOT.'/public/admin/img/gift/'.$gift['image'] ?>
										<div class="catalog__img view-poster" data-poster="<?php echo $img?>">
											<img src="<?php echo $img?>" alt="Poster">
										</div>
									</td>
                                    <td>
										<div class="catalog__text"><?php echo $gift['gift_name']; ?></div>
									</td>
                                    <td>
										<div class="catalog__text"><?php echo $gift['point']; ?> điểm</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-movie-id="<?php echo $gift['id_gift'] ?>" data-movie-name="<?php echo $gift['gift_name'] ?>" data-bs-target="#modal-delete">
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
				
				<!-- end paginator -->
			</div>
		</div>
	</main>
	<!-- end main content -->

	<!-- delete modal -->
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="xoa-qua-tang.html" class="modal__form" method="post">
						<h6 class="modal__title">Xóa quà: <span id="movie-name"></span></h6>
						<h6 class="modal__title">ID: <span id="movie-id"></span></h6>
						<input type="hidden" name="id_gift" id="movie-id-input" value="">
						<p class="modal__text">Bạn có chắc chắn xóa vĩnh viễn quà tặng này?</p>

						<div class="modal__btns">
							<input type="submit" value="Xóa" class="sign__btn sign__btn--small m-2" name="deleteGift">
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
		// <-------------Modal delete movie--------------->

		// <-------------Poster--------------->
		const posterLinks = document.querySelectorAll('.view-poster'); // Chọn tất cả các link xem poster
		const popupPoster = document.getElementById('popupPoster'); // Popup container cho poster
		const popupPosterImage = document.getElementById('popupPosterImage'); // Hình ảnh trong popup poster
		const closePosterPopupBtn = document.querySelector('.close-popup'); // Nút đóng popup poster

		// Gắn sự kiện click cho từng link poster
		posterLinks.forEach(link => {
			link.addEventListener('click', function(event) {

				// Lấy URL của ảnh poster từ thuộc tính data-poster
				const posterUrl = link.getAttribute('data-poster');

				// Gán URL poster vào thẻ img trong popup
				popupPosterImage.src = posterUrl;

				// Hiển thị popup bằng cách đổi style display
				popupPoster.style.display = 'flex';
			});
		});

		// Gắn sự kiện click cho nút đóng popup poster
		closePosterPopupBtn.addEventListener('click', function() {
			popupPoster.style.display = 'none'; // Ẩn popup khi nhấn nút đóng
			popupPosterImage.src = ''; // Xóa URL để tránh lỗi khi đóng
		});

		// Ẩn popup poster khi nhấn ra ngoài ảnh
		popupPoster.addEventListener('click', function(e) {
			if (e.target === popupPoster) {
				popupPoster.style.display = 'none'; // Ẩn popup khi nhấn ra ngoài ảnh
				popupPosterImage.src = ''; // Xóa URL khi đóng popup
			}
		});
		// <-------------Poster--------------->

	</script>

