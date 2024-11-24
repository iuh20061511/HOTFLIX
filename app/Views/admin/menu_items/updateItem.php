    <!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Cập nhật bắp nước-combo</h2>
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
											<input type="text" name ="item_name" class="sign__input" placeholder="Tên mặt hàng" value="<?php echo isset($_POST['item_name']) ? $_POST['item_name'] : $itemUpdate[0]['item_name']; ?>">
											<?php if (isset($error['item_name'])): ?>
                                            	<p class="error text-danger"><?php echo $error['item_name']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
											<textarea id="text" name="description" class="sign__textarea" placeholder="Mô tả"><?php echo isset($_POST['description']) ? $_POST['description'] : $itemUpdate[0]['description']; ?></textarea>
											<?php if (isset($error['description'])): ?>
                                            	<p class="error text-danger"><?php echo $error['description']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<input type="number" class="sign__input" name="price" placeholder="Giá cả" value="<?php echo isset($_POST['price']) ? $_POST['price'] : $itemUpdate[0]['price']; ?>">
											<?php if (isset($error['price'])): ?>
                                            	<p class="error text-danger"><?php echo $error['price']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 col-xl-5" >
								<div class="row">
                                    <div class="col-12">
										<div class="sign__group">
											<div class="sign__gallery">
												<label id="gallery1" for="sign__gallery-upload">Ảnh mặt hàng</label>
												<input data-name="#gallery1" id="sign__gallery-upload" name="image" class="sign__gallery-upload" type="file" accept=".png, .jpg, .jpeg">
											</div>
											<?php if (isset($error['image'])): ?>
                                            		<p class="error text-danger"><?php echo $error['image']; ?></p>
                                        		<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12" style="margin-top: 15px">
                                        <div class="sign__group">
                                            <label style="color:#fff; margin-bottom:5px">Xem trước ảnh:</label>
                                            <div class="row justify-content-center">
                                                <div id="poster-preview" class="poster-preview rounded d-flex justify-content-center align-items-center" style="height: 310px; width: 300px; border: 1px solid #ff55a5; margin-top: 10px;">
                                                    <img id="poster-img" src="<?php echo _WEB_ROOT?>/public/admin/img/menu_items/<?php echo $itemUpdate[0]['image']?>" alt="Poster Preview" class="img-fluid" style="max-width: 200px; max-height: 300px; object-fit: contain; display: block;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>

							<div class="col-12">
								<input type="submit" value="Cập nhật mặt hàng" class="sign__btn sign__btn--small mt-3" name="updateItem">
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
