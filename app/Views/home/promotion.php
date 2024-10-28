	<!-- page title -->
	<section class="section section--first section--bg" data-bg="<?php echo _WEB_ROOT ?>/public/assets/img/bg/section_bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title section__title--head">ƯU ĐÃI - KHUYẾN MÃI</h1>
						<!-- end section title -->

						<!-- breadcrumbs -->
						<ul class="breadcrumbs">
							<li class="breadcrumbs__item"><a href="trang-chu.html">Home</a></li>
							<li class="breadcrumbs__item breadcrumbs__item--active">Khuyến mãi</li>
						</ul>
						<!-- end breadcrumbs -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- about -->
        <section class="section">
            <div class="container">
                <?php foreach ($listPromotion as $index => $promotion) { ?>
                    <div class="row mb-4 col-10 mx-auto d-flex align-items-center" style="border: 2px solid #ff55a5; border-radius: 5px;">
                        <!-- Hình ảnh -->
                        <div class="col-4">
                            <img src="<?= _WEB_ROOT ?>/public/admin/img/promotion/<?= $promotion['image']; ?>" alt="" class="img-fluid" style="max-width: 100%; height: 200px; object-fit: cover;">
                        </div>
                        <!-- Nội dung -->
                        <div class="col-8">
                            <h3 class="text-pink"><?= $promotion['promotion_name']; ?> (<span style="font-size:20px"><?= date('d/m/Y', strtotime($promotion['date_start'])) ?> - <?= date('d/m/Y', strtotime($promotion['date_end'])) ?></span>)</h3>
                            <h6 class="text-pink">Chi tiết ưu đãi:</h6>
                            <p class="section__text"> Nhập mã <b><?= $promotion['promotion_code']; ?></b> để được áp dụng! </p>
                            <p class="section__text" style="text-align: justify;" id="description-<?= $promotion['id_promotion']; ?>">
                                <?= $promotion['description']; ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Duyệt qua tất cả các phần tử có mô tả
        const descriptions = document.querySelectorAll(".section__text");

        descriptions.forEach(function(descriptionElement) {
            // Lấy nội dung text của phần tử
            let text = descriptionElement.innerText;

            // Tách văn bản theo dấu chấm
            let sentences = text.split('.');

            // Xử lý từng câu
            let formattedText = sentences
                .map(sentence => sentence.trim())
                .filter(sentence => sentence.length > 0) // Lọc ra những câu rỗng
                .map(sentence => `- ${sentence}.<br>`) // Thêm "-" đầu mỗi câu
                .join(''); // Nối lại thành chuỗi

            // Cập nhật nội dung đã định dạng vào phần tử
            descriptionElement.innerHTML = formattedText;
        });
    });
</script>
