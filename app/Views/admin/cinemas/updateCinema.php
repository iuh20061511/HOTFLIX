	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Cập nhật thông tin rạp phim</h2>
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
								<h3><?php echo $listCinema[0]['cinema_name']; ?><span>(Approved)</span></h3>
								<span>HotFlix Cinema-ID: <?php echo $listCinema[0]['id_cinema']; ?></span>
							</div>
						</div>
						<!-- end profile user -->

						<!-- profile tabs nav -->
						<ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Thông tin</button>
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

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add" method="POST">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Tên rạp phim mới" name="cinema_name" value="<?php echo isset($_POST['cinema_name']) ? $_POST['cinema_name'] : $listCinema[0]['cinema_name']; ?>">
											<?php if (isset($error['cinema_name'])): ?>
												<p class="error text-danger"><?php echo $error['cinema_name']; ?></p>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-lg-2" style="margin-top: 15px">
										<div class="sign__group" style="display: flex; align-items: center;">
											<label for="number_address" style="margin-right: 5px;color: #fff">Số: </label>
											<input type="text" class="sign__input" placeholder="Số" name="number_address" value="<?php echo isset($_POST['number_address']) ? $_POST['number_address'] :   $address_old['number_address']; ?>">
										</div>
									</div>

									<div class="col-12 col-xl-3" style="margin-top: 15px">
										<div class="sign__group" style="display: flex; align-items: center;">
											<label for="number_address" style="margin-right: 5px;color: #fff"">Đường: </label>
											<input type="text" class="sign__input" placeholder="Đường" name="street_address" value="<?php echo isset($_POST['street_address']) ? $_POST['street_address'] : $address_old['street_address']; ?>">
										</div>
									</div>

									<div class="col-12 col-xl-2" style="margin-top: 15px">
										<div class="sign__group" style="display: flex; align-items: center;">
											<label for="number_address" style="margin-right: 5px;color: #fff"">Phường: </label>
											<input type="text" class="sign__input" placeholder="Phường" name="ward_address" value="<?php echo isset($_POST['ward_address']) ? $_POST['ward_address'] : $address_old['ward_address']; ?>">
										</div>
									</div>

									<div class="col-12 col-xl-2" style="margin-top: 15px">
										<div class="sign__group">
                                        <?php 
                                            $listDistricts = [
                                                "Quận 1", "Quận 2", "Quận 3", "Quận 4", "Quận 5", "Quận 6", "Quận 7", 
                                                "Quận 8", "Quận 9", "Quận 10", "Quận 11", "Quận 12", "Quận Bình Thạnh", 
                                                "Quận Tân Bình", "Quận Bình Tân", "Quận Tân Phú", "Quận Gò Vấp", 
                                                "Quận Phú Nhuận", "Huyện Bình Chánh", "Huyện Cần Giờ", "Huyện Củ Chi", 
                                                "Huyện Nhà Bè"
                                            ];

                                            $selected_district = isset($_POST['district_address']) ? $_POST['district_address'] : $address_old['district_address'];
                                            ?>
                                            <select class="sign__selectjs" id="sign__actors" name="district_address">
                                                <?php foreach ($listDistricts as $district): ?>
                                                    <option value="<?= $district ?>" <?= ($district === $selected_district) ? 'selected' : '' ?>><?= $district ?></option>
                                                <?php endforeach; ?>
                                            </select>
										</div>
									</div>
									<div class="col-12 col-xl-3" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" name="city_address" value="Thành phố Hồ Chí Minh" readonly>
										</div>
									</div>
								</div>
								
								<?php if (isset($error['address'])) { ?>
												<p class="error text-danger m-1"><b><?php echo $error['address']; ?></b></p>
								<?php } ?>
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Số điện thoại" name="contact" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : $listCinema[0]['contact']; ?>">
											<?php if (isset($error['contact'])) { ?>
                                    		<p class="error text-danger m-1"><b><?php echo $error['contact']; ?></b></p>
                               			 <?php } ?>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12">
								<input type="submit" value="Cập nhật" class="sign__btn sign__btn--small" name="updateCinema">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->