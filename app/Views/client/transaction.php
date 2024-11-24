    <!-- page title -->
    <section class="section section--first" style="padding: 10px 0; <?php echo !empty($invoices) ? 'margin-top: 65px;' : ''; ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <ul class="breadcrumbs">
                            <li class="breadcrumbs__item"><a class="text-white" href="trang-chu.html"><i class="ti ti-home me-1"></i><span>Home</span></a></li>
                            <li class="breadcrumbs__item breadcrumbs__item--active text-pink">Lịch sử giao dịch</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <section class="content" style="top: 0;">
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
                                    <h3><?php echo $user[0]['full_name'] ?></h3>
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
                                    <a href="danh-sach-qua.html"><button id="3-tab" type="button" role="tab" aria-controls="tab-3" aria-selected="false">Danh sách quà</button></a>
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
                        <!-- Lịch sử vé -->
                        <div class="col-12 col-lg-6 order-md-1 order-lg-1">
                            <h3 class="text-white mt-4">Lịch sử vé</h3>
                            <div class="transaction-list mt-2">
                                <?php
                                if (empty($invoices)) { ?>
                                    <div class="ticket-item mb-1 d-flex align-items-center">
                                        <div class="row w-100">
                                            <h5>Lịch sử vé trống</h5>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                <!-- Các mục giao dịch -->
                                <?php foreach ($invoices as $invoiceId => $invoice): ?>
                                    <div class="ticket-item mb-1 d-flex align-items-center">
                                        <img src="<?php echo _WEB_ROOT; ?>/public/admin/img/movies/<?php echo $invoice['poster']; ?>" alt="Movie Poster" class="ticket-item__poster me-3">
                                        <div class="row w-100">
                                            <div class="col-md-8 ticket-item__details">
                                                <h5 class="ticket-item__title"><?php echo $invoice['movie_name']; ?></h5>
                                                <p class="ticket-item__showtime">
                                                    <span class="time"><?php echo date('H:i', strtotime($invoice['start_time'])); ?></span>
                                                    - <?php echo $invoice['show_date']; ?>
                                                </p>
                                                <?php
                                                $showDateTime = $invoice['show_date_default'] . ' ' . $invoice['start_time'];
                                                if ($showDateTime >= date("Y-m-d H:i:s")): ?>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#give-ticket" class="btn btn-primary w-200 mb-2">Tặng vé</button>
                                                <?php endif; ?>

                                                <?php
                                                if ($_SESSION['is_login']['id_rank'] == 4) { ?>
                                                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#<?php echo $invoice['id_invoice'] ?>"> Đổi vé </button>
                                                <?php } ?>
                                                <div class="modal fade" id="<?php echo $invoice['id_invoice'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h5 class="text-center text-danger"><b>Các suất chiếu có thể đổi</b></h5>
                                                                <h6 class="text-center text-success mb-4"><b>Phim: <?php echo $invoice['movie_name']; ?></b></h6>

                                                                <?php
                                                                $quantity_ticket_double = 0;
                                                                $quantity_ticket_normal = 0;
                                                                $quantity_ticket_vip = 0;


                                                                foreach ($invoice['tickets'] as $ticket) {
                                                                    if ($invoice['id_roomType'] == 2) {

                                                                        if (preg_match('/^[F-K](?:[1-9]|1[0-2])$/', $ticket['location'])) {
                                                                            $quantity_ticket_vip++;
                                                                        } elseif (preg_match('/^Z/', $ticket['location'])) {
                                                                            $quantity_ticket_double++;
                                                                        } else {
                                                                            $quantity_ticket_normal++;
                                                                        }
                                                                    } elseif ($invoice['id_roomType'] == 3) {

                                                                        if (preg_match('/^[F-K](?:[3-9]|1[0-8])$/', $ticket['location'])) {
                                                                            $quantity_ticket_vip++;
                                                                        } elseif (preg_match('/^Z/', $ticket['location'])) {
                                                                            $quantity_ticket_double++;
                                                                        } else {
                                                                            $quantity_ticket_normal++;
                                                                        }
                                                                    } elseif ($invoice['id_roomType'] == 4) {


                                                                        if (preg_match('/^[F-L](?:[3-9]|1[0-9]|2[0-2])$/', $ticket['location'])) {
                                                                            $quantity_ticket_vip++;
                                                                        } elseif (preg_match('/^Z/', $ticket['location'])) {
                                                                            $quantity_ticket_double++;
                                                                        } else {
                                                                            $quantity_ticket_normal++;
                                                                        }
                                                                    } else {
                                                                        $quantity_ticket_vip++;
                                                                    }
                                                                }
                                                                $currentDate = null;

                                                                foreach ($this->getShowtimeList($invoice['id_movie'], $invoice['id_showTime'], $invoice['double_seat_price'], $invoice['single_seat_price'], $invoice['vip_seat_price']) as $show) {
                                                                    $showDate = date('d/m/Y', strtotime($show['show_date']));
                                                                    if ($currentDate !== $showDate) {
                                                                        if ($currentDate !== null) { ?>
                                                            </div>
                                                        <?php }
                                                                        $currentDate = $showDate; ?>

                                                        <h6 class="text-center text-primary mt-3"><b>Ngày: <?php echo $currentDate; ?></b></h6>
                                                        <div class="row mt-3">
                                                        <?php }

                                                                    $time = date('H:i', strtotime($show['start_time'])); ?>


                                                        <div class="col-md-3 mb-3">
                                                            <div class="card shadow-sm">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title text-warning"><?php echo rtrim((new DateTime("$time"))->modify('+30 minutes')->format('H:i')); ?></h5>
                                                                    <p class="card-text text-muted"><?php echo $show['cinema_name']; ?></p>
                                                                    <p class="card-text text-danger" style="font-size: 12px;"><b><?php echo $show['seat']; ?></b> ghế đã bán</p>
                                                                    <?php
                                                                    ?>

                                                                    <form action="doi-suat-chieu.html" method="post">
                                                                        <input type="hidden" name="id_showTime_old" value="<?php echo $invoice['id_showTime'] ?>">
                                                                        <input type="hidden" name="id_showTime" value="<?php echo $show['id_showTime'] ?>">
                                                                        <input type="hidden" name="id_invoice" value="<?php echo $invoice['id_invoice'] ?>">
                                                                        <input type="hidden" name="tn" value="<?php echo $quantity_ticket_normal ?>">
                                                                        <input type="hidden" name="tv" value="<?php echo $quantity_ticket_vip ?>">
                                                                        <input type="hidden" name="tdb" value="<?php echo $quantity_ticket_double  ?>">
                                                                        <input type="submit" value="Đổi vé" class="btn btn-outline-warning w-100" name="sub_change">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }
                                                                if ($currentDate !== null) { ?>
                                                        </div>
                                                    <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4 ticket-item__extra">
                                            <p class="ticket-item__cinema"><?php echo $invoice['cinema_name']; ?></p>
                                            <p class="ticket-item__format"><?php echo $invoice['format']; ?></p>
                                            <div type="button" data-bs-toggle="modal" data-bs-target="#plan-modal" class="ticket-item__details-link" data-invoice='<?php echo json_encode($invoice, JSON_HEX_APOS | JSON_UNESCAPED_UNICODE); ?>'>Xem chi tiết</div>
                                        </div>
                                    </div>
                            </div>
                            <!-- Modal give ticket-->
                            <div class="modal fade" id="give-ticket" tabindex="-1" aria-labelledby="plan-modal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center text-pink ps-4">Tặng vé thành viên!</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column justify-content-center align-items-center" id="ticketDetailContent">
                                            <!-- Phần hiển thị thông tin hóa đơn chính -->
                                            <form method='post' style="width:90%">
                                                <label for="email_sdt" class="d-flex justify-content-start mt-1">Nhập email hoặc số điện thoại thành viên được nhận:</label>
                                                <input type="text" class="form-control border border-primary rounded mb-3" placeholder="Email hoặc số điện thoại" id="email_sdt" name="email_sdt" value="<?php echo isset($_POST['email_sdt']) ? $_POST['email_sdt'] : ''; ?>">
                                                <?php if (isset($error['email_sdt'])): ?>
                                                    <div class="row mt-4">
                                                        <div class="col-12 d-flex align-items-center justify-content-center">
                                                            <p class="error text-danger"><?php echo $error['email_sdt']; ?></p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <input type="text" value="<?php echo $invoice['id_invoice'] ?>" name="id_giveInvoice" style="display:none">
                                                <div class="text-center">
                                                    <input type="submit" value="Xác nhận tặng" class="btn btn-primary text-center w-200" name="giveTicket">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal give ticket-->
                        <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Lịch sử phòng riêng -->
                    <div class="col-12 col-lg-6 order-md-2 order-lg-2">
                        <h3 class="text-white mt-4">Lịch sử vé phòng riêng tư</h3>
                        <div class="transaction-list mt-2">
                            <?php
                            if (empty($getListTicketPrivate)) { ?>
                                <div class="ticket-item mb-1 d-flex align-items-center">
                                    <div class="row w-100">
                                        <h5>Lịch sử trống</h5>
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <!-- Các mục giao dịch -->
                            <?php foreach ($getListTicketPrivate as $invoiceId => $private): ?>
                                <a href="hoa-don-phong-rieng-<?php echo $private['id_InvoiceRoomPrivate'] ?>.html"  class="ticket-item mb-1 d-flex align-items-center" target="_blank">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/admin/img/movies/<?php echo $private['poster']; ?>" alt="Movie Poster" class="ticket-item__poster me-3">
                                    <div class="row w-100">
                                        <div class="col-md-8 ticket-item__details">
                                            <h5 class="ticket-item__title"><?php echo $private['movie_name']; ?></h5>
                                            <p class="ticket-item__showtime">
                                                <span class="time"><?php echo date('H:i', strtotime($private['time'])); ?></span>
                                                - <?php echo $private['show_date']; ?>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-md-4 ticket-item__extra">
                                        <p class="ticket-item__cinema"><?php echo $private['cinema_name']; ?></p>
                                        <p class="ticket-item__format"></p>
                                        <div type="button" class="ticket-item__details-link">Xem chi tiết</div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                     <!-- Lịch sử phòng thuê -->
                     <!-- <div class="row"> -->
                        <div class="ol-12 col-lg-6 order-md-3 order-lg-3">
                            <h3 class="text-white mt-4">Lịch sử thuê phòng</h3>
                            <div class="transaction-list mt-2">
                                <?php
                                if (empty($listInvoiceRoom)) { ?>
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
                                                <h5 class="ticket-item__title"><?php echo mb_strtoupper($invoiceRoom['cinema_name'], 'UTF-8') ?></h5>
                                                <p class="ticket-item__showtime">
                                                    <span class="time"><?php echo $invoiceRoom['date_rent'] ?></span>
                                                </p>
                                            </div>
                                            <div class="col-md-4 ticket-item__extra">
                                                <p class="ticket-item__cinema"><?php echo mb_strtoupper($invoiceRoom['room_name'], 'UTF-8') ?> </p>
                                                <p class="ticket-item__format"><?php echo $invoiceRoom['start_time'] . ' - ' . $invoiceRoom['end_time']; ?> </p>
                                                <span class="ticket-item__details-link">Chi tiết</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- end content -->
    <!-- Modal -->
    <div class="modal fade" id="plan-modal" tabindex="-1" aria-labelledby="plan-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="" id="printInvoiceLink" target="_blank"><button type="button" class="btn btn-primary w-200">In vé</button></a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center" id="ticketDetailContent">
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
                    <h5 class="modal-title" id="ticketDetailModalLabel">Chi tiết hóa đơn</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Popup hiện poster -->
    <div class="popup-qrcode" id="popupQrcode">
        <span class="close-popup">&times;</span>
        <img src="" alt="Movie Poster" class="popup-qrcode-image" id="popupQrcodeImage">
    </div>
    <!-- Popup hiện poster -->
     <?php 
        // echo '<pre>';
        // print_r($getListTicketPrivate);
     ?>

    <script>
        document.querySelectorAll('.ticket-item__details-link').forEach(item => {
            item.addEventListener('click', function() {
                const invoiceData = JSON.parse(this.getAttribute('data-invoice'));
                //Các đường dẫn ảnh:
                const movieImageUrl = `<?php echo _WEB_ROOT; ?>/public/admin/img/movies/`;
                const qrImageUrl = `<?php echo _WEB_ROOT; ?>/public/QR/image/`;
                const itemImageUrl = `<?php echo _WEB_ROOT; ?>/public/admin/img/menu_items/`;

                document.getElementById('movie_name').textContent = `Phim: ${invoiceData.movie_name.toUpperCase()}`;
                // document.getElementById('name_customer').textContent = `Khách hàng: ${invoiceData.name_customer}`;
                document.getElementById('movie_img').innerHTML = `<img src="${movieImageUrl}${invoiceData.poster}" alt="Movie Poster" class="ticket-item__posterModal me-3">`;
                document.getElementById('printInvoiceLink').href = `<?php echo _LINK; ?>/in-ve-${invoiceData.id_invoice}.html`;
                // Cập nhật thông tin hóa đơn chính
                let date = new Date(invoiceData.create_date);

                let formattedDate = `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
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
                            <img src="${qrImageUrl}${ticket.qrcode}" alt="QR" class="ticket-item__posterModal view-qrcode me-3" data-qrcode="${qrImageUrl}${ticket.qrcode}">
                            <h6>${formatCurrency(ticket.price)}</h6>
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

                // <-------------Poster Event Binding Inside Ticket Click -------------->
                const popupQrcode = document.getElementById('popupQrcode');
                const popupQrcodeImage = document.getElementById('popupQrcodeImage');
                const closePosterPopupBtn = document.querySelector('.close-popup');

                document.querySelectorAll('.view-qrcode').forEach(link => {
                    link.addEventListener('click', function(event) {
                        const posterUrl = link.getAttribute('data-qrcode');
                        popupQrcodeImage.src = posterUrl;
                        popupQrcode.style.display = 'flex';
                    });
                });

                closePosterPopupBtn.addEventListener('click', function() {
                    popupQrcode.style.display = 'none';
                    popupQrcodeImage.src = '';
                });

                popupQrcode.addEventListener('click', function(e) {
                    if (e.target === popupQrcode) {
                        popupQrcode.style.display = 'none';
                        popupQrcodeImage.src = '';
                    }
                });
                // <-------------Poster Event Binding End -------------->
            });
        });

        function formatCurrency(amount) {
            // Chuyển đổi số thành chuỗi và thêm dấu phân cách hàng nghìn
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "đ";
        }
    </script>

    <?php if (!empty($error)): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('give-ticket'));
                myModal.show();
            });
        </script>
    <?php endif; ?>