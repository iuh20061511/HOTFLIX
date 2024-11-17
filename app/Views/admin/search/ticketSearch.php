    <!-- page title -->
    <section class="section section--first" style="padding: 10px 0; <?php echo !isset($_GET['search_ticket']) ? 'margin-top: 22px;' : ''; ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <ul class="breadcrumbs">
                            <li class="breadcrumbs__item"><a class="text-white" href="trang-chu.html"><i class="ti ti-home me-1"></i><span>Home</span></a></li>
                            <li class="breadcrumbs__item breadcrumbs__item--active text-pink">Tra cứu lịch sử giao dịch</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<div class="content">
		<!-- profile -->
		<div class="profile">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="profile__content">
							<!-- content tabs nav -->
							<ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
								<li class="nav-item" role="presentation">
                                   <button id="1-tab" data-bs-toggle="tab" class="active" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="false">Tra cứu vé - thuê phòng</button>
								</li>

								<li class="nav-item" role="presentation">
									<button id="2-tab" data-bs-toggle="tab" data-bs-target="#tab-2" type="button" role="tab" aria-controls="tab-2" aria-selected="false">Tra cứu quà tặng</button>
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
				<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
                    <div class="row mt-4">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <form action="#" class="action__search">
                                <input type="text" placeholder="Email hoặc số điện thoại thành viên" name="search_ticket" value="<?php echo !empty($_GET['search_ticket']) ? htmlspecialchars($_GET['search_ticket'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z">
                                        </path>
                                    </svg></button>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($error['search_ticket'])): ?>
                    <div class="row mt-4">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <p class="error text-danger"><?php echo $error['search_ticket']; ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php
                        if(isset($_GET['search_ticket']) && empty($error['search_ticket'])){ ?>
                        <div class="row">
                            <div class="col-12 col-lg-3 order-md-1 order-lg-1" style="margin-top: 40px">
                                <div class="plan plan--active">
                                    <h3 class="plan__title text-pink" style="font-size: 22px;">Thông tin khách hàng</h3>
                                    <ul class="plan__list">
                                        <li><?= mb_strtoupper($infoMember[0]['full_name'], 'UTF-8');?></li>
                                        <li><?= date('d/m/Y', strtotime($infoMember[0]['birthday']))?></li>
                                        <li><?= $infoMember[0]['phone']?></li>
                                        <li><?= $infoMember[0]['email']?></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- active price plan -->
                            <div class="col-12 col-lg-5 order-md-2 order-lg-2">
                                <div class="transaction-list mt-4">
                                        <h3 class="text-white">Lịch sử đặt vé</h3>
                                        <?php 
                                            if(empty($listTicket)){?>
                                            <div class="ticket-item mb-1 d-flex align-items-center">
                                                <div class="row w-100">
                                                    <h5>Lịch sử đặt vé trống</h5>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                        <!-- Các mục giao dịch -->
                                        <?php foreach ($listTicket as $invoiceId => $invoice): ?>
                                            <div type="button" data-bs-toggle="modal" data-bs-target="#plan-modal" class="ticket-item mb-1 d-flex align-items-center" data-invoice='<?php echo json_encode($invoice, JSON_HEX_APOS | JSON_UNESCAPED_UNICODE); ?>' >
                                                <img src="<?php echo _WEB_ROOT; ?>/public/admin/img/movies/<?php echo $invoice['poster']; ?>" alt="Movie Poster" class="ticket-item__poster me-3">
                                                <div class="row w-90">
                                                    <div class="col-md-8 ticket-item__details">
                                                        <h5 class="ticket-item__title"><?php echo mb_strtoupper($invoice['movie_name'], 'UTF-8'); ?></h5>
                                                        <p class="ticket-item__showtime">
                                                            <span><?php echo date('H:i', strtotime($invoice['start_time'])); ?></span>
                                                            - <?php echo $invoice['show_date']; ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 ticket-item__extra">
                                                        <p class="ticket-item__title"><?php echo mb_strtoupper($invoice['cinema_name'], 'UTF-8')?></p>
                                                        <p class="ticket-item__format"><?php echo $invoice['format']; ?></p>
                                                        <span class="ticket-item__details-link">Chi tiết</span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- end active price plan -->
                            <div class="col-12 col-lg-4 order-md-3 order-lg-3">
                                <div class="transaction-list mt-4">
                                    <h3 class="text-white">Lịch sử thuê phòng</h3>
                                    <?php
                                        if(empty($listInvoiceRoom)){?>
                                        <div class="ticket-item mb-1 d-flex align-items-center">
                                            <div class="row w-100">
                                                <h5>Lịch sử thuê phòng trống</h5>
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
                                                    <p class="ticket-item__format"><?php echo $invoiceRoom['start_time'].' - '.$invoiceRoom['end_time'];?> </p>
                                                </div>
                                                <div class="col-md-4 ticket-item__extra">
                                                    <p class="ticket-item__cinema"><?php echo mb_strtoupper($invoiceRoom['room_name'], 'UTF-8')?> </p>
                                                    <span class="ticket-item__details-link">Chi tiết</span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
					    </div>
                    <?php }
                    ?>
				</div>
                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
                    <div class="row mt-4">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <form action="#" class="action__search">
                                <input type="text" placeholder="Email hoặc số điện thoại thành viên" name="search_ticket" value="<?php echo !empty($_GET['search_ticket']) ? htmlspecialchars($_GET['search_ticket'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z">
                                        </path>
                                    </svg></button>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($error['search_ticket'])): ?>
                    <div class="row mt-4">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <p class="error text-danger"><?php echo $error['search_ticket']; ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php
                        if(isset($_GET['search_ticket']) && empty($error['search_ticket'])){ ?>
                        <div class="row">
                            <div class="col-12 col-lg-3 order-md-1 order-lg-1" style="margin-top: 40px">
                                <div class="plan plan--active">
                                    <h3 class="plan__title text-pink" style="font-size: 22px;">Thông tin khách hàng</h3>
                                    <ul class="plan__list">
                                        <li><?= mb_strtoupper($infoMember[0]['full_name'], 'UTF-8');?></li>
                                        <li><?= date('d/m/Y', strtotime($infoMember[0]['birthday']))?></li>
                                        <li><?= $infoMember[0]['phone']?></li>
                                        <li><?= $infoMember[0]['email']?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-lg-9 order-md-2 order-lg-2">
                                <div class="w-100 mt-3">
                                    <h3 class="text-white" style="text-align:center">Danh sách quà</h3>
                                    <div class="table-container-search">
                                        <table class="table text-center scrollable-table-search" style="width: 100%; background-color: white;">
                                            <thead>
                                                <tr class="table-active">
                                                    <th>Hình ảnh</th>
                                                    <th>Tên quà</th>
                                                    <th>Số lượng</th>
                                                    <th>Chi tiết</th>
                                                    <th>Trạng thái</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    // Kiểm tra nếu mảng $listGiftDetails rỗng
                                                    if (empty($listGiftDetails)) {
                                                ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">Danh sách quà trống</td>
                                                    </tr>
                                                <?php
                                                    } else {
                                                        // Nếu mảng có phần tử, thực hiện vòng lặp như bình thường
                                                        // $stt = ($pagination['currentPage'] - 1) * $pagination['itemsPerPage'];
                                                        foreach ($listGiftDetails as $index => $giftDetail) { ?>
                                                            <tr>
                                                                <td class="align-middle">
                                                                    <?php $img = _WEB_ROOT . '/public/admin/img/gift/' . $giftDetail['image']; ?>
                                                                    <div class="catalog__img__wheel">
                                                                        <img src="<?php echo $img; ?>" alt="PosterGift">
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle"><?php echo $giftDetail['gift_name']; ?></td>
                                                                <td class="align-middle">1</td>
                                                                <td class="align-middle">
                                                                <?php 
                                                                    if (!empty($giftDetail['receiveTime'])) {
                                                                        echo date('d-m-Y H:i:s', strtotime($giftDetail['receiveTime'])) . ' - ' . $giftDetail['cinemaLocation'];
                                                                    } else {
                                                                        echo 'Chưa xác định';
                                                                    }
                                                                ?>
                                                                </td>
                                                                <td class="align-middle <?php echo $giftDetail['status'] == 1 ? 'text-success' : 'text-danger'; ?>">
                                                                    <?php echo $giftDetail['status'] == 1 ? 'Đã nhận' : 'Chưa nhận'; ?>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <form method="POST" action="">
                                                                        <!-- Truyền dữ liệu ẩn qua input -->
                                                                        <input type="hidden" name="id_giftDetail" value="<?php echo $giftDetail['id_giftDetails']; ?>">
                                                                        <!-- Nút duyệt nhận quà -->
                                                                        <button type="submit" class="btn btn-primary" name="approve_gift" <?php echo $giftDetail['status'] == 1 ? 'disabled' : ''; ?>> <?php echo $giftDetail['status'] == 1 ? 'Đã nhận' : 'Duyệt nhận quà'; ?></button>
                                                                    </form>
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
                        </div>
                    <?php }
                    ?>
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
                    <a href="" id="printInvoiceLink" target="_blank"><button type="button" class="btn btn-primary w-200">In vé</button></a>
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
                            <h5 id="name_customer"></h5> <!-- Tên phim sẽ được thêm vào đây -->
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
                    <h5 class="modal-title" id="ticketDetailModalLabel">Chi tiết hóa đơn</h5>
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

            document.getElementById('movie_name').textContent = `Phim: ${invoiceData.movie_name.toUpperCase()}`;
            document.getElementById('name_customer').textContent = `Khách hàng: ${invoiceData.name_customer}`;
            document.getElementById('movie_img').innerHTML = `<img src="${movieImageUrl}${invoiceData.poster}" alt="Movie Poster" class="ticket-item__posterModal me-3">`;
            document.getElementById('printInvoiceLink').href = `<?php echo _LINK; ?>/in-ve-${invoiceData.id_invoice}.html`;

            // Cập nhật thông tin hóa đơn chính
            let date = new Date(invoiceData.create_date);

            let formattedDate = `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()} ${date.getHours().toString().padStart(2, '0')}h:${date.getMinutes().toString().padStart(2, '0')}p`;
            document.getElementById('create_date').textContent = `Thời gian: ${formattedDate}`;
            document.getElementById('pay_method').textContent = `Phương thức mua: ${invoiceData.payment_method}`;
            document.getElementById('total_invoice').textContent = `Tổng giá trị hoá đơn: ${formatCurrency(invoiceData.final_total)}`;

            // Cập nhật chi tiết vé
            const ticketDetails = document.getElementById('ticket_details');
            ticketDetails.innerHTML = '';
            invoiceData.tickets.forEach(ticket => {
                    ticketDetails.innerHTML += `
                        <div class="row mb-3 text-center">
                            <div class="col-4 d-flex flex-column justify-content-center align-items-start ps-5">
                                <h6><b>${invoiceData.cinema_name}</b></h6>
                                <h6>Suất chiếu: ${invoiceData.start_time.slice(0, 5)}</h6>
                                <h6>${invoiceData.show_date}</h6>
                            </div>
                            <div class="col-4 d-flex flex-column justify-content-center align-items-start ps-5">
                                <h6>${invoiceData.room_name.toUpperCase()}</h6>
                                <h6>Ghế: <b>${ticket.location}</b></h6>
                                <h6>${invoiceData.format}</h6>
                            </div>
                            <div class="col-4 d-flex flex-column justify-content-center align-items-center ps-4">
                                <h6>Mã vé: ${ticket.id_ticket}</h6>
                                <img src="${qrImageUrl}${ticket.qrcode}" alt="QR" class="ticket-item__posterModal me-3">
                                <h6 class="mt-1">${formatCurrency(ticket.price)}</h6>
                            </div>
                        </div>
                        <hr class="line_br">`;
            });

            // Cập nhật chi tiết item
            const itemDetails = document.getElementById('item_details');
            itemDetails.innerHTML = '';
            invoiceData.items.forEach(item => {
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

    function formatCurrency(amount) {
        // Chuyển đổi số thành chuỗi và thêm dấu phân cách hàng nghìn
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "đ";
    }
    </script>