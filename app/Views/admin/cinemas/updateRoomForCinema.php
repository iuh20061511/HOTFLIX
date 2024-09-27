	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Cập nhật phòng chiếu</h2>
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
								<h3><?php echo $cinema[0]['cinema_name']; ?><span>(Approved)</span></h3>
								<h3><?php echo $listRoom[0]['room_name']; ?></h3>
								<span>HotFlix Room-ID: <?php echo $listRoom[0]['id_room']; ?></span>
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
							<div class="col-12 col-xl-7">
								<div class="row">
									<div class="col-12" style="margin-top: 15px">
                                    <div class="sign__group">
											<?php
												$cinemaName = '';
												$selectedCinemaId = $listRoom[0]['id_cinema'];

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
                                                <input type="text" class="sign__input" placeholder="" name="cinemaName" value="<?php echo $cinemaName; ?>" readonly>
                                                <input type="hidden" class="sign__input" placeholder="" name="cinema" value="<?php echo $listRoom[0]['id_cinema']; ?>">
										</div>
									</div>

									<div class="col-12" style="margin-top: 15px">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Tên phòng tại rạp (VD: Phòng số 1)" name="room_name" value="<?php echo isset($_POST['room_name']) ? $_POST['room_name'] : $listRoom[0]['room_name']; ?>">
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
                                                $selectedTypeRoomId = isset($_POST['type_room']) ? $_POST['type_room'] : $listRoom[0]['id_roomType'];
                                                $typeRoom = '';

                                                // Tìm tên vai trò đã chọn
                                                foreach ($listTypeRoom as $type) {
                                                    if ($type['id_roomType'] == $selectedTypeRoomId) {
                                                        $typeRoom = $type['RoomType_name'];
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <option value="<?php echo $selectedTypeRoomId; ?>" selected><?php echo $typeRoom ?: 'Chọn loại phòng'; ?></option>
                                                <?php foreach ($listTypeRoom as $type) : ?>
                                                    <?php if ($type['id_roomType'] != $selectedTypeRoomId) : ?>
                                                        <option value="<?php echo $type['id_roomType']; ?>"><?php echo $type['RoomType_name']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
										</div>
									</div>

								</div>
							</div>

							<div class="col-12 mt-5">
								<input type="submit" value="Cập nhật phòng" class="sign__btn sign__btn--small" name="updateRoom">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->