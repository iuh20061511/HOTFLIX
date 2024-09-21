	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Thêm nhân viên mới</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add" method="POST">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Họ tên" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : ''; ?>">
											<?php if (isset($error['fullname'])): ?>
												<p class="error text-danger"><?php echo $error['fullname']; ?></p>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
											<?php if (isset($error['email'])) { ?>
                                    		<p class="error text-danger m-1"><b><?php echo $error['email']; ?></b></p>
                               			 <?php } ?>
										</div>
									</div>
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<select class="sign__selectjs" id="sign__director" name="cinema">
											<?php
												$cinemaName = 'Chọn rạp - nơi làm việc';
												$selectedCinemaId = isset($_POST['cinema']) ? $_POST['cinema'] : 0;

												// Nếu đã chọn rạp
												if ($selectedCinemaId) {
													foreach ($listCinema as $cinema) {
														if ($cinema['id_cinema'] == $selectedCinemaId) {
															$cinemaName = $cinema['cinema_name'];
															break;
														}
													}
												}
												?>
													<option value="<?php echo $selectedCinemaId; ?>"><?php echo $cinemaName; ?></option>
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

							<div class="col-12 col-xl-5">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
												<input type="number" class="sign__input" placeholder="Số điện thoại" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
												<?php if (isset($error['phone'])): ?>
													<p class="error text-danger"><?php echo $error['phone']; ?></p>
												<?php endif; ?>
										</div>

									</div>

									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="date" class="sign__input" placeholder="Ngày sinh" name="birthday" value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : ''; ?>">
											<?php if (isset($error['birthday'])): ?>
												<p class="error text-danger"><?php echo $error['birthday']; ?></p>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
										<select class="sign__selectjs" id="sign__actors" name="role">
											<?php
											// Mặc định tên vai trò
											$selectedRoleId = isset($_POST['role']) ? $_POST['role'] : 0;
											$roleName = 'Chọn vai trò';

											// Tìm tên vai trò đã chọn
											foreach ($listRole as $role) {
												if ($role['id_role'] == $selectedRoleId) {
													$roleName = $role['ten_role'];
													break;
												}
											}
											?>
											<option value="<?php echo $selectedRoleId; ?>"><?php echo $roleName; ?></option>
											<?php foreach ($listRole as $role) : ?>
												<?php if ($role['id_role'] != 1 && $role['id_role'] != $selectedRoleId) : ?>
													<option value="<?php echo $role['id_role']; ?>"><?php echo $role['ten_role']; ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>

											<?php if (isset($error['role'])): ?>
												<p class="error text-danger"><?php echo $error['role']; ?></p>
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
											<input id="type1" type="radio" name="gender" checked="" value="Khác">
											<label for="type1">Khác</label>
										</li>
										<li>
											<input id="type2" type="radio" name="gender" value="Nữ">
											<label for="type2">Nữ</label>
										</li>
										<li>
											<input id="type3" type="radio" name="gender" value="Nam">
											<label for="type3">Nam</label>
										</li>
									</ul>
								</div>
							</div>

							<div class="col-12">
								<input type="submit" value="Thêm người dùng" class="sign__btn sign__btn--small" name="addUser">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->