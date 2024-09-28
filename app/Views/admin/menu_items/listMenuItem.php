	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Quản lý bắp nước-combo</h2>

						<span class="main__title-stat">Số lượng mặc hàng: <?php echo $quantityItem?></span>

						<div class="main__title-wrap">
						<a href="them-bap-nuoc.html">
							<button type="button" data-bs-toggle="modal" class="main__title-link main__title-link--wrap">Thêm mặt hàng mới</button>
						</a>

							<!-- search -->
							<form action="quan-ly-bap-nuoc.html" class="main__title-form">
								<input type="text" placeholder="Tìm kiếm mặt hàng..." name="search_nameItem" value="<?php echo isset($_GET['search_nameItem']) ? $_GET['search_nameItem'] : ''; ?>">
								<button type="submit">
									<i class="ti ti-search"></i>
								</button>
							</form>
							<!-- end search -->
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
									<th>Poster</th>
									<th>Tên mặt hàng</th>
									<th>Mô tả</th>
									<th>Giá cả</th>
									<th>Chức năng</th>
								</tr>
							</thead>

							<tbody>
							<?php
                                $stt = 0;
                                foreach ($listMenuItem as $index => $item) { ?>
								<tr>
									<td>
										<div class="catalog__text"><?php echo ++$stt?></div>
									</td>
									<td>
										<div class="catalog__text"><div class="view-poster" data-poster="<?php echo _WEB_ROOT ?>/public/admin/img/menu_items/<?php echo $item['image'] ?>">Poster</div></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $item['item_name']; ?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo str_replace("-", "<br>-", $item['description'] );?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo number_format($item['price'], 0, ',', '.');;?>đ</div>
									</td>
									<td>
										<div class="catalog__btns">
											<a href="cap-nhat-bap-nuoc-<?php echo $item['id_item'] ?>.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-movie-id="<?php echo $item['id_item'] ?>" data-movie-name="<?php echo $item['item_name'] ?>" data-bs-target="#modal-delete">
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

	<!-- delete modal -->
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="xoa-bap-nuoc.html" class="modal__form" method="post">
						<h6 class="modal__title">Xóa: <span id="movie-name"></span></h6>
						<h6 class="modal__title">ID: <span id="movie-id"></span></h6>
						<input type="hidden" name="id_movie" id="movie-id-input" value="">
						<p class="modal__text">Bạn có chắc chắn xóa vĩnh viễn mặt hàng này?</p>

						<div class="modal__btns">
							<input type="submit" value="Xóa" class="sign__btn sign__btn--small m-2" name="deleteItem">
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

