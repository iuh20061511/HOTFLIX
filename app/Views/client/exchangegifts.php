<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/luckywheel/style.css">

<div class="container-fluid" style="margin-top: 70px; margin-bottom: 20px;">
    <div class="row d-flex align-items-center" style="height: 50px; border-bottom: 3px solid #ff55a5;">
        <div class="col-12">
            <div class="section__wrap" style="padding-left:70px">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs__item"><a class="text-white" href="trang-chu.html"><i class="ti ti-home me-1"></i><span>Home</span></a></li>
                    <li class="breadcrumbs__item breadcrumbs__item--active text-pink">Đổi quà</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row row-wheel"  style=" margin-bottom: 20px; background-image: url(''); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="col-12 col-lg-4 ms-2">
            <div class="plan plan--active" style="background-color:#fff;">
                <h3 class="plan__title text-pink" style="font-size: 22px;">Hướng dẫn:</h3>
                <ul class="plan__list">
                    <li style="color: black">Để tham gia chương trình, khách hàng cần tích lũy đủ số điểm tương ứng với các phần quà muốn đổi.</li>
                    <li style="color: black">Mỗi khách hàng có thể đổi không giới hạn tùy vào số điểm tích lũy của mình.</li>
                    <li style="color: black">Phần quà nhận được sẽ không thể đổi thành tiền mặt. Mọi phần quà sẽ được nhận tại bất kỳ rạp nào trong hệ thống HOTFLIX của chúng tôi.</li>
                    <li style="color: black">Lưu ý: Các phần quà sẽ không thể chuyển nhượng cho người khác.</li>
                </ul>
                <p class="plan__title" style="color: black; font-size: 15px;"><strong>HOTLINE hỗ trợ: <span style="color: rgb(3,78,162,1)">19001288 (09:00 - 22:00)</span></strong></p>
                <p class="plan__title" style="color: black; font-size: 15px;"><strong>EMAIL hỗ trợ: <span style="color: rgb(3,78,162,1)">hotflix_hotro@gmail.com</span></strong></p>
            </div>
        </div>
        <div class="col-12 col-lg-7">
            <div class="plan_exchange plan--active mt-4" style="background-color:#fff;min-height: 500px; border-radius: 5px">
                <div class="container py-4">
                    <div class="text-center mb-4">
                        <h3 class="title-exchange text-pink">SHOP ĐỔI ĐIỂM</h3>
                        <p>Sử dụng điểm tích lũy để đổi về các phần quà cực xịn sò.</p>
                        <div class="badge bg-success fs-5">Điểm hiện có: <?php echo $user[0]['points']?></div>
                    </div>
                    <div class="row g-3">
                        <?php
                            foreach ($listGift as $gift) {
                                $bg = 'shop-item3.png';
                                if ($gift['point'] >= 1000) {
                                     $bg ='shop-item.png';
                                }
                                $isEligible = $user[0]['points'] >= $gift['point'];
                        ?>
                        <div class="col-6 col-md-3">
                            <div class="card h-100 gift-card" style="background-image: url('<?php echo _WEB_ROOT . '/public/admin/img/gift/'.$bg ?>');">
                                <div class="card-body">
                                    <img src="<?php echo _WEB_ROOT . '/public/admin/img/gift/'.$gift['image'] ?>" class="card-img-top mx-auto d-block" alt="Item 1">
                                    <p class="card-text fw-bold mt-2 mb-0"><?php echo $gift['point']?></p>
                                    <button type="button" class="btn btn-primary mx-auto btn-exchange" 
                                        <?php echo $isEligible ? 'data-bs-toggle="modal" data-bs-target="#exchange-'.$gift['id_gift'].'"' : 'data-bs-toggle="modal" data-bs-target="#insufficient-points-modal"' ?>>
                                        Đổi ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Thông báo phần thưởng -->
                        <div class="modal fade" id="exchange-<?php echo $gift['id_gift']?>" tabindex="-1" aria-labelledby="exchange-<?php echo $gift['id_gift']?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md"> <!-- Kích thước modal có thể là modal-sm, modal-md, modal-lg -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6 class="text-center" id="notify_wheel">Bạn chắc chắn muốn đổi <span style="font-weight:700"><?php echo $gift['point']?> điểm</span> </h6>
                                                    <h6 class="text-center" id="notify_wheel">để lấy phần quà <span style="font-weight:700">"<?php echo $gift['gift_name']?>"</span> chứ?</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <img src="<?php echo _WEB_ROOT . '/public/admin/img/gift/'.$gift['image'] ?>" alt="" style="display: inline-block; width: 100%; max-width: 160px; height: auto; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mb-3">
                                            <input type="hidden" value="<?php echo $gift['point']?>" name="point_giftExchanged">
                                            <input type="hidden" value="<?php echo $gift['id_gift']?>" name="id_giftExchanged">
                                            <button type="submit" class="btn btn-primary me-4" style="width: 20%" data-bs-dismiss="modal" name="btnSubmitExchange">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 20%">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Thông báo không đủ điểm -->
                        <div class="modal fade" id="insufficient-points-modal" tabindex="-1" aria-labelledby="insufficient-points-modal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="insufficient-points-modal">Thông báo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <div class="col-12 catalog__img__modal_wheel">
                                            <img src="<?php echo _WEB_ROOT; ?>/public/luckywheel/bg/iconbuon.jpg" alt="">
                                        </div>
                                        <p>Rất tiếc, bạn không đủ điểm để đổi phần quà này.</p>
                                        <p>Hãy tích lũy thêm điểm để đổi quà nhé.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>