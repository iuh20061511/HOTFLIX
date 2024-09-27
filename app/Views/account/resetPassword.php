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
    <?php
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrf_token = $_SESSION['csrf_token'];
    ?>
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
                            <input type="hidden" name="token" value="<?php if (isset($_GET['token'])) {
                                echo $_GET['token'];
                            } ?>">

                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                            <div class="sign__group">
                                <input type="password" name="password" class="sign__input" placeholder="Nhập mật khẩu">
                                <?php if (isset($error['password'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['password']; ?></b></p>
                                <?php } ?>
                            </div>

                            <div class="sign__group">
                                <input type="password" name="confirmPassword" class="sign__input"
                                    placeholder="Nhập lại mật khẩu">
                                <?php if (isset($error['confirmPassword'])) { ?>
                                    <p class="error text-danger m-1"><b><?php echo $error['confirmPassword']; ?></b></p>
                                <?php } ?>
                            </div>

                            <input type="submit" name="submit" value="Xác nhận" class="btn btn-danger sign__group">
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