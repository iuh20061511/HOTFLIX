<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/splide.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/slimselect.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/plyr.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/photoswipe.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/default-skin.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/main.css">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?php echo _WEB_ROOT ?>/public/assets/icon/logo_edited_v2.svg"
        sizes="32x32">
    <link rel="apple-touch-icon" href="<?php echo _WEB_ROOT ?>/public/assets/icon/logo_edited_v2.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>HOTFLIX</title>
</head>

<body>
    <div class="sign section--bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/account.jpg">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="" class="sign__form" method="POST">
                            <a href="index.html" class="sign__logo">
                                <img src="<?php echo _WEB_ROOT ?>/public/assets/img/logo.svg" alt="">

                            </a>

                            <div class="sign__group">
                                <input type="text" name="email" class="sign__input" placeholder="Email">
                            </div>

                            <div class="sign__group">
                                <input type="password" name="password" class="sign__input" placeholder="Password">

                            </div>
                            <?php if (isset($error['dangnhap'])): ?>
                                    <p class="error text-danger"><?php echo $error['dangnhap']; ?></p>
                            <?php endif; ?>
                            <?php if (isset($error['empty'])): ?>
                                    <p class="error text-danger"><?php echo $error['empty']; ?></p>
                            <?php endif; ?>

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox">
                                <label for="remember">Remember Me</label>
                            </div>

                            <button class="sign__btn" name="btn_signin" type="submit">Đăng nhập</button>

                            <span class="sign__delimiter">or</span>



                            <span class="sign__text">Bạn chưa có tài khoản?
                                <a
                                    href="<?php echo _LINK ?>/dang-ki.html">Đăng ký ngay!
                                </a></span>

                            <span class="sign__text">
                                <a href="<?php echo _LINK ?>/quen-mat-khau.html">Quên mật khẩu?</a>
                            </span>
                        </form>
                        <!-- end authorization form -->
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