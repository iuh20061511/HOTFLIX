<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero splide splide--hero">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z" />
                            </svg></button>
                        <button class="splide__arrow splide__arrow--next" type="button"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z" />
                            </svg></button>
                    </div>

                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <a href="details.html" class="hero__link">
                                    <div class="hero__slide"
                                        data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/bg_main.jpg">
                                        <div class="hero__content">
                                            <div class="hero__actions">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="splide__slide">
                                <a href="details.html" class="hero__link">
                                    <div class="hero__slide"
                                        data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/bg_main1.jpg">
                                        <div class="hero__content">
                                            <div class="hero__actions">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="splide__slide">
                                <a href="details.html" class="hero__link">
                                    <div class="hero__slide"
                                        data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/bg_main2.png">
                                        <div class="hero__content">
                                            <div class="hero__actions">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="splide__slide">
                                <a href="details.html" class="hero__link">
                                    <div class="hero__slide"
                                        data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/bg_main3.jpg">
                                        <div class="hero__content">
                                            <div class="hero__actions">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end home -->

<!-- content -->
<section class="content">
    <div class="content__head">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- content title -->
                    <h2 class="content__title">Kho phim</h2>
                    <!-- end content title -->

                    <!-- content tabs nav -->
                    <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                                role="tab" aria-controls="tab-1" aria-selected="true">Phim đang chiếu</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button id="2-tab" data-bs-toggle="tab" data-bs-target="#tab-2" type="button" role="tab"
                                aria-controls="tab-2" aria-selected="false">Phim sắp chiếu</button>
                        </li>

                        <!-- <li class="nav-item" role="presentation">
                            <button id="3-tab" data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab"
                                aria-controls="tab-3" aria-selected="false">Phim sắp chiếu</button>
                        </li> -->

                        <!-- <li class="nav-item" role="presentation">
                            <button id="4-tab" data-bs-toggle="tab" data-bs-target="#tab-4" type="button" role="tab"
                                aria-controls="tab-4" aria-selected="false">Anime</button>
                        </li> -->
                    </ul>
                    <!-- end content tabs nav -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- content tabs -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
                <div class="row ms-5">
                    <!-- item -->
                    <?php
                        $stt = 0;
                        foreach ($listShowing as $index => $movieShowing) { ?>
                        <div class="col-6 col-sm-4 col-lg-3 col-xl-2 mx-3">
                            <div class="item">
                                <div class="item__cover">
                                    <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movieShowing['poster']; ?>" alt="">
                                        <div class="item__play" onclick="location.href='chi-tiet-phim-<?php echo $movieShowing['id_movie']; ?>.html';">
                                            <div class="text-white">Xem chi tiết</div>
                                        </div>
                                        <div class="item__play" onclick="location.href='#';">
                                            <div class="text-white">Mua vé ngay</div>
                                        </div>
                                </div>
                                <div class="item__content">
                                    <h3 class="item__title mb-3"><a href="chi-tiet-phim-<?php echo $movieShowing['id_movie']; ?>.html"><?php echo mb_strtoupper($movieShowing['movie_name'], 'UTF-8'); ?></a></h3>
                                    <h6 style="color: #fff">Thể loại: <span class="text-pink"><?php echo $movieShowing['genre']; ?></span></h6>
                                    <h6 style="color: #fff">Thời lượng: <span class="text-pink"><?php echo $movieShowing['duration']; ?> phút</span></h6>
                                    <span class="item__category">
                                        <!-- <a href="#">Action</a>
                                        <a href="#">Triler</a> -->
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->
                    <?php } ?>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
                <div class="row ms-5">
                    <!-- item -->
                    <?php
                        $stt = 0;
                        foreach ($listComingSoon as $index => $movieComing) { ?>
                        <div class="col-6 col-sm-4 col-lg-3 col-xl-2 mx-3">
                            <div class="item">
                                <a href="chi-tiet-phim-<?php echo $movieComing['id_movie']; ?>.html" class="item__cover">
                                    <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movieComing['poster']; ?>" alt="">
                                        <div class="item__play" onclick="location.href='chi-tiet-phim-<?php echo $movieComing['id_movie']; ?>.html';">
                                            <div class="text-white">Xem chi tiết</div>
                                        </div>
                                </a>
                                <div class="item__content">
                                    <h2 class="item__title mb-3"><a href="chi-tiet-phim-<?php echo $movieComing['id_movie']; ?>.html"><?php echo mb_strtoupper($movieComing['movie_name'], 'UTF-8');?></a></h2>
                                    <h6 style="color: #fff">Thể loại: <span class="text-pink"><?php echo $movieComing['genre']; ?></span></h6>
                                    <h6 style="color: #fff">Thời lượng: <span class="text-pink"><?php echo $movieComing['duration']; ?> phút</span></h6>
                                    <h6 style="color: #fff">Khởi chiếu: <span class="text-pink"><?php echo date('d/m/Y', strtotime($movieComing['release_date']));?></span></h6>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <!-- <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="4-tab" tabindex="0">
                <div class="row">
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="item">
                            <a href="details1.html" class="item__cover">
                                <img src="/public/assets/img/covers/13.png" alt="">
                                <span class="item__play">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z" />
                                    </svg>
                                </span>
                            </a>
                            <div class="item__content">
                                <h3 class="item__title"><a href="details1.html">Starlight Chronicles</a></h3>
                                <span class="item__category">
                                    <a href="#">Romance</a>
                                    <a href="#">Drama</a>
                                    <a href="#">Music</a>
                                </span>
                                <span class="item__rate">6.3</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- end content tabs -->

        <!-- <div class="row">
            <div class="col-12">
                <a href="catalog1.html" class="section__btn"><span>to catalog</span></a>
            </div>
        </div> -->
    </div>
</section>
<!-- end content -->

<!-- now watching -->
<section class="section section--dark">
    <div class="container">
        <div class="row">
            <!-- section title -->
            <div class="col-12">
                <h2 class="section__title section__title--carousel">Xem ngay</h2>
            </div>
            <!-- end section title -->

            <!-- carousel -->
            <div class="col-12">
                <div class="section__carousel splide splide--content">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z" />
                            </svg></button>
                        <button class="splide__arrow splide__arrow--next" type="button"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z" />
                            </svg></button>
                    </div>

                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="item item--carousel">
                                    <a href="details1.html" class="item__cover">
                                        <img src="<?php echo _WEB_ROOT ?>/public/assets/img/covers/7.png" alt="">
                                        <span class="item__play">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div class="item__content">
                                        <h3 class="item__title"><a href="details1.html">I Dream in Another
                                                Language</a></h3>
                                        <span class="item__category">
                                            <a href="#">Action</a>
                                            <a href="#">Triler</a>
                                        </span>
                                        <span class="item__rate">8.4</span>
                                    </div>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="item item--carousel">
                                    <a href="details1.html" class="item__cover">
                                        <img src="<?php echo _WEB_ROOT ?>/public/assets/img/covers/8.png" alt="">
                                        <span class="item__play">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div class="item__content">
                                        <h3 class="item__title"><a href="details1.html">Undercurrents</a></h3>
                                        <span class="item__category">
                                            <a href="#">Comedy</a>
                                        </span>
                                        <span class="item__rate">7.1</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end carousel -->
        </div>
    </div>
</section>