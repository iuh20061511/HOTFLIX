<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/forgot.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 15:29:17 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/splide.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/slimselect.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/plyr.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/photoswipe.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/default-skin.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/main.css">

    <!-- Icon font -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/webfont/tabler-icons.min.css">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?php echo _WEB_ROOT ?>/public/assets/icon/logo_edited_v2.svg"
        sizes="32x32">
    <link rel="apple-touch-icon" href="<?php echo _WEB_ROOT ?>/public/assets/icon/logo_edited_v2.svg">

    <meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>HotFlix – Online Movies, TV Shows & Cinema HTML Template</title>
</head>

<body>
    <div class="sign section--bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/account.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">

                        <form action="" class="sign__form" method="POST">
                            <a href="index.html" class="sign__logo">
                                <img src="<?php echo _WEB_ROOT ?>/public/assets/img/logo_edited_v2.svg" alt="">

                            </a>
                            <?php if (!empty($result['success'])) { ?>
                                <h6 class="alert alert-success text-center" role="alert"><?php echo $result['success']; ?>
                                </h6>
                            <?php } ?>
                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Email" name="email">
                            </div>
                            <?php if (isset($error['email'])) { ?>
                                <p class="error text-danger m-1"><b><?php echo $error['email']; ?></b></p>
                            <?php } ?>
                            <input type="submit" value="Xác nhận" name="submit" class="btn btn-danger sign__group">

                            <span class="sign__text">Chúng tôi sẽ gửi đến Email của bạn</span>
                        </form>
                        <!-- end forgot form -->
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