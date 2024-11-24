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
								<h3><?php echo $infoStaff[0]['full_name']; ?></h3>
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
										<select class="sign__selectjs" id="sign__actors" name="role">
											<?php
											// Gán giá trị mặc định cho role
											$selectedRoleId = isset($_POST['role']) ? $_POST['role'] : $infoStaff[0]['id_role'];
											$roleName = '';

											// Tìm tên role đã chọn
											foreach ($listRole as $role) {
												if ($role['id_role'] == $selectedRoleId) {
													$roleName = $role['name_role'];
													break;
												}
											}
											?>
											<option value="<?php echo $selectedRoleId; ?>" selected><?php echo $roleName ?: 'Chọn vai trò'; ?></option>

											<?php foreach ($listRole as $role) : ?>
												<?php if ($role['id_role'] != 1 && $role['id_role'] != $selectedRoleId) : ?>
													<option value="<?php echo $role['id_role']; ?>"><?php echo $role['name_role']; ?></option>
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
											<option value="0" selected><?php echo $cinemaName ?: 'Chọn rạp - nơi làm việc'; ?></option>

											<?php foreach ($listCinema as $cinema) : ?>
												<?php if ($cinema['id_cinema'] != $selectedCinemaId) : ?>
													<option value="<?php echo $cinema['id_cinema']; ?>"><?php echo $cinema['cinema_name']; ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
										<?php if (isset($error['cinema'])): ?>
											<p class="error text-danger"><?php echo $error['cinema']; ?></p>
										<?php endif; ?>
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

	<script>
		document.addEventListener("DOMContentLoaded", function () {
		const selectRole = document.getElementById("sign__actors");
		const selectCinema = document.getElementById("sign__director");

		// Các ID vai trò cần vô hiệu hóa chọn rạp
		const disabledRoles = [2, 6];

		// Hàm cập nhật trạng thái của danh sách rạp
		function updateCinemaState() {
			if (disabledRoles.includes(parseInt(selectRole.value))) {
				selectCinema.disabled = true; // Vô hiệu hóa
				selectCinema.classList.add("disabled-select"); // Thêm hiệu ứng CSS
			} else {
				selectCinema.disabled = false; // Kích hoạt lại
				selectCinema.classList.remove("disabled-select"); // Bỏ hiệu ứng CSS
			}
		}

		// Lắng nghe sự kiện thay đổi trên danh sách vai trò
		selectRole.addEventListener("change", updateCinemaState);

		// Cập nhật trạng thái ban đầu
			updateCinemaState();
		});

	</script>