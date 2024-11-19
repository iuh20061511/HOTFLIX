    <section class="section section--first" style="padding: 10px 0">
		<div class="container">
	        <div class="row">
	            <div class="col-12">
	                <div class="section__wrap">
	                    <ul class="breadcrumbs">
	                        <li class="breadcrumbs__item"><a class="text-white" href="trang-chu.html"><i class="ti ti-home me-1"></i><span>Home</span></a></li>
	                        <li class="breadcrumbs__item breadcrumbs__item--active text-pink">Danh sách quà</li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

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
                                    <a href="thong-tin-tai-khoan.html"><button id="1-tab" type="button" role="tab" aria-controls="tab-1" aria-selected="false">Thông tin cá nhân</button></a>
								</li>

								<li class="nav-item" role="presentation">
									<a href="lich-su-giao-dich.html"><button id="2-tab" type="button" role="tab" aria-controls="tab-2" aria-selected="false">Lịch sử giao dịch</button></a>
								</li>

								<li class="nav-item" role="presentation">
									<button id="3-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab" aria-controls="tab-3" aria-selected="true">Danh sách quà</button>
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
				<div class="tab-pane fade show active" id="tab-3" role="tabpanel" aria-labelledby="3-tab" tabindex="0">
					<div class="row">
						<!-- dashbox -->
						<div class="col-12">
							<div class="dashbox">
								<div class="dashbox__table-wrap dashbox__table-wrap--1">
									<table class="dashbox__table">
										<thead>
											<tr>
                                                <th style="font-size: 14px; font-weight: bold;">STT</th>
                                                <th style="font-size: 14px; font-weight: bold;">Hình ảnh</th>
                                                <th style="font-size: 14px; font-weight: bold;">Tên quà</th>
                                                <th style="font-size: 14px; font-weight: bold;">Số lượng</th>
                                                <th style="font-size: 14px; font-weight: bold;">Chi tiết</th>
                                                <th style="font-size: 14px; font-weight: bold;">Trạng thái</th>
											</tr>
										</thead>
										<tbody>
                                        <?php
                                        if (empty($listGiftDetails)) {
                                            echo '<tr><td colspan="6" class="text-center text-white">Danh sách quà trống</td></tr>';
                                        } else {
											$stt = ($pagination['currentPage'] - 1) * $pagination['itemsPerPage'];
                                            foreach ($listGiftDetails as $gift) { ?>
											<tr style="border-bottom: 1px solid #ff55a5">
												<td>
													<div class="dashbox__table-text"><?php echo ++$stt?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><img src="<?php echo _WEB_ROOT . '/public/admin/img/gift/' . $gift['image']; ?>" alt="Gift" style="width: 80px; height: auto;"></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $gift['gift_name']?></div>
												</td>
                                                <td>
													<div class="dashbox__table-text">1</div>
												</td>
                                                <td>
                                                    <div class="dashbox__table-text"><?php echo !empty($gift['receiveTime']) ? $gift['receiveTime'] . ' - ' . $gift['cinemaLocation'] : 'Chưa xác định'; ?></div>
                                                </td>
												<td>
													<div class="<?php echo $gift['status'] == 1 ? 'text-success' : 'text-danger'; ?>" style="font-weight: bold;"><?php echo $gift['status'] == 1 ? 'Đã nhận' : 'Chưa nhận'; ?></div>
												</td>
											</tr>
                                        <?php } 
                                        }
                                        ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- end dashbox -->
					</div>
					<?php 
						if (!empty($listGiftDetails)) {?>
						<div class="row">
						<!-- paginator -->
						<div class="col-12">
							<div class="section__paginator">
								<!-- amount -->
								<!-- <span class="section__paginator-pages">Showing 12 of 169</span> -->
								<!-- end amount -->

								<ul class="section__paginator-list">
									<li>
										<a href="?page=<?= max(1, $pagination['currentPage'] - 1); ?>">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z"/></svg>
											<span>Prev</span>
										</a>
									</li>
									<li>
										<a href="?page=<?= min($pagination['totalPages'], $pagination['currentPage'] + 1); ?>">
											<span>Next</span>
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z"/></svg>
										</a>
									</li>
								</ul>

								<ul class="paginator">
									<li class="paginator__item paginator__item--prev">
										<a href="?page=<?= max(1, $pagination['currentPage'] - 1); ?>"><i class="ti ti-chevron-left"></i></a>
									</li>
									
									<?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
										<li class="paginator__item <?= $i == $pagination['currentPage'] ? 'paginator__item--active' : ''; ?>">
											<a href="?page=<?= $i; ?>"><?= $i; ?></a>
										</li>
									<?php endfor; ?>
									
									<li class="paginator__item paginator__item--next">
										<a href="?page=<?= min($pagination['totalPages'], $pagination['currentPage'] + 1); ?>"><i class="ti ti-chevron-right"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<!-- end paginator -->
					</div>
					<?php 
					}
					?>

				</div>
			</div>
			<!-- end content tabs -->
		</div>
	</div>
	<!-- end content -->