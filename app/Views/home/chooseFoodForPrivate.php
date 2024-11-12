<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/book/css/book.css">

<form action="thanh-toan-phong-nhom.html" method="POST">
    <section class="content" style="margin-top: 150px;">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 shadow-lg p-3  mb-5 bg-body rounded action">
                    <h2 class="mb-4">Chọn Combo</h2>
                    <?php
                    $i = 0;
                    foreach ($items as $item) { ?>
                        <input type="hidden" name="item[<?php echo $i ?>][id_item] ?>" value="<?php echo $item['id_item']  ?>">
                        <input type="hidden" name="item[<?php echo $i ?>][name_item]  ?>" value="<?php echo $item['item_name']  ?>">
                        <div class="combo-item d-flex align-items-center " data-price="<?php echo $item['price']  ?>"
                            data-name="<?php echo $item['item_name'] ?>">
                            <img src="<?php echo _WEB_ROOT ?>/public/admin/img/menu_items/<?php echo $item['image'] ?>" alt="<?php echo $item['item_name'] ?>"
                                class="combo-image me-3">
                            <div class="flex-grow-1">
                                <h5><?php echo $item['item_name'] ?></h5>
                                <p class="mb-0"><?php echo $item['description'] ?></p>
                                <p class="mb-0"><strong>Giá: <?php echo number_format($item['price'], 0, '', '.'); ?> đ</strong></p>
                            </div>
                            <div class="quantity">
                                <button type="button" class="btn btn-outline-secondary btn-sm decrease">-</button>
                                <input type="number" class="mx-2 quantity-value text-center" name="item[<?php echo $i ?>][quantity]" value="0" min="0" readonly style="width: 30px; background: none; border: none;">
                                <button type="button" class="btn btn-outline-secondary btn-sm increase">+</button>
                            </div>



                        </div>
                    <?php $i++;
                    } ?>

                </div>
                <div class="col-md-4">

                    <div class="card ">
                        <div class="timer mb-3 text-center shadow-sm p-3 bg-body rounded">Thời gian giữ phòng: <span id="countdown"></span>
                        </div>

                        <table>
                            <th>
                                <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $movie[0]['poster'] ?>"
                                    class="card-img-top movie-poster m-1" style="width: 50%; ">
                                <input type="hidden" name="image" value="<?php echo  $movie[0]['poster'] ?>">
                                <h5 class="card-title text-start" style="width: 45%; float: right;">Phim: <?php echo $movie[0]['movie_name'] ?></h5>
                                <input type="hidden" name="movie_name" value="<?php echo  $movie[0]['movie_name']  ?>">
                            </th>
                        </table>


                        <div class="card-body">

                            <hr>
                            <div id="selected-combos">
                            </div>

                            <p class="d-flex justify-content-between" id="total-price-display">
                                <strong>Tổng cộng</strong>
                                <span class="text-danger" id="total-price"><?php echo '2.000.000' ?> đ</span>

                            </p>
                            <input type="hidden" id="total-input" name="total" value="2000000" />
                            <div class="d-flex justify-content-between">
                                <input type="hidden" name="date" value="<?php echo $_POST['date'] ?>">
                                <input type="hidden" name="time" value="<?php echo $_POST['time'] ?>">
                                <input type="hidden" name="id_movie" value="<?php echo $_POST['movieSelect']  ?>">
                                <input type="hidden" name="id_room" value="<?php echo $_POST['id_room'] ?>">
                                <input type="submit" class="btn btn-primary continue" value="Tiếp tục">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</form>



<script>
    var total = 2000000;
</script>

<script src="<?php echo _WEB_ROOT ?>/public/client/book/js/book.js"></script>


<script>
    function updateInputValue() {
        const totalPriceText = document.getElementById('total-price').textContent;
        const totalValue = totalPriceText.replace(' VNĐ', '').trim();
        document.getElementById('total-input').value = totalValue;
    }
    const targetNode = document.getElementById('total-price');
    const config = {
        childList: true,
        characterData: true,
        subtree: true
    };

    const callback = function(mutationsList) {
        for (const mutation of mutationsList) {
            if (mutation.type === 'childList' || mutation.type === 'characterData') {
                updateInputValue();
            }
        }
    };

    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);

    window.onload = function() {
        updateInputValue();
    }
</script>
<script>
    var time = 360
</script>
<script src="<?php echo _WEB_ROOT ?>/public/client/book/js/time.js"></script>