<section class="section section--details">
    <!-- details background -->
        <div class="section__details-bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/account.jpg"></div>
        <!-- end details background -->

        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="section__title section__title--head"><?php echo mb_strtoupper($movieDetail[0]['movie_name'], 'UTF-8');?></h1>
                </div>
                <!-- end title -->

                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="item item--details">
                        <!-- card cover -->
                        <div class="item__cover">
                            <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movieDetail[0]['poster']; ?>" alt="">
                        </div>
                        <!-- end card cover -->

                        <!-- card content -->
                        <div class="item__content">
                            <div class="item__wrap">
                                <span class="item__rate">8.4</span>

                                <ul class="item__list">
                                    <li>Full HD</li>
                                    <li>18+</li>
                                </ul>
                            </div>

                            <ul class="item__meta">
                                <li><span>Thể loại:</span> <span class="text-pink"><?php echo $movieDetail[0]['genre']; ?></span></li>
                                <li><span>Thời lượng:</span> <span class="text-pink"><?php echo $movieDetail[0]['duration']; ?> phút</span></li>
                                <li><span>Quốc gia:</span> <span class="text-pink"><?php echo $movieDetail[0]['nation']; ?></span></li>
                                <li><span>Ngày khởi chiếu:</span> <span class="text-pink"><?php echo date('d/m/Y', strtotime($movieDetail[0]['release_date']));?> </span></li>
                            </ul>

                            <ul class="item__meta item__meta--second">
                                <li><span>Đạo diễn:</span> <span class="text-pink"><?php echo $movieDetail[0]['director']; ?></span></li>
                                <li><span>Diễn viên:</span> <span class="text-pink"><?php echo $movieDetail[0]['actor']; ?></span></li>
                            </ul>
                        </div>

                        <div class="item__description item__description--details">
                            <p></p>
                        </div>
                        <!-- end card content -->
                    </div>
                </div>
                <!-- end content -->

                <!-- player -->
                <div class="col-12 col-xl-6">
                    <iframe width="100%" height="400" src="<?php echo $movieDetail[0]['trailer']; ?>"
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <!-- end player -->

                <div class="col-12">
                    <p class="text-white text-justify"><?php echo $movieDetail[0]['description']; ?></p>
                </div>
            </div>
        </div>
        <!-- end details content -->
    </section>
    <!-- end details -->

    <!-- content -->
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Khám phá</h2>
                        <!-- end content title -->

                        <!-- content tabs nav -->
                        <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Lịch chiếu</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="2-tab" data-bs-toggle="tab" data-bs-target="#tab-2" type="button" role="tab" aria-controls="tab-2" aria-selected="false">Reviews</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="3-tab" data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab" aria-controls="tab-3" aria-selected="false">Photos</button>
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
                                    
                                </div>
                                <!-- end comments -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
                            <div class="row">
                                <!-- reviews -->
                                <div class="col-12">
                                    <div class="reviews">
                                        <ul class="reviews__list">
                                            <li class="reviews__item">
                                                <div class="reviews__autor">
                                                    <img class="reviews__avatar" src="img/user.svg" alt="">
                                                    <span class="reviews__name">Best Marvel movie in my opinion</span>
                                                    <span class="reviews__time">24.08.2023, by Tess Harper</span>

                                                    <span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z"></path></svg>8.0</span>
                                                </div>
                                                <p class="reviews__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                                            </li>

                                            <li class="reviews__item">
                                                <div class="reviews__autor">
                                                    <img class="reviews__avatar" src="img/user.svg" alt="">
                                                    <span class="reviews__name">Greate movie</span>
                                                    <span class="reviews__time">24.08.2023, by Gene Graham</span>

                                                    <span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z"></path></svg>9.0</span>
                                                </div>
                                                <p class="reviews__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                                            </li>

                                            <li class="reviews__item">
                                                <div class="reviews__autor">
                                                    <img class="reviews__avatar" src="img/user.svg" alt="">
                                                    <span class="reviews__name">It could be better</span>
                                                    <span class="reviews__time">24.08.2023, by Rosa Lee</span>

                                                    <span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z"></path></svg>7.0</span>
                                                </div>
                                                <p class="reviews__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                                            </li>
                                        </ul>

                                        <form action="#" class="sign__form sign__form--comments">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="sign__group">
                                                        <input type="text" class="sign__input" placeholder="Title">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="sign__group">
                                                        <select class="sign__select" name="rating" id="rating">
                                                            <option value="0">Rating</option>
                                                            <option value="1">1 star</option>
                                                            <option value="2">2 stars</option>
                                                            <option value="3">3 stars</option>
                                                            <option value="4">4 stars</option>
                                                            <option value="5">5 stars</option>
                                                            <option value="6">6 stars</option>
                                                            <option value="7">7 stars</option>
                                                            <option value="8">8 stars</option>
                                                            <option value="9">9 stars</option>
                                                            <option value="10">10 stars</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="sign__group">
                                                        <textarea class="sign__textarea" placeholder="Write a review"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button type="button" class="sign__btn sign__btn--small"><span>Send</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end reviews -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab" tabindex="0">
                            <!-- project gallery -->
                            <div class="gallery" itemscope>
                                <div class="row row--grid">
                                    <!-- gallery item -->
                                    <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                        <a href="img/gallery/project-1.jpg" itemprop="contentUrl" data-size="1920x1280">
                                            <img src="img/gallery/project-1.jpg" itemprop="thumbnail" alt="Image description" />
                                        </a>
                                        <figcaption itemprop="caption description">Some image caption 1</figcaption>
                                    </figure>
                                    <!-- end gallery item -->

                                    <!-- gallery item -->
                                    <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                        <a href="img/gallery/project-2.jpg" itemprop="contentUrl" data-size="1920x1280">
                                            <img src="img/gallery/project-2.jpg" itemprop="thumbnail" alt="Image description" />
                                        </a>
                                        <figcaption itemprop="caption description">Some image caption 2</figcaption>
                                    </figure>
                                    <!-- end gallery item -->

                                    <!-- gallery item -->
                                    <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                        <a href="img/gallery/project-3.jpg" itemprop="contentUrl" data-size="1920x1280">
                                            <img src="img/gallery/project-3.jpg" itemprop="thumbnail" alt="Image description" />
                                        </a>
                                        <figcaption itemprop="caption description">Some image caption 3</figcaption>
                                    </figure>
                                    <!-- end gallery item -->

                                    <!-- gallery item -->
                                    <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                        <a href="img/gallery/project-4.jpg" itemprop="contentUrl" data-size="1920x1280">
                                            <img src="img/gallery/project-4.jpg" itemprop="thumbnail" alt="Image description" />
                                        </a>
                                        <figcaption itemprop="caption description">Some image caption 4</figcaption>
                                    </figure>
                                    <!-- end gallery item -->

                                    <!-- gallery item -->
                                    <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                        <a href="img/gallery/project-5.jpg" itemprop="contentUrl" data-size="1920x1280">
                                            <img src="img/gallery/project-5.jpg" itemprop="thumbnail" alt="Image description" />
                                        </a>
                                        <figcaption itemprop="caption description">Some image caption 5</figcaption>
                                    </figure>
                                    <!-- end gallery item -->

                                    <!-- gallery item -->
                                    <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                        <a href="img/gallery/project-6.jpg" itemprop="contentUrl" data-size="1920x1280">
                                            <img src="img/gallery/project-6.jpg" itemprop="thumbnail" alt="Image description" />
                                        </a>
                                        <figcaption itemprop="caption description">Some image caption 6</figcaption>
                                    </figure>
                                    <!-- end gallery item -->
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
                            <h2 class="section__title section__title--sidebar">Có thể bạn thích</h2>
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