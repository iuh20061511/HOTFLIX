<!-- main content -->
<main class="main">
	<div class="container-fluid">
		<div class="row">
			<!-- main title -->
			<div class="col-12">
				<div class="main__title">
					<h2>Người dùng</h2>

					<span class="main__title-stat">Số lượng: <?php echo $pagination['totalStaff']; ?></span>

					<div class="main__title-wrap">
						<a href="them-tai-khoan.html">
							<button type="button" data-bs-toggle="modal"
								class="main__title-link main__title-link--wrap">Thêm nhân viên</button>
						</a>

						<!-- <select class="filter__select" name="sort" id="filter__sort">
							<a href="quan-ly-tai-khoan.html"><option value="1">Nhân viên</option></a>
							<a href="danh-sach-thanh-vien.html"><option value="2">Thành viên</option></a>
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

			<!-- users -->
			<div class="col-12">
				<div class="catalog catalog--1">
					<table class="catalog__table">
						<thead>
							<tr>
								<th>STT</th>
								<th>Email</th>
								<th>Họ tên</th>
								<th>Ngày sinh</th>
								<th>Số điện thoại</th>
								<th>Giới tính</th>
								<th>Vai trò</th>
								<th>Rạp</th>
								<th>Chức năng</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$stt = ($pagination['currentPage'] - 1) * $pagination['itemsPerPage'] ;
							foreach ($listStaff as $index => $staff) { ?>
								<tr>
									<td>
										<div class="catalog__text"><?php echo ++$stt ?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $staff['email'] ?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $staff['full_name'] ?></div>
									</td>
									<td>
										<div class="catalog__text">
											<?php echo date('d/m/Y', strtotime($staff['birthday'])) ?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $staff['phone'] ?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $staff['gender'] ?></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green"><?php echo $staff['name_role'] ?>
										</div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $staff['cinema_name'] ?></div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal"
												class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="cap-nhat-tai-khoan-<?php echo $staff['id_staff'] ?>.html"
												class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal"
												class="catalog__btn catalog__btn--delete"
												data-staff-id="<?php echo $staff['id_staff'] ?>"
												data-staff-name="<?php echo $staff['full_name'] ?>"
												data-bs-target="#modal-delete">
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
					<!-- Số lượng hiển thị -->
					<span class="main__paginator-pages invisible"><?= $pagination['itemsPerPage']; ?> of <?= $pagination['totalStaff']; ?></span>

					<!-- Điều hướng phân trang -->
					<ul class="main__paginator-list">
						<!-- Trang trước -->
						<li>
							<a href="?page=<?= max(1, $pagination['currentPage'] - 1); ?>">
								<i class="ti ti-chevron-left"></i>
								<span>Prev</span>
							</a>
						</li>
						<!-- Trang kế tiếp -->
						<li>
							<a href="?page=<?= min($pagination['totalPages'], $pagination['currentPage'] + 1); ?>">
								<span>Next</span>
								<i class="ti ti-chevron-right"></i>
							</a>
						</li>
					</ul>
					
					<ul class="paginator">
						<li class="paginator__item paginator__item--prev">
							<a href="?page=<?= max(1, $pagination['currentPage'] - 1); ?>"><i class="ti ti-chevron-left"></i></a>
						</li>
						
						<?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
							<li class="paginator__item <?= $i == $pagination['currentPage'] ? 'paginator__item--active' : ''; ?>">
								<a href="?page=<?= $i; ?>"><?= $i; ?></a>
							</li>
						<?php endfor; ?>
						
						<li class="paginator__item paginator__item--next">
							<a href="?page=<?= min($pagination['totalPages'], $pagination['currentPage'] + 1); ?>"><i class="ti ti-chevron-right"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<!-- end paginator -->
		</div>
	</div>
</main>
<!-- end main content -->


<!-- status modal -->
<div class="modal fade" id="modal-status" tabindex="-1" aria-labelledby="modal-status" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal__content">
				<form action="#" class="modal__form">
					<h4 class="modal__title">Status change</h4>

					<p class="modal__text">Are you sure about immediately change status?</p>

					<div class="modal__btns">
						<button class="modal__btn modal__btn--apply" type="button"><span>Apply</span></button>
						<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal"
							aria-label="Close"><span>Dismiss</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- end status modal -->

<!-- delete modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal__content">
				<form action="xoa-tai-khoan.html" class="modal__form" method="post">
					<h6 class="modal__title">Xóa <span id="staff-name"></span> (ID: <span id="staff-id"></span>)</h6>
					<input type="hidden" name="id_staff" id="staff-id-input" value="">
					<p class="modal__text">Bạn có chắc chắn muốn xóa vĩnh viễn người dùng này không?</p>

					<div class="modal__btns">
						<input type="submit" value="Xóa" class="sign__btn sign__btn--small m-2" name="deleteUser">
						<input type="button" value="Hủy" class="sign__btn sign__btn--small m-2" data-bs-dismiss="modal"
							aria-label="Close" name="close">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Lấy tất cả các nút xóa
		var deleteButtons = document.querySelectorAll('.catalog__btn--delete');

		// Thêm sự kiện click cho từng nút xóa
		deleteButtons.forEach(function (button) {
			button.addEventListener('click', function () {
				var staffId = this.getAttribute('data-staff-id');
				var staffName = this.getAttribute('data-staff-name');
				document.getElementById('staff-id').textContent = staffId;
				document.getElementById('staff-name').textContent = staffName;
				document.getElementById('staff-id-input').value = staffId;
			});
		});
	});
</script>
<!-- end delete modal -->