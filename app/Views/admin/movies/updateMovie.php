    <!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Cập nhật phim</h2>
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
								<h3><?php echo $movieUpdate[0]['movie_name']; ?></h3>
								<span>HotFlix ID: <?php echo $movieUpdate[0]['id_movie']; ?></span>
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

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									<div class="col-12">
										<div class="sign__group">
											<input type="text" name ="movie_name" class="sign__input" placeholder="Tên phim" value="<?php echo isset($_POST['movie_name']) ? $_POST['movie_name'] : $movieUpdate[0]['movie_name']; ?>">
											<?php if (isset($error['movie_name'])): ?>
                                            	<p class="error text-danger"><?php echo $error['movie_name']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
											<textarea id="text" name="description" class="sign__textarea" placeholder="Mô tả - Nội dung phim"><?php echo isset($_POST['description']) ? $_POST['description'] : $movieUpdate[0]['description']; ?></textarea>
											<?php if (isset($error['description'])): ?>
                                            	<p class="error text-danger"><?php echo $error['description']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<input type="text" class="sign__input" name="director" placeholder="Đạo diễn" value="<?php echo isset($_POST['director']) ? $_POST['director'] : $movieUpdate[0]['director']; ?>">
											<?php if (isset($error['director'])): ?>
                                            	<p class="error text-danger"><?php echo $error['director']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<input type="text" class="sign__input" name="actor" placeholder="Diễn viên" value="<?php echo isset($_POST['actor']) ? $_POST['actor'] : $movieUpdate[0]['actor'];?>">
											<?php if (isset($error['actor'])): ?>
                                            	<p class="error text-danger"><?php echo $error['actor']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<?php
											$listNation = [
												"Việt Nam", "Hàn Quốc", "Nhật Bản", "Mỹ", "Trung Quốc", "Thái Lan", 
												"Anh", "Pháp", "Ấn Độ", "Canada", "Úc", "New Zealand", "Mexico", "Tây Ban Nha", "Đức", "Brazil"
												];
												$selected_nation = isset($_POST['nation']) ? $_POST['nation'] : $movieUpdate[0]['nation'];
											?>
											<select class="sign__selectjs" id="sign__country" name="nation">
											<option value="0" <?= ($selected_nation === '') ? 'selected' : '' ?>>--Quốc gia sản xuất--</option>
												<?php foreach ($listNation as $nation): ?>
                                                    <option value="<?= $nation ?>" <?= ($nation === $selected_nation) ? 'selected' : '' ?>><?= $nation ?></option>
                                                <?php endforeach; ?>
											</select>
											<?php if (isset($error['nation'])): ?>
                                            	<p class="error text-danger"><?php echo $error['nation']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

									<div class="col-12 col-md-6">
										<div class="sign__group">
                                            <input type="number" class="sign__input" name="duration" placeholder="Thời lượng (phút)" value="<?php echo isset($_POST['duration']) ? $_POST['duration'] : $movieUpdate[0]['duration']; ?>">
											<?php if (isset($error['duration'])): ?>
                                            	<p class="error text-danger"><?php echo $error['duration']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

									<div class="col-12 col-md-6">
										<div class="sign__group">
											<input type="date" class="sign__input" name="release_date" placeholder="Ngày phát hành" value="<?php echo isset($_POST['release_date']) ? $_POST['release_date'] : $movieUpdate[0]['release_date']; ?>">
											<?php if (isset($error['release_date'])): ?>
                                            	<p class="error text-danger"><?php echo $error['release_date']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 col-xl-5" >
								<div class="row">
									<div class="col-12">
										<div class="sign__group">
										<?php
											$listGenre = [
												"Kinh dị", "Giật gân", "Phiêu lưu", "Phim hài", "Hoạt hình", "Tài liệu",
												"Gia đình", "Hành động", "Lãng mạn", "Ly kì", "Giả tưởng", "Hồi hộp", "Tâm lý", "Tội phạm"];
                                                // Chuyển chuỗi thành mảng
                                                $selected_genre = isset($movieUpdate[0]['genre']) ? explode(",", $movieUpdate[0]['genre']) : [];
												// $selected_genre = isset($_POST['genre']) ? $_POST['genre'] : [];
                                                if (isset($_POST['genre'])) {
                                                    $selected_genre = $_POST['genre'];
                                                }
										?>
                                            <select class="sign__selectjs" id="sign__genre" name="genre[]" multiple>
											<?php foreach ($listGenre as $genre): ?>
												<option value="<?= $genre ?>" <?= (in_array($genre, $selected_genre)) ? 'selected' : '' ?>><?= $genre ?></option>
                                            <?php endforeach; ?>
                                            </select>
											<div>
                                                <?php if (isset($error['genre'])): ?>
                                                    <p class="error text-danger"><?php echo $error['genre']; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<input type="text" class="sign__input" name="trailer" placeholder="Link trailer" value="<?php echo isset($_POST['trailer']) ? $_POST['trailer'] : $movieUpdate[0]['trailer']; ?>">
											<?php if (isset($error['trailer'])): ?>
                                            	<p class="error text-danger"><?php echo $error['trailer']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<div class="sign__gallery">
												<label id="gallery1" for="sign__gallery-upload">Poster</label>
												<input data-name="#gallery1" id="sign__gallery-upload" name="poster" class="sign__gallery-upload" type="file" accept=".png, .jpg, .jpeg" >
											</div>
											<?php if (isset($error['poster'])): ?>
                                            		<p class="error text-danger"><?php echo $error['poster']; ?></p>
                                        		<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12" style="margin-top: 15px">
                                        <div class="sign__group">
                                            <label style="color:#fff; margin-bottom:5px">Xem trước Poster:</label>
                                            <div class="row justify-content-center">
                                                <div id="poster-preview" class="poster-preview rounded d-flex justify-content-center align-items-center" style="height: 310px; width: 300px; border: 1px solid #ff55a5; margin-top: 10px;">
                                                    <img id="poster-img" src="<?php echo _WEB_ROOT?>/public/admin/img/movies/<?php echo $movieUpdate[0]['poster']?>" alt="Poster Preview" class="img-fluid" style="max-width: 200px; max-height: 300px; object-fit: contain; display: block;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>

							<div class="col-12">
								<input type="submit" value="Cập nhật phim" class="sign__btn sign__btn--small mt-3" name="updateMovie">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->

    <script>
    document.getElementById('sign__gallery-upload').addEventListener('change', function(event) {
    var file = event.target.files[0]; // Lấy file người dùng đã chọn
    var preview = document.getElementById('poster-img'); // Tìm đến phần tử img để hiển thị ảnh

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result; // Gán đường dẫn ảnh
            preview.style.display = 'block'; // Hiển thị ảnh
        }

        reader.readAsDataURL(file); // Đọc tệp dưới dạng URL
    } else {
        preview.style.display = 'none'; // Ẩn ảnh nếu không có tệp nào được chọn
    }
});
</script>
