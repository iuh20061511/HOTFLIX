	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Rạp phim</h2>

						<span class="main__title-stat">Số lượng rạp: <?php echo count($listCinema);?></span>

						<div class="main__title-wrap">
						<a href="them-rap-phim.html">
							<button type="button" data-bs-toggle="modal" class="main__title-link main__title-link--wrap">Thêm rạp phim</button>
						</a>
						<a href="them-phong-chieu.html">
							<button type="button" data-bs-toggle="modal" class="main__title-link main__title-link--wrap">Thêm phòng chiếu</button>
						</a>
							<!-- <select class="filter__select" name="sort" id="filter__sort">
								<option value="0">Date created</option>
								<option value="1">Pricing plan</option>
								<option value="2">Status</option>
							</select> -->

							<!-- search -->
							<form action="#" class="main__title-form">
								<input type="text" placeholder="Find user..">
								<button type="button">
									<i class="ti ti-search"></i>
								</button>
							</form>
							<!-- end search -->
						</div>
					</div>
				</div>
				<!-- end main title -->

				<!-- cinema -->
				<div class="col-12">
					<div class="catalog catalog--1">
						<table class="catalog__table">
							<thead>
								<tr>
									<th>STT</th>
									<th>Tên rạp</th>
									<th>Địa chỉ</th>
									<th>Điện thoại liên lạc</th>
									<th>Số lượng phòng</th>
									<th>Trạng thái</th>
									<th>Chức năng</th>
								</tr>
							</thead>

							<tbody>
							<?php
                                $stt = 0;
                                foreach ($listCinema as $index => $cinema) { ?>
								<tr>
									<td>
										<div class="catalog__text"><?php echo ++$stt?></div>
									</td>
									<td>
										<div class="catalog__text">
											<?php echo $cinema['cinema_name']?>
										</div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $cinema['address']?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $cinema['contact']?></div>
									</td>
									<td>
										<div class="catalog__text">
										<?php
											$number_room = 0;
											foreach ($listRoom as $index => $room) { 
												if($room['id_cinema'] == $cinema['id_cinema']){
													$number_room +=1;
												}
											}
											echo $number_room;
											?>
										</div>
									</td>
									<td>
									<?php
										if ($cinema['status'] == 1) { ?>
											<div class="catalog__text catalog__text--green">Đang kinh doanh</div>
										<?php } elseif ($cinema['status'] == 0) { ?>
											<div class="catalog__text catalog__text--red">Ngưng kinh doanh</div>
										<?php }
									?>
									</td>
									<td>
										<div class="catalog__btns">
										<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--view" data-bs-target="#modal-view" 
    									onclick="loadModalData(<?php echo htmlspecialchars(json_encode($listRoom, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars(json_encode($cinema, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8'); ?>)"
										>
												<i class="ti ti-eye"></i>
											</button>
											<a href="cap-nhat-rap-phim-<?php echo $cinema['id_cinema'] ?>.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete catalog__btn--delete-cinema" data-cinema-id="<?php echo $cinema['id_cinema'] ?>" data-cinema-name="<?php echo $cinema['cinema_name'] ?>" data-bs-target="#modal-delete">
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
				<!-- end cinema -->

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
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content modal__content--view">
					<div class="reviews__autor">
						<span class="reviews__name" style="color: #ff55a5"></span>
						<span class="reviews__time"></span>
					</div>

					<div class="table-responsive m-3">
						<table class="table table-striped">
							<thead>
								<tr style="color: #ff55a5; font-size: 14px;">
									<th scope="col" class="text-nowrap" style="width: 50px;">STT</th>
									<th scope="col">Tên Phòng</th>
									<th scope="col">Loại Phòng</th>
									<th scope="col">Số Lượng Ghế</th>
									<th scope="col">Chức năng</th>
								</tr>
							</thead>
							<tbody>
								<!-- Dữ liệu sẽ được thêm vào đây -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end view modal -->

	<!-- delete modal cinema-->
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="xoa-rap-phim.html" class="modal__form" method="post">
						<h6 class="modal__title">Xóa <span id="cinema-name"></span> (ID: <span id="cinema-id"></span>)</h6>
						<input type="hidden" name="id_cinema" id="cinema-id-input" value="">
						<p class="modal__text">Bạn có chắc chắn muốn xóa vĩnh viễn rạp phim này không?</p>

						<div class="modal__btns">
							<input type="submit" value="Xóa" class="sign__btn sign__btn--small m-2" name="deleteCinema">
							<input type="button" value="Hủy" class="sign__btn sign__btn--small m-2" data-bs-dismiss="modal" aria-label="Close" name="close">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end delete modal cinema-->

	<!-- delete modal room-->
	<div class="modal fade" id="modal-delete-room" tabindex="-1" aria-labelledby="modal-delete-room" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="xoa-phong-chieu.html" class="modal__form" method="post"> <!-- Changed action to xoa-phong-chieu.html -->
						<h6 class="modal__title">Xóa <span id="room-name"></span> (ID: <span id="room-id"></span>)</h6>
						<input type="hidden" name="id_room" id="room-id-input" value="">
						<p class="modal__text">Bạn có chắc chắn muốn xóa vĩnh viễn phòng chiếu này không?</p>

						<div class="modal__btns">
							<input type="submit" value="Xóa" class="sign__btn sign__btn--small m-2" name="deleteRoom">
							<input type="button" value="Hủy" class="sign__btn sign__btn--small m-2" data-bs-dismiss="modal" aria-label="Close" name="close">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end delete modal room-->


	<script>
		function loadModalData(listRoom, cinema) {
			// Cập nhật tên rạp và địa chỉ trong modal
			document.querySelector('.reviews__name').textContent = cinema.cinema_name;
			document.querySelector('.reviews__time').textContent = cinema.address;

			// Lấy bảng trong modal
			const tableBody = document.querySelector('#modal-view .table tbody');
			tableBody.innerHTML = ''; // Xóa nội dung cũ

			// Lọc các phòng thuộc rạp hiện tại
			const filteredRooms = listRoom.filter(room => room.id_cinema === cinema.id_cinema);

			// Duyệt qua các phòng và thêm vào bảng
			filteredRooms.forEach((room, index) => {
				const row = `
					<tr>
						<td class="text-nowrap text-white text-center">${index + 1}</td>
						<td class="text-white">${room.room_name}</td>
						<td class="text-white">${room.RoomType_name}</td>
						<td class="text-white text-center">${room.number_seat}</td>
						<td class="text-white text-center">
							<div class="catalog__btns">
							<a href="cap-nhat-phong-chieu-${room.id_room}.html" class="catalog__btn catalog__btn--edit">
								<i class="ti ti-edit"></i>
							</a>
							<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete catalog__btn--delete-room" data-room-id="${room.id_room}" data-room-name="${room.room_name}" data-bs-target="#modal-delete-room">
								<i class="ti ti-trash"></i>
							</button>
							</div>
						</td>
					</tr>
				`;
				tableBody.insertAdjacentHTML('beforeend', row);
			});

			// Gắn sự kiện click cho nút xóa phòng chiếu (catalog__btn--delete-room)
			document.querySelectorAll('.catalog__btn--delete-room').forEach(function (button) {
        	button.addEventListener('click', function () {
            var roomId = this.getAttribute('data-room-id');
            var roomName = this.getAttribute('data-room-name');
            
            // Cập nhật dữ liệu cho modal xóa phòng chiếu
            document.getElementById('room-id').textContent = roomId;
            document.getElementById('room-name').textContent = roomName;
            document.getElementById('room-id-input').value = roomId;
        	});
    		});
		}

		document.addEventListener('DOMContentLoaded', function () {
        // Xử lý sự kiện cho nút xóa rạp phim
        document.querySelectorAll('.catalog__btn--delete-cinema').forEach(function (button) {
            button.addEventListener('click', function () {
                // Xử lý khi bấm nút xóa rạp phim (cinema)
                var cinemaId = this.getAttribute('data-cinema-id');
                var cinemaName = this.getAttribute('data-cinema-name');
                document.getElementById('cinema-id').textContent = cinemaId;
                document.getElementById('cinema-name').textContent = cinemaName;
                document.getElementById('cinema-id-input').value = cinemaId;
            });
        });
    });

	</script>