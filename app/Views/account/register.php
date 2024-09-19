<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/splide.min.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/slimselect.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/plyr.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/photoswipe.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/default-skin.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/main.css">

<!-- Favicons -->
<link rel="icon" type="image/png" href="<?php echo _WEB_ROOT ?>/public/assets/icon/logo_edited_v2.svg" sizes="32x32">
<link rel="apple-touch-icon" href="<?php echo _WEB_ROOT ?>/public/assets/icon/logo_edited_v2.svg">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
<meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
<meta name="keywords" content="">
<meta name="author" content="Dmitry Volkov">
<title>Đăng ký</title>
</head>

<body>
    <div class="sign section--bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/account.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <form action="" class="sign__form" method="POST">
                            <a href="index.html" class="sign__logo">
                                <img src="<?php echo _WEB_ROOT ?>/public/assets/img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" name="name" placeholder="Họ tên">
                                <?php if (isset($error['name'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['name']; ?></b></p>
                                <?php } ?>
                            </div>

                            <div class="sign__group">
                                <input type="text" class="sign__input" name="email" placeholder="Email">
                                <?php if (isset($error['email'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['email']; ?></b></p>
                                <?php } ?>
                            </div>

                            <div class="sign__group">
                                <input type="date" class="sign__input" name="birthday">
                                <?php if (isset($error['birthday'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['birthday']; ?></b></p>
                                <?php } ?>
                            </div>

                            <div class="sign__group">
                                <input type="text" class="sign__input" name="phone" placeholder="Số điện thoại">
                                <?php if (isset($error['phone'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['phone']; ?></b></p>
                                <?php } ?>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label class="form-check-label text-light me-5">Giới tính:</label>
                                <div class="me-5">
                                    <input type="radio" name="gender" value="Nam" class="form-check-input" id="male">
                                    <label class="form-check-label text-light" for="male">Nam</label>

                                </div>
                                <div>
                                    <input type="radio" name="gender" value="Nữ" class="form-check-input" id="female">
                                    <label class="form-check-label text-light" for="female">Nữ</label>

                                </div>
                            </div>
                            <p class="text-danger error" style="margin-left:-90px ;"><b><?php
                            if (!empty($error['gender'])) {
                                echo $error['gender'];
                            } ?></b></p>

                            <div class="sign__group">
                                <input type="password" class="sign__input" name="password" placeholder="Mật khẩu">
                                <?php if (isset($error['password'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['password']; ?></b></p>
                                <?php } ?>
                            </div>
                            <div class="sign__group">
                                <input type="password" class="sign__input" name="confirm_password"
                                    placeholder="Nhập lại mật khẩu">
                                <?php if (isset($error['confirm_password'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['confirm_password']; ?></b></p>
                                <?php } ?>
                            </div>


                            <input type="submit" name="btn_register" value="Đăng ký" class="btn btn-danger sign__group">



                            <span class="sign__text">Bạn đã có tài khoản ? <a
                                    href="<?php echo _LINK ?>/dang-nhap.html">Đăng nhập</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/splide.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/slimselect.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/smooth-scrollbar.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/plyr.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/photoswipe.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/photoswipe-ui-default.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/js/main.js"></script>
</body>


</html>