	<!-- page title -->
	<section class="section section--first section--bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/section_bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title section__title--head"><?php echo $cinema[0]['cinema_name']?></h1>
						<!-- end section title -->

						<!-- breadcrumbs -->
						<ul class="breadcrumbs">
							<li class="breadcrumbs__item"><a href="trang-chu.html">Home</a></li>
							<li class="breadcrumbs__item breadcrumbs__item--active"><?php echo $cinema[0]['cinema_name']?></li>
						</ul>
						<!-- end breadcrumbs -->
					</div>
                    <div class="row">
						<!-- section title -->
                        <h6 class="section__title" style="font-size:15px">Hotline: <?php echo $cinema[0]['contact']?></h6>
                        <h6 class="section__title" style="font-size:15px">Địa chỉ: <?php echo $cinema[0]['address']?></h6>
						<!-- end section title -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- about -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <!-- section title -->
                    <div class="col-12">
                        <h2 class="section__title text-pink"><?php echo $cinema[0]['cinema_name']?></h2>

                        <p class="section__text" style="text-align: justify;">Chào mừng bạn đến với <b><?php echo $cinema[0]['cinema_name']?></b>. <?php echo $cinema[0]['description']?></p>
                    </div>
                    <!-- end section title -->

                    <!-- feature -->
                    <div class="gallery" itemscope>
                        <div class="row row--grid">
                        <?php
                            foreach ($listCinemaImage as $index => $cinemaImage) { ?>
                            <!-- gallery item 1 -->
                            <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                <a href="<?php echo _WEB_ROOT ?>/public/assets/img/cinema/<?php echo $cinema[0]['id_cinema'].'/'.$cinemaImage ?>" itemprop="contentUrl" data-size="1920x1280">
                                    <img src="<?php echo _WEB_ROOT ?>/public/assets/img/cinema/<?php echo $cinema[0]['id_cinema'].'/'.$cinemaImage ?>" itemprop="thumbnail" alt="Image description" class="img-fluid"/>
                                </a>
                                <figcaption itemprop="caption description">Cinema 1 description</figcaption>
                            </figure>
                            <!-- end gallery item -->
                        <?php } ?>
                        </div>
                    </div>
                    <!-- end feature -->
                </div>
            </div>
        </section>
        <!-- end about -->

        <section class="section section--dark">
            <div class="container">
                <div class="row">
                    <!-- section title -->
                    <div class="col-12">
                        <h2 class="section__title section__title--carousel text-pink">PHIM ĐANG HOT</h2>
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
                                <?php
                                    foreach ($listMovie as $index => $movie) { ?>
                                    <li class="splide__slide">
                                        <div class="item item--carousel">
                                            <a href="details1.html" class="item__cover">
                                                <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movie['poster']; ?>" alt="">
                                                <div class="item__play" onclick="location.href='chi-tiet-phim-<?php echo $movie['id_movie']; ?>.html';">
                                                    <div class="text-white">Xem chi tiết</div>
                                                </div>
                                            </a>
                                            <div class="item__content">
                                                <h3 class="item__title"><a href="chi-tiet-phim-<?php echo $movie['id_movie']; ?>.html"><?php echo $movie['movie_name']?></a></h3>
                                                <h6 ><span class="text-pink"><?php echo $movie['genre']; ?></span></h6>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end carousel -->
                </div>
            </div>
        </section>

    <!-- content -->
	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content tabs nav -->
						<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Bản đồ</button>
							</li>

							<li class="nav-item" role="presentation">
								<button id="2-tab" data-bs-toggle="tab" data-bs-target="#tab-2" type="button" role="tab" aria-controls="tab-2" aria-selected="false">Hình ảnh</button>
							</li>
						</ul>
						<!-- end content tabs nav -->
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-8">
					<!-- content tabs -->
					<div class="tab-content">
						<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
							<div class="row">
								<!-- comments -->
								<div class="col-12">
                                    <div class="row">
                                        <!-- section title -->
                                        <h6 class="section__title mb-0" style="font-size:15px">Hotline: <?php echo $cinema[0]['contact']?></h6>
                                        <h6 class="section__title mb-0" style="font-size:15px">Địa chỉ: <?php echo $cinema[0]['address']?></h6>
                                        <!-- end section title -->
                                    </div>
                                    <div class="row" style="width: 90%">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.7936279368546!2d106.62571177451686!3d10.750382459674638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752c2ab06fc7b7%3A0x50a4eefae0a2deca!2zR2FsYXh5IEtpbmggRMawxqFuZyBWxrDGoW5n!5e0!3m2!1svi!2s!4v1729239968257!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
								</div>
								<!-- end comments -->
							</div>
						</div>

						<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
							<!-- project gallery -->
							<div class="gallery" itemscope>
								<div class="row row--grid">
									<!-- gallery item -->
                                    <?php
                                    foreach ($listCinemaImage as $index => $cinemaImage) { ?>
									<figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
										<a href="<?php echo _WEB_ROOT ?>/public/assets/img/cinema/<?php echo $cinema[0]['id_cinema'].'/'.$cinemaImage ?>" itemprop="contentUrl" data-size="1920x1280">
											<img src="<?php echo _WEB_ROOT ?>/public/assets/img/cinema/<?php echo $cinema[0]['id_cinema'].'/'.$cinemaImage ?>" itemprop="thumbnail" alt="Image description" />
										</a>
										<figcaption itemprop="caption description">Some image caption 6</figcaption>
									</figure>
									<!-- end gallery item -->
                                    <?php } ?>
								</div>
							</div>
							<!-- end project gallery -->
						</div>
					</div>
					<!-- end content tabs -->
				</div>

				<!-- sidebar -->
                <div class="col-12 col-lg-4">
                    <div class="row">
                        <!-- section title -->
                        <div class="col-12">
                            <h2 class="section__title section__title--sidebar text-pink">Có thể bạn thích</h2>
                        </div>
                        <!-- end section title -->

                        <!-- item -->
                        <?php
                        $stt = 0;
                        foreach ($listShowing as $index => $movieShowing) { ?>
                        <div class="col-6 col-sm-4 col-lg-6">
                            <div class="item">
                                <a href="details1.html" class="item__cover">
                                    <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movieShowing['poster']; ?>" alt="">
                                    <div class="item__play" onclick="location.href='chi-tiet-phim-<?php echo $movieShowing['id_movie']; ?>.html';">
                                        <div class="text-white">Xem chi tiết</div>
                                    </div>
                                    <div class="item__play" onclick="location.href='#';">
                                        <div class="text-white">Mua vé ngay</div>
                                    </div>
                                </a>
                                <div class="item__content">
                                    <h3 class="item__title"><a href="chi-tiet-phim-<?php echo $movieShowing['id_movie']; ?>.html"><?php echo $movieShowing['movie_name']; ?></a></h3>
                                    <span class="item__category">
                                        <span class="text-pink"><?php echo $movieShowing['genre']; ?></span>
                                    </span>
                                    <span class="item__rate">8.4</span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- end item -->
                    </div>
                </div>
				<!-- end sidebar -->
			</div>
		</div>
	</section>
	<!-- end content -->

	<!-- Root element of PhotoSwipe. Must have class pswp. -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

		<!-- Background of PhotoSwipe. 
		It's a separate element, as animating opacity is faster than rgba(). -->
		<div class="pswp__bg"></div>

		<!-- Slides wrapper with overflow:hidden. -->
		<div class="pswp__scroll-wrap">

			<!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
			<!-- don't modify these 3 pswp__item elements, data is added later on. -->
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>

			<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
			<div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

					<!--  Controls are self-explanatory. Order can be changed. -->

					<div class="pswp__counter"></div>

					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

					<!-- Preloader -->
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>

				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>

				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>

				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>
			</div>
		</div>
	</div>
    <?php 
        print_r($listCinemaImage);
    ?>