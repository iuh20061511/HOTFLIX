	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Thêm rạp phim mới</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add" method="POST">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Tên rạp phim mới" name="cinema_name" value="<?php echo isset($_POST['cinema_name']) ? $_POST['cinema_name'] : ''; ?>">
											<div>
												<?php if (isset($error['cinema_name'])): ?>
													<p class="error text-danger"><?php echo $error['cinema_name']; ?></p>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-xl-2" style="margin-top: 15px">
										<div class="sign__group" style="display: flex; align-items: center;">
											<label for="number_address" style="margin-right: 5px;color: #fff">Số: </label>
											<input type="text" class="sign__input" placeholder="Số" name="number_address" value="<?php echo isset($_POST['number_address']) ? $_POST['number_address'] : ''; ?>">
										</div>
									</div>

									<div class="col-12 col-xl-3" style="margin-top: 15px">
										<div class="sign__group" style="display: flex; align-items: center;">
											<label for="number_address" style="margin-right: 5px;color: #fff">Đường: </label>
											<input type="text" class="sign__input" placeholder="Đường" name="street_address" value="<?php echo isset($_POST['street_address']) ? $_POST['street_address'] : ''; ?>">
										</div>
									</div>

									<div class="col-12 col-xl-2" style="margin-top: 15px">
										<div class="sign__group" style="display: flex; align-items: center;">
											<label for="number_address" style="margin-right: 5px;color: #fff">Phường: </label>
											<input type="text" class="sign__input" placeholder="Phường" name="ward_address" value="<?php echo isset($_POST['ward_address']) ? $_POST['ward_address'] : ''; ?>">
										</div>
									</div>

									<div class="col-12 col-xl-2" style="margin-top: 15px">
										<div class="sign__group">
										<?php 
                                            $listDistricts = [
                                                "Quận 1", "Quận 2", "Quận 3", "Quận 4", "Quận 5", "Quận 6", "Quận 7", 
                                                "Quận 8", "Quận 9", "Quận 10", "Quận 11", "Quận 12", "Q.Bình Thạnh", 
                                                "Q.Tân Bình", "Q.Bình Tân", "Q.Tân Phú", "Q.Gò Vấp", 
                                                "Q.Phú Nhuận", "H.Bình Chánh", "H.Cần Giờ", "H.Củ Chi", 
                                                "H.Nhà Bè","Q.Thủ Đức"
                                            ];

                                            $selected_district = isset($_POST['district_address']) ? $_POST['district_address'] : '';
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
											<input type="text" class="sign__input" placeholder="Số điện thoại" name="contact" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : ''; ?>">
											<div>
												<?php if (isset($error['contact'])) { ?>
												<p class="error text-danger m-1"><b><?php echo $error['contact']; ?></b></p>
											</div>
                               			 <?php } ?>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 mt-5">
								<input type="submit" value="Thêm rạp phim" class="sign__btn sign__btn--small" name="addCinema">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->