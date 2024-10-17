    <!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Cập nhật voucher</h2>
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
								<h3>Chương trình khuyến mãi: <?php echo $promotion[0]['promotion_name']; ?></h3>
								<span>Voucher ID: <?php echo $promotion[0]['id_promotion']; ?></span>
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
					<form action="#" class="sign__form sign__form--add" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									<div class="col-12">
										<div class="sign__group">
											<input type="text" name ="promotion_name" class="sign__input" placeholder="Tên chương trình" value="<?php echo isset($_POST['promotion_name']) ? $_POST['promotion_name'] : $promotion[0]['promotion_name']; ?>">
											<?php if (isset($error['promotion_name'])): ?>
                                            	<p class="error text-danger"><?php echo $error['promotion_name']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
                                            <label class="sign__label">Ngày bắt đầu:</label>
											<input type="date" class="sign__input" name="date_start" value="<?php echo isset($_POST['date_start']) ? $_POST['date_start'] : $promotion[0]['date_start']; ?>">
											<?php if (isset($error['date_start'])): ?>
                                            	<p class="error text-danger"><?php echo $error['date_start']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
											<textarea id="text" name="description" class="sign__textarea" placeholder="Mô tả"><?php echo isset($_POST['description']) ? $_POST['description'] :  $promotion[0]['description']; ?></textarea>
											<?php if (isset($error['description'])): ?>
                                            	<p class="error text-danger"><?php echo $error['description']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
                                        <div class="sign__group">
                                            <label class="sign__label">Loại voucher:</label>
                                            <ul class="sign__radio">
                                                <li>
                                                    <input id="type2" type="radio" name="discount_type" value="%" 
                                                    <?php
                                                        if(!isset($_POST['discount_type']) && $promotion[0]['discount_type']=='%'){
                                                            echo 'checked';
                                                        }
                                                        if(isset($_POST['discount_type']) && $_POST['discount_type']=='%'){
                                                            echo 'checked';
                                                        }
                                                    ?>
                                                    >
                                                    <label for="type2">%</label>
                                                </li>
                                                <li>
                                                    <input id="type3" type="radio" name="discount_type" value="Tiền"
                                                    <?php
                                                        if(!isset($_POST['discount_type']) && $promotion[0]['discount_type']=='Tiền'){
                                                            echo 'checked';
                                                        }
                                                        if(isset($_POST['discount_type']) && $_POST['discount_type']=='Tiền'){
                                                            echo 'checked';
                                                        }
                                                    ?>
                                                    >
                                                    <label for="type3">Tiền</label>
                                                </li>
                                            </ul>
                                        </div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<input type="number" class="sign__input" name="discount_value" placeholder="Giá trị giảm giá" value="<?php echo isset($_POST['discount_value']) ? $_POST['discount_value'] : $promotion[0]['discount_value']; ?>">
											<?php if (isset($error['discount_value'])): ?>
                                            	<p class="error text-danger"><?php echo $error['discount_value']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 col-xl-5" >
								<div class="row">
                                    <div class="col-12">
										<div class="sign__group">
											<input type="text" class="sign__input" name="promotion_code" placeholder="Mã CODE" value="<?php echo isset($_POST['promotion_code']) ? $_POST['promotion_code'] :$promotion[0]['promotion_code']; ?>">
											<?php if (isset($error['promotion_code'])): ?>
                                            	<p class="error text-danger"><?php echo $error['promotion_code']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
                                            <label class="sign__label">Ngày kết thúc:</label>
											<input type="date" class="sign__input" name="date_end" value="<?php echo isset($_POST['date_end']) ? $_POST['date_end'] : $promotion[0]['date_end']; ?>">
											<?php if (isset($error['date_end'])): ?>
                                            	<p class="error text-danger"><?php echo $error['date_end']; ?></p>
                                        	<?php endif; ?>
										</div>
									</div>

                                    <div class="col-12">
										<div class="sign__group">
											<div class="sign__gallery">
												<label id="gallery1" for="sign__gallery-upload">Ảnh voucher</label>
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
                                                    <img id="poster-img" src="<?php echo _WEB_ROOT?>/public/admin/img/promotion/<?php echo $promotion[0]['image']?>" alt="Poster Preview" class="img-fluid" style="max-width: 200px; max-height: 300px; object-fit: contain; display: block;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>

							<div class="col-12">
								<input type="submit" value="Cập nhật VOUCHER" class="sign__btn sign__btn--small mt-3" name="updatePromotion">
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
