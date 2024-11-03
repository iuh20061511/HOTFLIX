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
                                    <a href="thong-tin-tai-khoan.html"><button id="1-tab" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Thông tin cá nhân</button></a>
								</li>

								<li class="nav-item" role="presentation">
                                   <button id="2-tab" data-bs-toggle="tab" class="active" data-bs-target="#tab-2" type="button" role="tab" aria-controls="tab-2" aria-selected="false">Lịch sử giao dịch</button>
								</li>

								<li class="nav-item" role="presentation">
									<button id="3-tab" data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab" aria-controls="tab-3" aria-selected="false">Settings</button>
								</li>
							</ul>
							<!-- end content tabs nav -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end profile -->

		<div class="container mb-5">
			<!-- content tabs -->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
					<div class="row">
						<!-- active price plan -->
						<div class="col-12 col-md-6 col-lg-6 order-md-2 order-lg-1">
                            <div class="transaction-list mt-4">
                                    <h3 class="text-white">Danh sách đặt vé xem phim</h3>
                                    <?php 
                                        if(empty($invoices)){?>
                                        <div class="ticket-item mb-1 d-flex align-items-center">
                                            <div class="row w-100">
                                                <h5>Danh sách đặt vé của bạn trống</h5>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                    <!-- Các mục giao dịch -->
                                    <?php foreach ($invoices as $invoiceId => $invoice): ?>
                                        <div type="button" data-bs-toggle="modal" data-bs-target="#plan-modal" class="ticket-item mb-1 d-flex align-items-center" data-invoice='<?php echo json_encode($invoice, JSON_HEX_APOS | JSON_UNESCAPED_UNICODE); ?>' >
                                            <img src="<?php echo _WEB_ROOT; ?>/public/admin/img/movies/<?php echo $invoice['tickets'][0][0]['poster']; ?>" alt="Movie Poster" class="ticket-item__poster me-3">
                                            <div class="row w-100">
                                                <div class="col-md-8 ticket-item__details">
                                                    <h5 class="ticket-item__title"><?php echo $invoice['tickets'][0][0]['movie_name']; ?></h5>
                                                    <p class="ticket-item__showtime">
                                                        <span class="time"><?php echo date('H:i', strtotime($invoice['tickets'][0][0]['start_time'])); ?></span>
                                                        - <?php echo $invoice['tickets'][0][0]['show_date']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-4 ticket-item__extra">
                                                    <p class="ticket-item__cinema"><?php echo $invoice['tickets'][0][0]['cinema_name']; ?></p>
                                                    <p class="ticket-item__format"><?php echo $invoice['tickets'][0][0]['projection_format']; ?></p>
                                                    <span class="ticket-item__details-link">Chi tiết</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
						<!-- end active price plan -->
                        <div class="col-12 col-lg-6 order-md-1 order-lg-2">
                            <div class="transaction-list mt-4">
                                <h3 class="text-white">Danh sách đặt vé thuê phòng</h3>
                                <?php
                                    if(empty($listInvoiceRoom)){?>
                                    <div class="ticket-item mb-1 d-flex align-items-center">
                                        <div class="row w-100">
                                            <h5>Danh sách thuê phòng của bạn trống</h5>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                <!-- Các mục giao dịch -->
                                <?php foreach ($listInvoiceRoom as $invoiceRoom): ?>
                                    <a href="hoa-don-dat-phong-<?php echo $invoiceRoom['id_invoiceRoom'] ?>.html" class="ticket-item mb-1 d-flex align-items-center" target="_blank">
                                        <img src="<?php echo _WEB_ROOT; ?>/public/assets/img/rent_room.png" alt="Movie Poster" class="ticket-item__poster me-3">
                                        <div class="row w-100">
                                            <div class="col-md-8 ticket-item__details">
                                                <h5 class="ticket-item__title"><?php echo mb_strtoupper($invoiceRoom['cinema_name'], 'UTF-8')?></h5>
                                                <p class="ticket-item__showtime">
                                                    <span class="time"><?php echo $invoiceRoom['date_rent']?></span>
                                                </p>
                                            </div>
                                            <div class="col-md-4 ticket-item__extra">
                                                <p class="ticket-item__cinema"><?php echo mb_strtoupper($invoiceRoom['room_name'], 'UTF-8')?> </p>
                                                <p class="ticket-item__format"><?php echo $invoiceRoom['start_time'].' - '.$invoiceRoom['end_time'];?> </p>
                                                <span class="ticket-item__details-link">Chi tiết</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
					</div>
				</div>
            </div>
		</div>
	</div>
	<!-- end content -->
    <!-- Modal -->
    <div class="modal fade" id="plan-modal" tabindex="-1" aria-labelledby="plan-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketDetailModalLabel">Chi tiết hóa đơn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center" id="ticketDetailContent" >
                <!-- Phần hiển thị thông tin hóa đơn chính -->
                    <div class="row text-center">
                        <div class="col-4 d-flex justify-content-center align-items-center" id="movie_img">
                            <!-- JavaScript sẽ tự động chèn hình ảnh poster tại đây -->
                        </div>
                        <div class="col-8 d-flex flex-column justify-content-center align-items-start">
                            <h5 id="movie_name" class="fw-bold"></h5> <!-- Tên phim sẽ được thêm vào đây -->
                            <h5 id="create_date"></h5> <!-- Thời gian đặt vé sẽ được thêm vào đây -->
                            <h5 id="pay_method"></h5> <!-- Phương thức mua sẽ được thêm vào đây -->
                        </div>
                    </div>
                    <br>
                    <!-- Phần hiển thị chi tiết từng vé -->
                    <div id="ticket_details">
                        <!-- JavaScript sẽ tự động thêm nội dung vé vào đây -->
                    </div>
                    <br>

                    <!-- Phần hiển thị chi tiết từng item -->
                    <div id="item_details">
                        <!-- JavaScript sẽ tự động thêm nội dung item vào đây -->
                    </div>
                    <div class="container-fluid mt-3">
                        <div class="row me-5">
                            <div class="col-12 ms-auto text-end me-5">
                                <h5 id="total_invoice" class="text-danger"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary w-50">In vé</button>
                </div>
            </div>
        </div>
    </div>

<script>
document.querySelectorAll('.ticket-item').forEach(item => {
    item.addEventListener('click', function() {
        const invoiceData = JSON.parse(this.getAttribute('data-invoice'));
        //Các đường dẫn ảnh:
        const movieImageUrl = `<?php echo _WEB_ROOT; ?>/public/admin/img/movies/`;
        const qrImageUrl = `<?php echo _WEB_ROOT; ?>/public/QR/image/`;
        const itemImageUrl=`<?php echo _WEB_ROOT; ?>/public/admin/img/menu_items/`;
        // Lấy tên phim và poster từ phần tử đầu tiên trong mảng tickets
        const firstTicket = invoiceData.tickets[0][0]; // Lấy ticket đầu tiên trong mảng
        document.getElementById('movie_name').textContent = firstTicket.movie_name.toUpperCase();
        document.getElementById('movie_img').innerHTML = `<img src="${movieImageUrl}${firstTicket.poster}" alt="Movie Poster" class="ticket-item__posterModal me-3">`;

        // Cập nhật thông tin hóa đơn chính
        // document.getElementById('create_date').textContent = `Thời gian đặt vé: ${invoiceData.create_date}`;
        let date = new Date(invoiceData.create_date);

        let formattedDate = `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
        document.getElementById('create_date').textContent = `Thời gian: ${formattedDate}`;
        document.getElementById('pay_method').textContent = `Phương thức mua: ${invoiceData.payment_method}`;
        document.getElementById('total_invoice').textContent = `Tổng giá trị hoá đơn: ${formatCurrency(invoiceData.final_total)}`;

        // Cập nhật chi tiết vé
        const ticketDetails = document.getElementById('ticket_details');
        ticketDetails.innerHTML = '';
        invoiceData.tickets.forEach(ticketArray => {
            ticketArray.forEach(ticket => {
                ticketDetails.innerHTML += `
                    <div class="row mb-3 text-center">
                        <div class="col-4 d-flex flex-column justify-content-center align-items-start">
                            <h6><b>${ticket.cinema_name}</b></h6>
                            <h6>Suất chiếu: ${ticket.start_time}</h6>
                            <h6>${ticket.show_date}</h6>
                        </div>
                        <div class="col-4 d-flex flex-column justify-content-center align-items-start">
                            <h6>${ticket.room_name}</h6>
                            <h6>Ghế: <b>${ticket.location}</b></h6>
                            <h6>${ticket.projection_format}</h6>
                        </div>
                        <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                            <h6>Mã vé: ${ticket.id_ticket}</h6>
                            <img src="${qrImageUrl}${ticket.qrcode}" alt="QR" class="ticket-item__posterModal me-3">
                        </div>
                    </div>
                    <hr class="line_br">`;
            });
        });

        // Cập nhật chi tiết item
        const itemDetails = document.getElementById('item_details');
        itemDetails.innerHTML = '';
        invoiceData.items.forEach(itemArray => {
            itemArray.forEach(item => {
                itemDetails.innerHTML += `
                    <div class="row mb-3">
                        <div class="col-4 text-center">
                            <img src="${itemImageUrl}${item.image}" alt="Image item" class="ticket-item__posterModal me-3">
                        </div>
                        <div class="col-4 ps-5">
                            <h6>${item.item_name}</h6> x${item.quantity}
                        </div>
                        <div class="col-4 text-center">
                            <h6>${formatCurrency(item.price)}</h6>
                        </div>
                    </div>`;
            });
        });
    });
});

function formatCurrency(amount) {
    // Chuyển đổi số thành chuỗi và thêm dấu phân cách hàng nghìn
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "đ";
}
</script>