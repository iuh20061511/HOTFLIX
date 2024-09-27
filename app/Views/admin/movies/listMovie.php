	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Quản lý phim</h2>

						<span class="main__title-stat">Số lượng phim: <?php echo count($listMovie)?></span>

						<div class="main__title-wrap">
						<a href="them-bo-phim.html">
							<button type="button" data-bs-toggle="modal" class="main__title-link main__title-link--wrap">Thêm phim mới</button>
						</a>

						<form action="quan-ly-phim.html" class="m-3">
							<select class="filter__select" name="movie_sort" id="filter__sort" onchange="this.form.submit()">
								<option value="3" <?= (isset($_GET['movie_sort']) && $_GET['movie_sort'] == 3) ? 'selected' : '' ?>>Tất cả</option>
								<option value="0" <?= (isset($_GET['movie_sort']) && $_GET['movie_sort'] == 0) ? 'selected' : '' ?>>Sắp chiếu</option>
								<option value="1" <?= (isset($_GET['movie_sort']) && $_GET['movie_sort'] == 1) ? 'selected' : '' ?>>Đang chiếu</option>
								<option value="2" <?= (isset($_GET['movie_sort']) && $_GET['movie_sort'] == 2) ? 'selected' : '' ?>>Đã chiếu</option>
							</select>
						</form>

							<!-- search -->
							<form action="quan-ly-phim.html" class="main__title-form">
								<input type="text" placeholder="Tìm kiếm phim..." name="search_nameMovie">
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
									<th>Tên phim</th>
									<th>Thời lượng</th>
									<th>Ngày phát hành</th>
									<th>Trạng thái</th>
									<th>Trailer</th>
									<th>Chức năng</th>
								</tr>
							</thead>

							<tbody>
							<?php
                                $stt = 0;
                                foreach ($listMovie as $index => $movie) { ?>
								<tr>
									<td>
										<div class="catalog__text"><?php echo ++$stt?></div>
									</td>
									<td>
										<div class="catalog__text"><div class="view-poster" data-poster="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movie['poster'] ?>">Poster</div></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $movie['movie_name']; ?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $movie['duration']; ?> phút</div>
									</td>
									<td>
										<div class="catalog__text"><?php echo date('d/m/Y', strtotime($movie['release_date'])) ?></div>
									</td>
									<td>
									<?php if ($movie['status'] == 0 ): ?>
										<div class="catalog__text catalog__text--red">Sắp chiếu</div>
									<?php endif; ?>
									<?php if ($movie['status'] == 1 ): ?>
										<div class="catalog__text catalog__text--green">Đang chiếu</div>
									<?php endif; ?>
									</td>
									<td>
										<div class="catalog__text"><div class="play_trailer" data-trailer="<?php echo $movie['trailer']; ?>">Trailer</div></div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--view" data-bs-target="#modal-view" 
												data-poster="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movie['poster'] ?>"
												data-movie='<?php echo htmlspecialchars(json_encode($movie, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8'); ?>'>
												<i class="ti ti-eye"></i>
											</button>
											<a href="cap-nhat-phim-<?php echo $movie['id_movie'] ?>.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-movie-id="<?php echo $movie['id_movie'] ?>" data-movie-name="<?php echo $movie['movie_name'] ?>" data-bs-target="#modal-delete">
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
									<strong style="color: #ff55a5;">Thời lượng:</strong>
								</div>
								<div class="col-9 movie-duration text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Ngày phát hành:</strong>
								</div>
								<div class="col-9 movie-release-date text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Thể loại:</strong>
								</div>
								<div class="col-9 movie-genre text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Quốc gia:</strong>
								</div>
								<div class="col-9 movie-nation text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Tác giả:</strong>
								</div>
								<div class="col-9 movie-director text-white"></div>
							</div>

							<div class="row mb-3">
								<div class="col-3">
									<strong style="color: #ff55a5;">Diễn viên:</strong>
								</div>
								<div class="col-9 movie-actor text-white"></div>
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
					<form action="xoa-bo-phim.html" class="modal__form" method="post">
						<h6 class="modal__title">Xóa phim: <span id="movie-name"></span></h6>
						<h6 class="modal__title">ID: <span id="movie-id"></span></h6>
						<input type="hidden" name="id_movie" id="movie-id-input" value="">
						<p class="modal__text">Bạn chắc chắn xóa vĩnh viễn bộ phim này không?</p>

						<div class="modal__btns">
							<input type="submit" value="Xóa" class="sign__btn sign__btn--small m-2" name="deleteMovie">
							<input type="button" value="Hủy" class="sign__btn sign__btn--small m-2" data-bs-dismiss="modal" aria-label="Close" name="close">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end delete modal -->


	<!-- Popup video-->
	<div class="popupvideo" id="popupvideo">
        <div class="popupvideo_inner">
            <div class="popupvideo_inner_iframe">
                <iframe id="videoIframe" width="100%" height="100%"
                    src="" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>
            <div class="popupvideo_inner_close" id="closeVideoPopup">
                <img src="<?php echo _WEB_ROOT ?>/public/admin/img/icons8-close.svg" alt="close">
            </div>
        </div>
    </div>
	<!-- Popup video-->


	<!-- Popup hiện poster -->
	<div class="popup-poster" id="popupPoster">
		<span class="close-popup">&times;</span>
		<img src="" alt="Movie Poster" class="popup-poster-image" id="popupPosterImage">
	</div>
	<!-- Popup hiện poster -->

	<script>
		// <-------------Trailer--------------->
		const trailerLinks = document.querySelectorAll('.play_trailer'); // Chọn tất cả các link Trailer
		const popupVideo = document.getElementById('popupvideo'); // Popup container
		const videoIframe = document.getElementById('videoIframe'); // iframe chứa video
		const closeVideoPopupBtn = document.getElementById('closeVideoPopup'); // Nút đóng popup video

		// Gắn sự kiện click cho từng thẻ a (link trailer)
		trailerLinks.forEach(link => {
			link.addEventListener('click', function(event) {
				const trailerUrl = link.getAttribute('data-trailer'); // Lấy URL trailer từ thuộc tính data
				videoIframe.src = `${trailerUrl}?autoplay=1`; // Gán URL vào iframe và tự động phát video
				popupVideo.classList.add('active'); // Kích hoạt popup
			});
		});

		// Đóng popup video khi nhấn vào nút close hoặc ra ngoài khung video
		closeVideoPopupBtn.addEventListener('click', function() {
			popupVideo.classList.remove('active');
			videoIframe.src = ''; // Xóa URL để dừng video
		});

		popupVideo.addEventListener('click', function(e) {
			if (e.target === popupVideo) {
				popupVideo.classList.remove('active');
				videoIframe.src = ''; // Xóa URL để dừng video
			}
		});
		// <-------------Trailer--------------->

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
			// Tên phim
			document.querySelector('.movie-name').textContent = movie.movie_name;
			// Ảnh Poster
			document.querySelector('.movie-poster').src = posterUrl; // Cập nhật với posterUrl
			//Thời lượng
			document.querySelector('.movie-duration').textContent = movie.duration+" phút";
			//Ngày phát hành
			const releaseDate = new Date(movie.release_date);
			const formattedDate = releaseDate.getDate().toString().padStart(2, '0') + '/' +
								(releaseDate.getMonth() + 1).toString().padStart(2, '0') + '/' +
								releaseDate.getFullYear(); // Định dạng ngày/tháng/năm

			document.querySelector('.movie-release-date').textContent = formattedDate;
			//Thể loại
			document.querySelector('.movie-genre').textContent = movie.genre;
			//Quốc gia
			document.querySelector('.movie-nation').textContent = movie.nation;
			//Tác giả
			document.querySelector('.movie-director').textContent = movie.director;
			//Diễn viên
			document.querySelector('.movie-actor').textContent = movie.actor;
			//Mô tả
			document.querySelector('.movie-description').textContent = movie.description;
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

