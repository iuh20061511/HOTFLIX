	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Cập nhật thông tin</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- profile -->
				<div class="col-12">
					<div class="profile__content">
						<!-- profile user -->
						<div class="profile__user">
							<!-- or red -->
							<div class="profile__meta profile__meta--green">
								<h3><?php echo $infoStaff[0]['full_name']; ?><span>(Approved)</span></h3>
								<span>HotFlix ID: <?php echo $infoStaff[0]['id_staff']; ?></span>
							</div>
						</div>
						<!-- end profile user -->

						<!-- profile tabs nav -->
						<ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Hồ sơ</button>
							</li>
						</ul>
						<!-- end profile tabs nav -->

						<!-- profile btns -->
						<div class="profile__actions">
							<button type="button" data-bs-toggle="modal" class="profile__action profile__action--banned" data-bs-target="#modal-status3"><i class="ti ti-lock"></i></button>
							<button type="button" data-bs-toggle="modal" class="profile__action profile__action--delete" data-bs-target="#modal-delete3"><i class="ti ti-trash"></i></button>
						</div>
						<!-- end profile btns -->
					</div>
				</div>
				<!-- end profile -->

				<!-- content tabs -->
				<div class="row">

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add" method="POST">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Họ tên" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : $infoStaff[0]['full_name']; ?>">
											<?php if (isset($error['fullname'])): ?>
												<p class="error text-danger"><?php echo $error['fullname']; ?></p>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Email" name="email" value="<?php echo $infoStaff[0]['email']; ?>" readonly>
										</div>
									</div>
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
										<select class="sign__selectjs" id="sign__director" name="cinema">
											<?php
											// Gán tên rạp mặc định
											$selectedCinemaId = isset($_POST['cinema']) ? $_POST['cinema'] : $infoStaff[0]['id_cinema'];
											$cinemaName = '';

											// Tìm tên rạp đã chọn
											foreach ($listCinema as $cinema) {
												if ($cinema['id_cinema'] == $selectedCinemaId) {
													$cinemaName = $cinema['cinema_name'];
													break;
												}
											}
											?>
											<option value="<?php echo $selectedCinemaId; ?>" selected><?php echo $cinemaName ?: 'Chọn rạp - nơi làm việc'; ?></option>

											<?php foreach ($listCinema as $cinema) : ?>
												<?php if ($cinema['id_cinema'] != $selectedCinemaId) : ?>
													<option value="<?php echo $cinema['id_cinema']; ?>"><?php echo $cinema['cinema_name']; ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 col-xl-5">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
												<input type="number" class="sign__input" placeholder="Số điện thoại" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $infoStaff[0]['phone']; ?>">
												<?php if (isset($error['phone'])): ?>
													<p class="error text-danger"><?php echo $error['phone']; ?></p>
												<?php endif; ?>
										</div>

									</div>

									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="date" class="sign__input" placeholder="Ngày sinh" name="birthday" value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : $infoStaff[0]['birthday']; ?>">
											<?php if (isset($error['birthday'])): ?>
												<p class="error text-danger"><?php echo $error['birthday']; ?></p>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
										<select class="sign__selectjs" id="sign__actors" name="role">
											<?php
											// Gán giá trị mặc định cho role
											$selectedRoleId = isset($_POST['role']) ? $_POST['role'] : $infoStaff[0]['id_role'];
											$roleName = '';

											// Tìm tên role đã chọn
											foreach ($listRole as $role) {
												if ($role['id_role'] == $selectedRoleId) {
													$roleName = $role['ten_role'];
													break;
												}
											}
											?>
											<option value="<?php echo $selectedRoleId; ?>" selected><?php echo $roleName ?: 'Chọn vai trò'; ?></option>

											<?php foreach ($listRole as $role) : ?>
												<?php if ($role['id_role'] != 1 && $role['id_role'] != $selectedRoleId) : ?>
													<option value="<?php echo $role['id_role']; ?>"><?php echo $role['ten_role']; ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
										</div>
									</div>


								</div>
							</div>

							<div class="col-12" style="margin-top: 10px">
								<div class="sign__group">
									<label class="sign__label">Giới tính:</label>
									<ul class="sign__radio">
										<li>
											<input id="type1" type="radio" name="gender" checked="" value="Khác"
											<?php
												if(!isset($_POST['gender']) && $infoStaff[0]['gender']=='Khác'){
													echo 'checked';
												}
												if(isset($_POST['gender']) && $_POST['gender']=='Khác'){
													echo 'checked';
												}
											?>
											>
											<label for="type1">Khác</label>
										</li>
										<li>
											<input id="type2" type="radio" name="gender" value="Nữ" 
											<?php
												if(!isset($_POST['gender']) && $infoStaff[0]['gender']=='Nữ'){
													echo 'checked';
												}
												if(isset($_POST['gender']) && $_POST['gender']=='Nữ'){
													echo 'checked';
												}
											?>
											>
											<label for="type2">Nữ</label>
										</li>
										<li>
											<input id="type3" type="radio" name="gender" value="Nam"
											<?php
												if(!isset($_POST['gender']) && $infoStaff[0]['gender']=='Nam'){
													echo 'checked';
												}
												if(isset($_POST['gender']) && $_POST['gender']=='Nam'){
													echo 'checked';
												}
											?>
											>
											<label for="type3">Nam</label>
										</li>
									</ul>
								</div>
							</div>

							<div class="col-12">
								<input type="submit" value="Cập nhật" class="sign__btn sign__btn--small" name="updateUser">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
				<!-- end content tabs -->
			</div>
		</div>
	</main>
	<!-- end main content -->

	<!-- view modal -->
	<!-- <div class="modal fade" id="modal-view" tabindex="-1" aria-labelledby="modal-view" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content modal__content--view">
					<div class="comments__autor">
						<img class="comments__avatar" src="img/user.svg" alt="">
						<span class="comments__name">John Doe</span>
						<span class="comments__time">30.08.2023, 17:53</span>
					</div>
					<p class="comments__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
					<div class="comments__actions">
						<div class="comments__rate">
							<span><i class="ti ti-thumb-up"></i>12</span>

							<span>7<i class="ti ti-thumb-down"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end view modal -->

	<!-- delete modal -->
	<!-- <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="#" class="modal__form">
						<h4 class="modal__title">Comment delete</h4>

						<p class="modal__text">Are you sure to permanently delete this comment?</p>

						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="button"><span>Delete</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Dismiss</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end delete modal -->

	<!-- view modal -->
	<!-- <div class="modal fade" id="modal-view2" tabindex="-1" aria-labelledby="modal-view2" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content modal__content--view">
					<div class="reviews__autor">
						<img class="reviews__avatar" src="img/user.svg" alt="">
						<span class="reviews__name">Best Marvel movie in my opinion</span>
						<span class="reviews__time">24.08.2018, 17:53 by John Doe</span>

						<span class="reviews__rating reviews__rating--green">8.4</span>
					</div>
					<p class="reviews__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end view modal -->

	<!-- delete modal -->
	<!-- <div class="modal fade" id="modal-delete2" tabindex="-1" aria-labelledby="modal-delete2" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="#" class="modal__form">
						<h4 class="modal__title">Review delete</h4>

						<p class="modal__text">Are you sure to permanently delete this review?</p>

						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="button"><span>Delete</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Dismiss</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end delete modal -->

	<!-- status modal -->
	<!-- <div class="modal fade" id="modal-status3" tabindex="-1" aria-labelledby="modal-status3" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="#" class="modal__form">
						<h4 class="modal__title">Status change</h4>

						<p class="modal__text">Are you sure about immediately change status?</p>

						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="button"><span>Apply</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Dismiss</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end status modal -->

	<!-- delete modal -->
	<!-- <div class="modal fade" id="modal-delete3" tabindex="-1" aria-labelledby="modal-delete3" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="#" class="modal__form">
						<h4 class="modal__title">User delete</h4>

						<p class="modal__text">Are you sure to permanently delete this user?</p>

						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="button"><span>Delete</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Dismiss</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end delete modal -->