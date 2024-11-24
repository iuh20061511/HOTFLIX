<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/rooms/css/roomAgv.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/rooms/css/roomPrivate.css">

<section class="content">
    <div class="content__head">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="content__title">Discover</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9 seat_move" style="margin-top: 40px;">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab"
                        tabindex="0">
                        <div class="col-12 p-0">
                            <div class="main">
                                <span class="control prev">
                                    <i class="bx bx-chevron-left">
                                    </i>
                                </span>
                                <span class="control next">
                                    <i class="bx bx-chevron-right"></i>
                                </span>
                                <div class="img-wrap ">
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/rooms/image/roomvip1.jpg" alt=""
                                        class="imgprivate " />
                                </div>
                            </div>
                            <div class="list-img">
                                <div>
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/rooms/image/roomvip2.jpg" alt=""
                                        class="imgprivate imgprivatesub" />
                                </div>
                                <div>
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/rooms/image/roomvip3.jpg" alt=""
                                        class="imgprivate imgprivatesub" />
                                </div>
                                <div>
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/rooms/image/roomvip4.jpg" alt=""
                                        class="imgprivate imgprivatesub" />
                                </div>
                                <div>
                                    <img src="<?php echo _WEB_ROOT ?>/public/client/rooms/image/roomvip1.jpg" alt=""
                                        class="imgprivate imgprivatesub" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-3 bg-light">
                <div class="row">

                    <div class="col-12 col-sm-8 col-lg-12 ">
                        <div class="item ">
                            <form action="" method="post" class="p-4 bg-white rounded-3 shadow border">
                                <div class="mb-4">
                                    <label for="movieSelect" class="form-label fw-semibold text-primary">Chọn Phim:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="bi bi-film text-primary"></i>
                                        </span>
                                        <select name="movieSelect" id="movieSelect" class="form-select border-0 shadow bg-body rounded">
                                            <option disabled selected>Chọn một bộ phim...</option>
                                            <?php foreach ($movies as $movie) {
                                                if ($movie['id_movie'] != 0) {
                                                    $selected = (isset($_POST['movieSelect']) && $_POST['movieSelect'] == $movie['id_movie']) ? 'selected' : '';
                                            ?>
                                                    <option value="<?php echo $movie['id_movie']; ?>" <?php echo $selected; ?>>
                                                        <?php echo htmlspecialchars($movie['movie_name']); ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">Xác Nhận</button>
                            </form>


                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-lg-12 mt-2 d-flex justify-content-center">
                        <?php if (isset($_POST['movieSelect'])) { ?>
                            <div class="card shadow-lg border-0 rounded-4" style="max-width: 700px; width: 100%; background-color: #f8f9fa;">
                                <div class="row g-0 p-2">
                                    <div class="col-md-4">
                                        <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $info_movie[0]['poster'] ?>"
                                            class="img-fluid rounded-start" alt="<?php echo $info_movie[0]['movie_name']; ?>"
                                            style="object-fit: cover; height: 100%; max-height: 300px; border-radius: 10px;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h6 class="card-title text-danger fw-bold fs-5">Phim: <?php echo $info_movie[0]['movie_name'] ?></h6>

                                            <p class="card-text mb-1"><strong class="text-muted">Diễn viên:</strong> <span><?php echo $info_movie[0]['actor'] ?></span></p>
                                            <p class="card-text mb-1"><strong class="text-muted">Loại phim:</strong> <span><?php echo $info_movie[0]['genre'] ?></span></p>
                                            <p class="card-text mb-1"><strong class="text-muted">Quốc gia:</strong> <span><?php echo $info_movie[0]['nation'] ?></span></p>
                                            <p class="card-text mb-1"><strong class="text-muted">Đạo diễn:</strong> <span><?php echo $info_movie[0]['director'] ?></span></p>
                                            <p class="card-text mb-1"><strong class="text-muted">Thời lượng:</strong> <span><?php echo $info_movie[0]['duration'] ?> phút</span></p>
                                        </div>

                                    </div>
                                    <a href="chi-tiet-phim-<?php echo $_POST['movieSelect'] ?>.html" class="text-center">Chi tiết</a>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <?php if (isset($_POST['movieSelect'])) { ?>
                        <div class="col-12 col-sm-8">
                            <form action="chon-thuc-an-phong-nhom.html" method="post">
                                <input type="hidden" name="id_room" value="<?php echo $id_room ?>">
                                <input type="hidden" name="movieSelect" value="<?php echo $_POST['movieSelect'] ?>">
                                <input type="hidden" name="date" value="<?php echo $_GET['date'] ?>">
                                <input type="hidden" name="time" value="<?php echo $_GET['time'] ?>">

                                <input type="submit" value="Tiếp tục" class="m-3 btn btn-success">
                            </form>

                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>

    </div>
</section>


<script src="<?php echo _WEB_ROOT ?>/public/client/rooms/js/roomPrivate.js">
</script>