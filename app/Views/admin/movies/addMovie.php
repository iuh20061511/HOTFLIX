    <!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Thêm phim mới</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									<div class="col-12">
										<div class="sign__group">
											<input type="text" name ="movie_name" class="sign__input" placeholder="Tên phim" value="<?php echo isset($_POST['movie_name']) ? $_POST['movie_name'] : ''; ?>">
											<?php if (isset($error['movie_name'])): ?>
                                            	<p class="error text-danger"><?php echo $error['movie_name']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
											<textarea id="text" name="description" class="sign__textarea" placeholder="Mô tả - Nội dung phim"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
											<?php if (isset($error['description'])): ?>
                                            	<p class="error text-danger"><?php echo $error['description']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<input type="text" class="sign__input" name="director" placeholder="Đạo diễn" value="<?php echo isset($_POST['director']) ? $_POST['director'] : ''; ?>">
											<?php if (isset($error['director'])): ?>
                                            	<p class="error text-danger"><?php echo $error['director']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<input type="text" class="sign__input" name="actor" placeholder="Diễn viên" value="<?php echo isset($_POST['actor']) ? $_POST['actor'] : ''; ?>">
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
												$selected_nation = isset($_POST['nation']) ? $_POST['nation'] : '';
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
                                            <input type="number" class="sign__input" name="duration" placeholder="Thời lượng (phút)" value="<?php echo isset($_POST['duration']) ? $_POST['duration'] : ''; ?>">
											<?php if (isset($error['duration'])): ?>
                                            	<p class="error text-danger"><?php echo $error['duration']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

									<div class="col-12 col-md-6">
										<div class="sign__group">
											<input type="date" class="sign__input" name="release_date" placeholder="Ngày phát hành" value="<?php echo isset($_POST['release_date']) ? $_POST['release_date'] : ''; ?>">
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
												$selected_genre = isset($_POST['genre']) ? $_POST['genre'] : [];
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
											<input type="text" class="sign__input" name="trailer" placeholder="Link trailer" value="<?php echo isset($_POST['trailer']) ? $_POST['trailer'] : ''; ?>">
											<?php if (isset($error['trailer'])): ?>
                                            	<p class="error text-danger"><?php echo $error['trailer']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<div class="sign__gallery">
												<label id="gallery1" for="sign__gallery-upload">Poster</label>
												<input data-name="#gallery1" id="sign__gallery-upload" name="poster" class="sign__gallery-upload" type="file" accept=".png, .jpg, .jpeg">
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
                                                    <img id="poster-img" src="" alt="Poster Preview" class="img-fluid" style="max-width: 200px; max-height: 300px; object-fit: contain; display: none;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>

							<div class="col-12">
								<input type="submit" value="Thêm phim" class="sign__btn sign__btn--small mt-3" name="addMovie">
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
