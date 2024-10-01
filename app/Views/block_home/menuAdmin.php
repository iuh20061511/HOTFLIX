<!-- sidebar -->
<div class="sidebar">
	<!-- sidebar user -->
	<div class="sidebar__user">
		<div class="sidebar__user-img">
			<img src="<?php echo _WEB_ROOT ?>/public/admin/img/user.svg" alt="">
		</div>

		<!-- sidebar nav -->
		<div class="sidebar__nav-wrap">
			<ul class="sidebar__nav">
				<li class="sidebar__nav-item">
					<a href="index-2.html" class="sidebar__nav-link"><i class="ti ti-layout-grid"></i>
						<span>Dashboard</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-tai-khoan.html" role="button" aria-expanded="false"><i
							class="ti ti-users"></i> <span>Quản lý Tài khoản</span> <i
							class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="them-tai-khoan.html">Thêm nhân viên</a></li>
						<li><a href="danh-sach-thanh-vien.html">Danh sách Thành viên</a></li>
						<li><a href="quan-ly-tai-khoan.html">Danh sách Nhân viên</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-rap-phim.html" role="button" aria-expanded="false"><i
							class="ti ti-device-tv"></i><span>Quản lý Rạp phim</span> <i
							class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="them-rap-phim.html">Thêm rạp phim</a></li>
						<li><a href="them-phong-chieu.html">Thêm phòng chiếu</a></li>
						<li><a href="quan-ly-rap-phim.html">Danh sách rạp phim</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-phim.html" role="button" aria-expanded="false"><i
							class="ti ti-movie"></i> <span>Quản lý phim</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="them-bo-phim.html">Thêm phim mới</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="#" role="button" aria-expanded="false"><i
							class="ti ti-calendar"></i> <span>Quản lý suất chiếu</span> <i
							class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="add-item.html">Add cinema</a></li>
						<li><a href="edit-user.html">Edit cinema</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-bap-nuoc.html" role="button" aria-expanded="false"><i
							class="ti ti-paper-bag"></i> <span>Quản lý Bắp-nước</span> <i
							class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="them-bap-nuoc.html">Thêm mặt hàng</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
					<a href="comments.html" class="sidebar__nav-link"><i class="ti ti-message"></i>
						<span>Comments</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="reviews.html" class="sidebar__nav-link"><i class="ti ti-star-half-filled"></i>
						<span>Reviews</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="settings.html" class="sidebar__nav-link"><i class="ti ti-settings"></i>
						<span>Settings</span></a>
				</li>

				<!-- dropdown -->
				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false"><i class="ti ti-files"></i> <span>Pages</span> <i
							class="ti ti-chevron-down"></i></a>

					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="add-item.html">Add item</a></li>
						<li><a href="edit-user.html">Edit user</a></li>
						<li><a href="forgot.html">Forgot password</a></li>
					</ul>
				</li>
				<!-- end dropdown -->

				<li class="sidebar__nav-item">
					<a href="<?php echo _LINK ?>" class="sidebar__nav-link"><i class="ti ti-arrow-left"></i> <span>Back
							to HotFlix</span></a>
				</li>
			</ul>
		</div>

		<button class="sidebar__user-btn" type="button">
			<i class="ti ti-logout"></i>
		</button>
	</div>
	<!-- end sidebar user -->

	<!-- sidebar nav -->
	<div class="sidebar__nav-wrap">
		<ul class="sidebar__nav">
			<li class="sidebar__nav-item">
				<a href="index-2.html" class="sidebar__nav-link"><i class="ti ti-layout-grid"></i>
					<span>Dashboard</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="quan-ly-tai-khoan.html" role="button" aria-expanded="false"><i
						class="ti ti-users"></i> <span>Quản lý Tài khoản</span> <i class="ti ti-chevron-down"></i></a>
				<ul class="dropdown-menu sidebar__dropdown-menu">
					<li><a href="them-tai-khoan.html">Thêm nhân viên</a></li>
					<li><a href="danh-sach-thanh-vien.html">Danh sách Thành viên</a></li>
					<li><a href="quan-ly-tai-khoan.html">Danh sách Nhân viên</a></li>
				</ul>
			</li>

			<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="quan-ly-rap-phim.html" role="button" aria-expanded="false"><i
						class="ti ti-movie"></i><span>Quản lý Rạp phim</span> <i class="ti ti-chevron-down"></i></a>
				<ul class="dropdown-menu sidebar__dropdown-menu">
					<li><a href="them-rap-phim.html">Thêm rạp phim</a></li>
					<li><a href="them-phong-chieu.html">Thêm phòng chiếu</a></li>
					<li><a href="quan-ly-rap-phim.html">Danh sách rạp phim</a></li>
				</ul>
			</li>

			<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="quan-ly-phim.html" role="button" aria-expanded="false"><i
						class="ti ti-movie"></i> <span>Quản lý phim</span> <i class="ti ti-chevron-down"></i></a>
				<ul class="dropdown-menu sidebar__dropdown-menu">
					<li><a href="them-bo-phim.html">Thêm phim mới</a></li>
				</ul>
			</li>

			<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
						class="ti ti-video-camera"></i> <span>Quản lý suất chiếu</span> <i
						class="ti ti-chevron-down"></i></a>
				<ul class="dropdown-menu sidebar__dropdown-menu">
					<li><a href="them-suat-chieu.html">Thêm mới suất chiếu</a></li>
					<li><a href="edit-user.html">Edit cinema</a></li>
				</ul>
			</li>

			<li class="sidebar__nav-item">
				<a href="comments.html" class="sidebar__nav-link"><i class="ti ti-message"></i>
					<span>Comments</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="reviews.html" class="sidebar__nav-link"><i class="ti ti-star-half-filled"></i>
					<span>Reviews</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="settings.html" class="sidebar__nav-link"><i class="ti ti-settings"></i>
					<span>Settings</span></a>
			</li>

			<!-- dropdown -->
			<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
						class="ti ti-files"></i> <span>Pages</span> <i class="ti ti-chevron-down"></i></a>

				<ul class="dropdown-menu sidebar__dropdown-menu">
					<li><a href="add-item.html">Add item</a></li>
					<li><a href="edit-user.html">Edit user</a></li>
					<li><a href="forgot.html">Forgot password</a></li>
				</ul>
			</li>
			<!-- end dropdown -->

			<li class="sidebar__nav-item">
				<a href="<?php echo _LINK ?>" class="sidebar__nav-link"><i class="ti ti-arrow-left"></i> <span>Back to
						HotFlix</span></a>
			</li>
		</ul>
	</div>
	<!-- end sidebar nav -->

	<!-- sidebar copyright -->
	<div class="sidebar__copyright">© HOTFLIX, 2024. <br>Create by <a href="#" target="_blank">IUH student</a></div>
	<!-- end sidebar copyright -->
</div>
<!-- end sidebar -->