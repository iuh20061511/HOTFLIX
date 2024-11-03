	<!-- page title -->
	<section class="section section--first section--bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/section_bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title section__title--head">HOTFLIX</h1>
						<!-- end section title -->

						<!-- breadcrumbs -->
						<ul class="breadcrumbs">
							<li class="breadcrumbs__item"><a href="<?php echo _LINK ?>">Home</a></li>
							<li class="breadcrumbs__item breadcrumbs__item--active">Hồ sơ cá nhân</li>
						</ul>
						<!-- end breadcrumbs -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- content -->
	<div class="content">
		<!-- profile -->
		<div class="profile">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="profile__content">
							<div class="profile__user">
								<div class="profile__avatar">
									<img width="40px" src="<?php echo _WEB_ROOT ?>/public/assets/img/user/user_account.png" alt="User avatar">
								</div>
								<div class="profile__meta">
									<h3><?php echo $user[0]['full_name']?></h3>
								</div>
							</div>

							<!-- content tabs nav -->
							<ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
								<li class="nav-item" role="presentation">
									<button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Thông tin cá nhân</button>
								</li>

								<li class="nav-item" role="presentation">
									<a href="lich-su-giao-dich.html"><button id="2-tab" type="button" role="tab" aria-controls="tab-2" aria-selected="false">Lịch sử giao dịch</button></a>
								</li>

								<li class="nav-item" role="presentation">
									<button id="3-tab" type="button" role="tab" aria-controls="tab-3" aria-selected="false">Settings</button>
								</li>
							</ul>
							<!-- end content tabs nav -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end profile -->

		<div class="container">
			<!-- content tabs -->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
					<div class="row">
						<!-- details form -->
						<div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
							<form action="#" class="sign__form sign__form--profile" method="post">
								<div class="row">
									<div class="col-12">
										<!-- <h4 class="sign__title">Profile details</h4> -->
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="fullname">Họ và tên</label>
											<input id="fullname" type="text" name="fullname" class="sign__input" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : $user[0]['full_name'] ?>">
										</div>
										<?php if (isset($error['fullname'])): ?>
											<p class="error text-danger"><?php echo $error['fullname']; ?></p>
										<?php endif; ?>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="birthday">Ngày sinh</label>
											<input id="birthday" type="text" name="birthday" class="sign__input" value="<?php echo date('d/m/Y', strtotime($user[0]['birthday']))?>" readonly>
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="email">Email</label>
											<input id="email" type="text" name="email" class="sign__input" value="<?php echo $user[0]['email']?>" readonly>
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="phone">Số điện thoại</label>
											<input id="phone" type="text" name="phone" class="sign__input" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $user[0]['phone']; ?>">
										</div>
										<?php if (isset($error['phone'])): ?>
											<p class="error text-danger"><?php echo $error['phone']; ?></p>
										<?php endif; ?>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label">Giới tính:</label>
											<ul class="sign__radio" style=" flex-direction: row; gap: 15px; align-items: center;">
												<li>
													<input id="type1" type="radio" name="gender" value="Khác"
													<?php
														if(!isset($_POST['gender']) && $user[0]['gender']=='Khác'){
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
														if(!isset($_POST['gender']) && $user[0]['gender']=='Nữ'){
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
														if(!isset($_POST['gender']) && $user[0]['gender']=='Nam'){
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
										<input type="submit" value="Cập nhật" class="sign__btn sign__btn--small" name="updateInfor">
									</div>
								</div>
							</form>
						</div>
						<!-- end details form -->

						<!-- password form -->
						<div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
							<form action="#" class="sign__form sign__form--profile" method="POST">
								<div class="row">
									<div class="col-12">
										<h4 class="sign__title">Đổi mật khẩu</h4>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="oldpass">Mật khẩu hiện tại</label>
											<input id="oldpass" type="password" name="oldpass" class="sign__input" value="<?php echo isset($_POST['oldpass']) ? $_POST['oldpass'] : '' ?>">
										</div>
										<?php if (isset($error['oldpass'])): ?>
											<p class="error text-danger"><?php echo $error['oldpass']; ?></p>
										<?php endif; ?>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="password">Mật khẩu mới</label>
											<input id="password" type="password" name="newPassword" class="sign__input" value="<?php echo isset($_POST['newPassword']) ? $_POST['newPassword'] : '' ?>">
										</div>
										<?php if (isset($error['newPassword'])): ?>
											<p class="error text-danger"><?php echo $error['newPassword']; ?></p>
										<?php endif; ?>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="confirmPassword">Xác nhận mật khẩu mới</label>
											<input id="confirmPassword" type="password" name="confirmPassword" class="sign__input">
										</div>
										<?php if (isset($error['confirmPassword'])): ?>
											<p class="error text-danger"><?php echo $error['confirmPassword']; ?></p>
										<?php endif; ?>
									</div>

									<div class="col-12">
										<input type="submit" value="Lưu" class="sign__btn sign__btn--small" name="changePassword">
									</div>
								</div>
							</form>
						</div>
						<!-- end password form -->
					</div>
				</div>

				<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab" tabindex="0">
				<div class="row">
						<!-- stats -->
						<div class="col-12 col-sm-6 col-xl-3">
							<div class="stats">
								<span>Premium plan</span>
								<p>$19.99</p>
								<img src="img/credit-card.svg" alt="">
							</div>
						</div>
						<!-- end stats -->

						<!-- stats -->
						<div class="col-12 col-sm-6 col-xl-3">
							<div class="stats">
								<span>Films watched</span>
								<p>1 172</p>
								<img src="img/film.svg" alt="">
							</div>
						</div>
						<!-- end stats -->

						<!-- stats -->
						<div class="col-12 col-sm-6 col-xl-3">
							<div class="stats">
								<span>Your comments</span>
								<p>2 573</p>
								<img src="img/comments.svg" alt="">
							</div>
						</div>
						<!-- end stats -->

						<!-- stats -->
						<div class="col-12 col-sm-6 col-xl-3">
							<div class="stats">
								<span>Your reviews</span>
								<p>1 021</p>
								<img src="img/star-half-alt.svg" alt="">
							</div>
						</div>
						<!-- end stats -->

						<!-- dashbox -->
						<div class="col-12 col-xl-6">
							<div class="dashbox">
								<div class="dashbox__title">
									<h3><img src="img/film.svg" alt="">Recent Views</h3>

									<div class="dashbox__wrap">
										<a class="dashbox__refresh" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21,11a1,1,0,0,0-1,1,8.05,8.05,0,1,1-2.22-5.5h-2.4a1,1,0,0,0,0,2h4.53a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4.77A10,10,0,1,0,22,12,1,1,0,0,0,21,11Z"/></svg></a>
										<a class="dashbox__more" href="catalog.html">View All</a>
									</div>
								</div>

								<div class="dashbox__table-wrap dashbox__table-wrap--1">
									<table class="dashbox__table">
										<thead>
											<tr>
												<th>ID</th>
												<th>TITLE</th>
												<th>CATEGORY</th>
												<th>RATING</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="dashbox__table-text">321</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">The Lost City</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Movie</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">9.2</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">54</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">Undercurrents</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Anime</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">9.1</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">670</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">Tales from the Underworld</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">TV Show</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">9.0</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">241</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">The Unseen World</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">TV Show</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">8.9</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">22</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">Redemption Road</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Movie</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">8.9</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- end dashbox -->

						<!-- dashbox -->
						<div class="col-12 col-xl-6">
							<div class="dashbox">
								<div class="dashbox__title">
									<h3><img src="img/star-half-alt.svg" alt="">Latest reviews</h3>

									<div class="dashbox__wrap">
										<a class="dashbox__refresh" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21,11a1,1,0,0,0-1,1,8.05,8.05,0,1,1-2.22-5.5h-2.4a1,1,0,0,0,0,2h4.53a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4.77A10,10,0,1,0,22,12,1,1,0,0,0,21,11Z"/></svg></a>
										<a class="dashbox__more" href="reviews.html">View All</a>
									</div>
								</div>

								<div class="dashbox__table-wrap dashbox__table-wrap--2">
									<table class="dashbox__table">
										<thead>
											<tr>
												<th>ID</th>
												<th>ITEM</th>
												<th>AUTHOR</th>
												<th>RATING</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="dashbox__table-text">126</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">I Dream in Another Language</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Jackson Brown</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">7.2</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">125</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">Benched</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Quang</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">6.3</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">124</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">Whitney</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Brian Cranston</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">8.4</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">123</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">Blindspotting</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Ketut</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">9.0</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="dashbox__table-text">122</div>
												</td>
												<td>
													<div class="dashbox__table-text"><a href="details1.html">I Dream in Another Language</a></div>
												</td>
												<td>
													<div class="dashbox__table-text">Eliza Josceline</div>
												</td>
												<td>
													<div class="dashbox__table-text dashbox__table-text--rate">7.7</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- end dashbox -->
					</div>
				</div>
			</div>
			<!-- end content tabs -->
		</div>
	</div>
	<!-- end content -->