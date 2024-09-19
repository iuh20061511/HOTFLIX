	<!-- sidebar -->
	<div class="sidebar">
		<!-- sidebar user -->
		<div class="sidebar__user">
			<div class="sidebar__user-img">
				<img src="<?php echo _WEB_ROOT ?>/public/admin/img/user.svg" alt="">
			</div>

			<div class="sidebar__user-title">
				<span><?php echo $_SESSION['is_login']['name_role']?></span>
				<!-- <span>cc</span> -->
				<p><?php echo $_SESSION['is_login']['fullname']?></p>
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
					<a href="index-2.html" class="sidebar__nav-link"><i class="ti ti-layout-grid"></i> <span>Dashboard</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-users"></i> <span>Users</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="add-item.html">Add user</a></li>
						<li><a href="edit-user.html">Edit user</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-movie"></i> <span>Movies</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="add-item.html">Add movies</a></li>
						<li><a href="edit-user.html">Edit movies</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-video-camera"></i> <span>Cinemas</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="add-item.html">Add cinema</a></li>
						<li><a href="edit-user.html">Edit cinema</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
				<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-video-camera"></i> <span>Rooms</span> <i class="ti ti-chevron-down"></i></a>
					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="add-item.html">Add cinema</a></li>
						<li><a href="edit-user.html">Edit cinema</a></li>
					</ul>
				</li>

				<li class="sidebar__nav-item">
					<a href="comments.html" class="sidebar__nav-link"><i class="ti ti-message"></i> <span>Comments</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="reviews.html" class="sidebar__nav-link"><i class="ti ti-star-half-filled"></i> <span>Reviews</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="settings.html" class="sidebar__nav-link"><i class="ti ti-settings"></i> <span>Settings</span></a>
				</li>

				<!-- dropdown -->
				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-files"></i> <span>Pages</span> <i class="ti ti-chevron-down"></i></a>

					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="add-item.html">Add item</a></li>
						<li><a href="edit-user.html">Edit user</a></li>
						<li><a href="signin.html">Sign In</a></li>
						<li><a href="signup.html">Sign Up</a></li>
						<li><a href="forgot.html">Forgot password</a></li>
						<li><a href="404.html">404 Page</a></li>
					</ul>
				</li>
				<!-- end dropdown -->

				<li class="sidebar__nav-item">
					<a href="<?php echo _LINK?>" class="sidebar__nav-link"><i class="ti ti-arrow-left"></i> <span>Back to HotFlix</span></a>
				</li>
			</ul>
		</div>
		<!-- end sidebar nav -->
         
		<!-- sidebar copyright -->
		<div class="sidebar__copyright">© HOTFLIX, 2024. <br>Create by <a href="#" target="_blank">IUH student</a></div>
		<!-- end sidebar copyright -->
	</div>
	<!-- end sidebar -->