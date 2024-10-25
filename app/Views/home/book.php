<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/client/book/css/book.css">

<form action="pay.html" method="POST">
    <section class="content" style="margin-top: 150px;">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 shadow-lg p-3 mb-5 bg-body rounded action">
                    <h2 class="mb-4">Chọn Combo</h2>
                    <?php
                    $i = 0;
                    foreach ($items as $item) { ?>
                        <input type="hidden" name="item[<?php echo $i ?>][id_item] ?>" value="<?php echo $item['id_item']  ?>">
                        <input type="hidden" name="item[<?php echo $i ?>][name_item]  ?>" value="<?php echo $item['item_name']  ?>">
                        <div class="combo-item d-flex align-items-center" data-price="<?php echo $item['price']  ?>"
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
                        <div class="timer mb-3 text-center shadow-sm p-3 bg-body rounded">Thời gian giữ ghế: <span id="countdown"></span>
                        </div>

                        <table>
                            <th> <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/<?php echo $image ?>"
                                    class="card-img-top movie-poster" alt="Ma Da">
                                <input type="hidden" name="image" value="<?php echo $image ?>">
                            </th>
                            <th>
                                <div class="m-3">
                                    <h5 class="card-title"><?php echo $movie_name ?><span
                                            class="age-rating">T16</span></h5>
                                    <input type="hidden" name="movie_name" value="<?php echo  $movie_name  ?>">
                                    <p class="card-text"><?php echo $projection_format ?></p>
                                    <input type="hidden" name="projection_format" value="<?php echo $projection_format ?>">
                                </div>

                        </table>


                        <div class="card-body">

                            <p><?php echo $cinema ?></p>
                            <input type="hidden" name="cinema" value="<?php echo $cinema ?>">
                            <p>Suất: <?php echo $time ?></p>
                            <input type="hidden" name="time" value="<?php echo $time ?>">
                            <hr>
                            <p>1x Người Lớn - Member</p>
                            <p>Ghế: <?php echo $seats ?></p>
                            <input type="hidden" name="seats" value="<?php echo $seats ?>">


                            <hr>
                            <div id="selected-combos">
                            </div>


                            <hr>
                            <p class="d-flex justify-content-between" id="total-price-display">
                                <strong>Tổng cộng</strong>
                                <span class="text-danger" id="total-price"><?php echo $total ?> VNĐ</span>
                            </p>
                            <input type="hidden" id="total-input" name="total" value="<?php echo $total ?>" />
                            <div class="d-flex justify-content-between">
                                <input type="hidden" name="id_showtime" value="<?php echo $id_showtime ?>">
                                <input type="hidden" name="id_movie" value="<?php echo $id_movie ?>">
                                <input type="hidden" name="id_room" value="<?php echo $id_room ?>">


                                <input type="submit" class="btn btn-primary continue" value="Tiếp tục">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<?php

?>
<script>
    var total = "<?php echo str_replace('.', '', $total); ?>";
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
<script src="<?php echo _WEB_ROOT ?>/public/client/book/js/time.js"></script>