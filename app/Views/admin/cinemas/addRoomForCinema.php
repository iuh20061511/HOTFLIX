	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Thêm phòng chiếu mới</h2>
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
											<input type="text" class="sign__input" placeholder="Tên phòng tại rạp (VD: Phòng số 1)" name="room_name" value="<?php echo isset($_POST['room_name']) ? $_POST['room_name'] : ''; ?>">
											<div>
												<?php if (isset($error['room_name'])): ?>
													<p class="error text-danger"><?php echo $error['room_name']; ?></p>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 col-xl-5">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<select class="sign__selectjs" id="sign__actors" name="type_room">
												<?php
												// Mặc định loại phòng
												$selectedTypeRoomId = isset($_POST['type_room']) ? $_POST['type_room'] : 0;
												$typeRoom = 'Chọn loại phòng';

												// Tìm tên vai trò đã chọn
												foreach ($listTypeRoom as $type) {
													if ($type['id_roomType'] == $selectedTypeRoomId) {
														$typeRoom = $type['RoomType_name'];
														break;
													}
												}
												?>
												<option value="<?php echo $selectedTypeRoomId; ?>"><?php echo $typeRoom; ?></option>
												<?php foreach ($listTypeRoom as $type) : ?>
													<?php if ($type['id_roomType'] != $selectedTypeRoomId) : ?>
														<option value="<?php echo $type['id_roomType']; ?>"><?php echo $type['RoomType_name']; ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
											<div>
												<?php if (isset($error['type_room'])): ?>
													<p class="error text-danger"><?php echo $error['type_room']; ?></p>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 mt-5">
								<input type="submit" value="Thêm phòng chiếu" class="sign__btn sign__btn--small" name="addRoom">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->