	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="main__title m-3">
						<div class="mb-3 align-items-center ">
							<label class="mb-2 text-light" for="">Chọn thời gian xem thống kê:</label>
							<form action="" method="post">
								<input type="week" id="week" name="week" class="form-control" value="<?php echo isset($_POST['week']) ? $_POST['week'] : date('Y-\WW'); ?>">
								<input type="submit" value="SUB">
							</form>

						</div>

					</div>
				</div>

				<div class="col-12 col-sm-6 col-xl-3">
					<div class="stats">
						<span>Doanh vé tuần</span>
						<p style="font-size: 20px;">
							<?php if (isset($total_revenue)) : ?>
								<?= number_format($total_revenue, 0, ',', '.') ?> VNĐ
								<b class="<?= $weeklyRevenueRate > 1 ? 'green' : 'red' ?>">
									<?= ($weeklyRevenueRate > 1 ? '+' : '') . $weeklyRevenueRate ?>%
								</b>
							<?php endif; ?>
						</p>
						<br>

						<i class="ti ti-diamond" style="font-size: 20px;"></i>
					</div>
				</div>
				<!-- end stats -->

				<!-- stats -->
				<div class="col-12 col-sm-6 col-xl-3">
					<div class="stats">
						<span>Doanh vé thu tháng</span>
						<p style="font-size: 20px;">
							<?php if (isset($total_revenue_month)) : ?>
								<?= number_format($total_revenue_month, 0, ',', '.') ?> VNĐ
								<b class="<?= $monthlyRevenueRate > 1 ? 'green' : 'red' ?>">
									<?= ($monthlyRevenueRate > 1 ? '+' : '') . $monthlyRevenueRate ?>%
								</b>
							<?php endif; ?>
						</p><br>
						<i class="ti ti-movie" style="font-size: 20px;"></i>
					</div>
				</div>
				<!-- end stats -->

				<!-- stats -->
				<div class="col-12 col-sm-6 col-xl-3">
					<div class="stats">
						<span>Tỉ lệ lấp đầy</span>
						<p style="font-size: 20px;">78%<b class="green">+3.1%</b></p><br>
						<i class="ti ti-eye" style="font-size: 20px;"></i>
					</div>
				</div>
				<!-- end stats -->

				<!-- stats -->
				<div class="col-12 col-sm-6 col-xl-3">
					<div class="stats">
						<span>Reviews this month</span>
						<p>642 <b class="green">+8</b></p>
						<i class="ti ti-star-half-filled"></i>
					</div>
				</div>
				<!-- end stats -->
			</div>

			<div class="row">
				<!-- dashbox -->
				<div class="col-12 col-xl-6">
					<div class="dashbox">
						<div class="dashbox__title">
							<h3><i class="ti ti-trophy"></i>Doanh thu phim</h3>

							<div class="dashbox__wrap">
								<a class="dashbox__refresh" href="#"><i class="ti ti-refresh"></i></a>
								<a class="dashbox__more" href="catalog.html">View All</a>
							</div>
						</div>

						<div class="dashbox__table-wrap dashbox__table-wrap--1">
							<table class="dashbox__table">
								<thead>
									<tr>
										<th>STT</th>
										<th>Tên phim</th>
										<th>Tổng số suất chiếu</th>
										<th>Doanh Thu</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$i = 0;
									foreach ($calculateMovieRevenue as $item) { ?>
										<tr>
											<td>
												<div class="dashbox__table-text dashbox__table-text--grey"><?php echo ++$i ?></div>
											</td>
											<td>
												<div class="dashbox__table-text"><a href="#"><?php echo $item['movie_name'] ?></a></div>
											</td>
											<td>
												<div class="dashbox__table-text"><?php echo $item['total_movie'] ?></div>
											</td>
											<td>
												<div class="dashbox__table-text dashbox__table-text--rate"></i><?php echo number_format($item['total_revenue'], 0, ',', '.')  ?> VNĐ</div>
											</td>
										</tr>
									<?php } ?>

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
							<h3><i class="ti ti-movie"></i>Doanh thu rạp</h3>

							<div class="dashbox__wrap">
								<a class="dashbox__refresh" href="#"><i class="ti ti-refresh"></i></a>
								<a class="dashbox__more" href="catalog.html">View All</a>
							</div>
						</div>

						<div class="dashbox__table-wrap dashbox__table-wrap--2">
							<table class="dashbox__table">
								<thead>
									<tr>
										<th></th>
										<th>ITEM</th>
										<th>CATEGORY</th>
										<th>RATING</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">824</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">I Dream in Another Language</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">TV Series</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 7.2</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">602</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Benched</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Movie</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 6.3</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">538</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Whitney</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">TV Show</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 8.4</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">129</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Blindspotting</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Anime</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 9.0</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">360</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Another</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Movie</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 7.7</div>
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
							<h3><i class="ti ti-users"></i> Latest users</h3>

							<div class="dashbox__wrap">
								<a class="dashbox__refresh" href="#"><i class="ti ti-refresh"></i></a>
								<a class="dashbox__more" href="users.html">View All</a>
							</div>
						</div>

						<div class="dashbox__table-wrap dashbox__table-wrap--3">
							<table class="dashbox__table">
								<thead>
									<tr>
										<th>ID</th>
										<th>FULL NAME</th>
										<th>EMAIL</th>
										<th>USERNAME</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="dashbox__table-text">23</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Brian Cranston</a></div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">bcxwz@email.com</div>
										</td>
										<td>
											<div class="dashbox__table-text">BrianXWZ</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text">22</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Jesse Plemons</a></div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">jess@email.com</div>
										</td>
										<td>
											<div class="dashbox__table-text">Jesse.P</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text">21</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Matt Jones</a></div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">matt@email.com</div>
										</td>
										<td>
											<div class="dashbox__table-text">Matty</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text">20</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Tess Harper</a></div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">harper@email.com</div>
										</td>
										<td>
											<div class="dashbox__table-text">Harper123</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text">19</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Jonathan Banks</a></div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">bank@email.com</div>
										</td>
										<td>
											<div class="dashbox__table-text">Jonathan</div>
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
							<h3><i class="ti ti-star-half-filled"></i> Latest reviews</h3>

							<div class="dashbox__wrap">
								<a class="dashbox__refresh" href="#"><i class="ti ti-refresh"></i></a>
								<a class="dashbox__more" href="reviews.html">View All</a>
							</div>
						</div>

						<div class="dashbox__table-wrap dashbox__table-wrap--4">
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
											<div class="dashbox__table-text dashbox__table-text--grey">824</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">I Dream in Another Language</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Eliza Josceline</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 7.2</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">602</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Benched</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Ketut</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 6.3</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">538</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Whitney</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Brian Cranston</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 8.4</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">129</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Blindspotting</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Quang</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 9.0</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="dashbox__table-text dashbox__table-text--grey">360</div>
										</td>
										<td>
											<div class="dashbox__table-text"><a href="#">Another</a></div>
										</td>
										<td>
											<div class="dashbox__table-text">Jackson Brown</div>
										</td>
										<td>
											<div class="dashbox__table-text dashbox__table-text--rate"><i class="ti ti-star"></i> 7.7</div>
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
	</main>
	<!-- end main content -->