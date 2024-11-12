<?php
if (isset($_SESSION['hold_expiry_location'])) {

    $location = $_SESSION['hold_expiry_location'];
    $id_showTime = $_SESSION['hold_expiry_id_showTime'];
    $hold_chairs =   (new Model())->getListTable('seats', "WHERE location ='$location' AND id_showTime = $id_showTime AND status = 0");
    if ($hold_chairs) {
?>
        <div class="container mt-1" style="z-index:10; position:absolute; width:300px; top:70px; left:40%">
            <div id="myDiv" class="alert alert-warning text-center">
                <span class="text-primary" style="font-size:14px;">Ghế của bạn đang được giữ</span><br>
                <span id="countdown_home" class="text-danger m-3"><b></b></span>
                <a href="<?php
                            if ($_SESSION['currentURL'] == '/pay.html') {
                                echo 'pay-.html';
                            }
                            if ($_SESSION['currentURL'] ==  '/chon-thuc-an.html') {
                                echo 'chon-thuc-an-.html';
                            }

                            ?>" class="text-primary" style="font-size:22px;"><i class="bi bi-arrow-left-square-fill"></i></a>
                <a href="huy-ghe.html" class="text-danger p-1" style="font-size:22px;"><i class="bi bi-x-circle-fill"></i></a>
            </div>
        </div>
        <?php
        $hod =  $hold_chairs[0]['hold_expiry'];
        $targetTime = strtotime($hod);
        $currentTime = time();
        $timeDifferenceInSeconds = $targetTime - $currentTime;
        ?>
        <script>
            let skae = <?php echo $timeDifferenceInSeconds ?> * 1000;
            let totalSeconds = <?php echo $timeDifferenceInSeconds ?>,
                el = document.getElementById('myDiv'),
                pos = 0;
            const countdownEl = document.getElementById("countdown_home"),
                countdownInterval = setInterval(() => {
                    if (totalSeconds <= 0) {
                        clearInterval(countdownInterval);
                        el.style.display = 'none';
                    } else {
                        totalSeconds--;
                        let m = Math.floor(totalSeconds / 60),
                            s = totalSeconds % 60;
                        countdownEl.innerHTML = `<b>${m}:${s < 10 ? '0' : ''}${s}</b>`;
                    }
                }, 1000),
                shakeInterval = setInterval(() => el.style.transform = `translateX(${pos = pos === 0 ? 1 : 0}px)`, 100);
            setTimeout(() => clearInterval(shakeInterval), 260000);
        </script>

<?php }
} ?>