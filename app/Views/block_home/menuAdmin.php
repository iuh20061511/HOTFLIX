<!-- sidebar -->
<div class="sidebar">
	<!-- sidebar user -->
	<div class="sidebar__user" style="padding: 20px 10px;">
		<div class="sidebar__user-img">
			<img src="<?php echo _WEB_ROOT ?>/public/admin/img/user.svg" alt="">
		</div>

		<div class="sidebar__user-title">
			<p class="pe-1 " style="font-size: 13px;"><?php echo $_SESSION['is_login']['fullname'] ?></p>
			<span class="pe-1 text-success"><?php echo $_SESSION['is_login']['name_role'] ?></span>
			<p class="pe-1" style="font-weight: 100; font-size: 12px; color:#ff55a5"><?php echo $_SESSION['is_login']['cinema_name'] ?></p>
		</div>

		<div class="sidebar__user-btn" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Đăng xuất">
			<a href="<?php echo _LINK ?>/dang-xuat.html" style="color:#fff"><i class="ti ti-logout"></i></a>

		</div>
	</div>
	<!-- end sidebar user -->

	<!-- sidebar nav -->
	<div class="sidebar__nav-wrap">
		<ul class="sidebar__nav">
			<li class="sidebar__nav-item">
				<a href="quan-ly.html" class="sidebar__nav-link"><i class="ti ti-layout-grid"></i>
					<span>Trang Admin</span></a>
			</li>
			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 6) { ?>
				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-tai-khoan.html" role="button" aria-expanded="false"><i
							class="ti ti-users"></i> <span>Quản lý Tài khoản</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="them-tai-khoan.html">Thêm nhân viên</a></li>
						<li><a href="danh-sach-thanh-vien.html">Danh sách Thành viên</a></li>
						<li><a href="quan-ly-tai-khoan.html">Danh sách Nhân viên</a></li>
					</ul>
				</li>
			<?php } ?>

			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 2) { ?>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-rap-phim.html" role="button" aria-expanded="false"><i
							class="ti ti-device-tv"></i><span>Quản lý Rạp phim</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="them-rap-phim.html">Thêm rạp phim</a></li>
						<li><a href="them-phong-chieu.html">Thêm phòng chiếu</a></li>
						<li><a href="quan-ly-rap-phim.html">Danh sách rạp phim</a></li>
					</ul>
				</li>
			<?php } ?>


			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 2) { ?>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-phim.html" role="button" aria-expanded="false"><i
							class="ti ti-movie"></i> <span>Quản lý phim</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="them-bo-phim.html">Thêm phim mới</a></li>
					</ul>
				</li>
			<?php } ?>

			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 3) { ?>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-suat-chieu.html" role="button" aria-expanded="false"><i class="ti ti-calendar"></i>
						<span>Quản lý lịch chiếu</span></a>
				</li>
			<?php } ?>

			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 5) { ?>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="https://webqr.com/" role="button" aria-expanded="false"><i class="ti ti-calendar"></i>
						<span>Kiểm tra vé</span></a>
				</li>
			<?php } ?>


			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 2) { ?>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-bap-nuoc.html" role="button" aria-expanded="false"><i
							class="ti ti-paper-bag"></i> <span>Quản lý Bắp-nước</span></a>
				</li>
			<?php } ?>

			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 2) { ?>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="quan-ly-voucher.html" role="button" aria-expanded="false"><i class="ti ti-ticket"></i> <span>Quản lý Ưu đãi</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="quan-ly-voucher.html">Voucher</a></li>
						<li><a href="quan-ly-qua-tang.html">Quà tặng</a></li>
					</ul>
				</li>
			<?php } ?>
			<?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 4) { ?>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="ban-ve.html" role="button" aria-expanded="false"><i class="ti ti-ticket"></i> <span>Bán vé</span></a>
				</li>
			<?php } ?>

			<!-- <li class="sidebar__nav-item">
				<a href="<?php echo _LINK ?>" class="sidebar__nav-link"><i class="ti ti-arrow-left"></i> <span>Back to
						HotFlix</span></a>
			</li> -->
		</ul>
	</div>
	<!-- end sidebar nav -->

	<!-- sidebar copyright -->
	<div class="sidebar__copyright text-center">© HOTFLIX, 2024. <br>Create by <a href="#" target="_blank">IUH student</a></div>
	<!-- end sidebar copyright -->
</div>
<!-- end sidebar -->