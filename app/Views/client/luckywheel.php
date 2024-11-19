<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/luckywheel/style.css">

<div class="container-fluid" style="margin-top: 70px; margin-bottom: 20px;">
    <div class="row d-flex align-items-center" style="height: 50px; border-bottom: 3px solid #ff55a5;">
        <div class="col-12">
            <div class="section__wrap" style="padding-left:70px">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs__item"><a class="text-white" href="trang-chu.html"><i class="ti ti-home me-1"></i><span>Home</span></a></li>
                    <li class="breadcrumbs__item breadcrumbs__item--active text-pink">Vòng quay may mắn</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row row-wheel"  style=" margin-bottom: 20px; background-image: url('<?php echo _WEB_ROOT ?>/public/luckywheel/bg/bg-wheel3.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="col-12 col-lg-6">
            <div class="plan plan--active" style="background-color:#fff">
                <ul class="plan__list">
                    <h5>Điểm hiện có: <span id="userPoints"><?php echo $user[0]['points']; ?></span></h5>
                </ul>
                <h3 class="plan__title text-pink" style="font-size: 22px;">Luật chơi:</h3>
                <ul class="plan__list">
                    <li style="color: black">Để tham gia vòng quay may mắn, khách hàng cần tích lũy ít nhất 10 điểm (từ việc đặt vé). Mỗi lần quay sẽ tiêu tốn 10 điểm.</li>
                    <li style="color: black">Mỗi khách hàng có thể tham gia nhiều lượt quay tùy vào số điểm tích lũy của mình.</li>
                    <li style="color: black">Giải thưởng không thể đổi thành tiền mặt. Mọi giải thưởng sẽ được nhận tại bất kỳ rạp nào trong hệ thống HOTFLIX của chúng tôi.</li>
                    <li style="color: black">Các giải thưởng sẽ được chọn ngẫu nhiên từ các phần quà có sẵn và không thể chuyển nhượng cho người khác.</li>
                </ul>
                <p class="plan__title" style="color: black; font-size: 15px;"><strong>HOTLINE hỗ trợ: <span style="color: rgb(3,78,162,1)">19001288 (09:00 - 22:00)</span></strong></p>
                <p class="plan__title" style="color: black; font-size: 15px;"><strong>EMAIL hỗ trợ: <span style="color: rgb(3,78,162,1)">hotflix_hotro@gmail.com</span></strong></p>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="container-wheel mt-1">
                <h2 class="lucky-draw">
                    <span>VÒNG</span> <span>QUAY</span> <span>MAY</span> <span>MẮN</span>
                </h2>
                <section class="main-wheel" style="padding-top: 10px">
                <?php if (!empty($listGift) && count($listGift)>=6) { ?>
                    <span class="span-wheel">
                        <ul class="wheel">
                        <?php
                            // Tính toán số phần thưởng và góc xoay
                            $size = count($listGift);
                            $rotate = 360 / $size;  // Số độ cho mỗi phần thưởng
                            $skewY = 90 - $rotate;  // Góc nghiêng để làm phẳng các phần thưởng

                            foreach ($listGift as $index => $gift) {
                                $angle = $rotate * $index;  // Góc xoay của mỗi phần thưởng
                                $textClass = ($index % 2 == 0) ? 'text-wheel-1' : 'text-wheel-2';
                            ?>
                            <li class="item-wheel" style="transform: rotate(<?php echo $angle; ?>deg) skewY(-<?php echo $skewY; ?>deg);">
                                <p class="text-wheel <?php echo $textClass; ?>" style="transform: skewY(<?php echo $skewY; ?>deg) rotate(<?php echo $rotate / 2; ?>deg);">
                                <b data-id-gift="<?php echo $gift['id_gift']?>" data-image-gift="<?php echo _WEB_ROOT . '/public/admin/img/gift/' . htmlspecialchars($gift['image']); ?>" data-percent="<?php echo $gift['percent']?>">
                                    <?php echo htmlspecialchars($gift['gift_name']); ?>
                                </b>
                                </p>
                            </li>
                        <?php } ?>
                        </ul>
                        <!-- Danh sách bóng đèn -->
                        <div class="list-light-bulbs">
                            <?php
                            $numLights = 36; // Số bóng đèn xung quanh vòng tròn
                            for ($i = 0; $i < $numLights; $i++) {
                                $angle = 360 / $numLights * $i; // Góc xoay của mỗi bóng đèn
                            ?>
                                <div class="light-bulb" style="transform: rotate(<?php echo $angle; ?>deg) translateX(calc(var(--size-wheel) / 2 + 10px));"></div>
                            <?php } ?>
                        </div>
                    </span>
                    <div class="wheel__arrow">
                        <button class="wheel__button">QUAY</button>
                    </div>
                <?php } else { ?>
                    <div class="no-wheel-items">
                        <p class="text-center" style="font-size: 22px; font-weight: bold; color: #f8e64b;">
                            Sự kiện đang tạm thời đóng, xin quý vị thông cảm!
                        </p>
                    </div>
                <?php } ?>
                </section>
                <!-- <h1 class="msg-lucky"></h1> -->
            </div>
        </div>
    </div>
    <div class="row row-wheel">
        <div class="col-12 col-lg-8">
            <div style="width: 100%; margin-top: 5px;">
                <h4 class="text-white" style="text-align:center">DANH SÁCH QUÀ</h4>
                <table class="table text-center" style="width: 100%; background-color: white;">
                    <thead>
                        <tr class="table-active">
                            <th>Hình ảnh</th>
                            <th>Tên quà</th>
                            <th>Số lượng</th>
                            <th>Chi tiết</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="giftTableBody">
                        <?php
                        if (empty($listGiftDetails)) {
                            echo '<tr><td colspan="5" class="text-center">Danh sách quà trống</td></tr>';
                        } else {
                            foreach ($listGiftDetails as $giftDetail) { ?>
                                <tr>
                                    <td class="align-middle">
                                        <div class="catalog__img__wheel">
                                            <img src="<?php echo _WEB_ROOT . '/public/admin/img/gift/' . $giftDetail['image']; ?>" alt="Gift">
                                        </div>
                                    </td>
                                    <td class="align-middle"><?php echo $giftDetail['gift_name']; ?></td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">
                                        <?php echo !empty($giftDetail['receiveTime']) ? $giftDetail['receiveTime'] . ' - ' . $giftDetail['cinemaLocation'] : 'Chưa xác định'; ?>
                                    </td>
                                    <td class="align-middle <?php echo $giftDetail['status'] == 1 ? 'text-success' : 'text-danger'; ?>">
                                        <?php echo $giftDetail['status'] == 1 ? 'Đã nhận' : 'Chưa nhận'; ?>
                                    </td>
                                </tr>
                            <?php }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12" style="<?php echo empty($listGiftDetails) ? 'display: none;' : ''; ?>">
            <div class="main__paginator">
                <!-- Số lượng hiển thị -->
                <span class="main__paginator-pages" style="display: none;"><?= $pagination['itemsPerPage']; ?> of <?= $pagination['totalStaff']; ?></span>

                <!-- Điều hướng phân trang -->
                <ul class="main__paginator-list">
                    <!-- Trang trước -->
                    <li>
                        <a href="?page=<?= max(1, $pagination['currentPage'] - 1); ?>">
                            <i class="ti ti-chevron-left"></i>
                            <span>Prev</span>
                        </a>
                    </li>
                    <!-- Trang kế tiếp -->
                    <li>
                        <a href="?page=<?= min($pagination['totalPages'], $pagination['currentPage'] + 1); ?>">
                            <span>Next</span>
                            <i class="ti ti-chevron-right"></i>
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
    </div>

    <!-- Modal Thông báo phần thưởng -->
    <div class="modal fade" id="prizeModal" tabindex="-1" aria-labelledby="prizeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md"> <!-- Kích thước modal có thể là modal-sm, modal-md, modal-lg -->
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-center" id="notify_wheel">Chúc mừng bạn!</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center" id="modal-message"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 catalog__img__modal_wheel">
                                <img src="" alt="" id="image_wheel">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <input type="text" value="" id="id_gift_wheel" name="id_gift_wheel" style="display:none">
                        <input type="text" value="" id="updatePoint" name="updatePoint" style="display:none">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="width: 30%" name="btnSubmitWheel" id="btnSubmitWheel">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let numberPage = '<?php echo isset($_GET['page']) ?(int)($_GET['page']) : 1?>';
    let userPoints = <?php echo $user[0]['points']; ?>;
    const minPointsRequired = 10;
    let srcImageFail = `<?php echo _WEB_ROOT; ?>/public/admin/img/gift/matbuon.jpg`;
    const urlSever = '<?php echo _LINK; ?>/client/luckywheel/spin';
    const urlGift ='<?php echo _WEB_ROOT; ?>/public/admin/img/gift/';
</script>
<script src="<?php echo _WEB_ROOT ?>/public/luckywheel/main.js"></script>