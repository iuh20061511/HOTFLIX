<?php

if (isset($_SESSION['hold_expiry_location'])) {

?>

    <div style="z-index: 100; position: absolute; top: 0; left: 0; right: 0px; bottom:0 ;width: 100%; height: 100vh; background: #ccccccb8;">
        <div id="myDiv" class="alert alert-primary rounded" style=" max-width: 600px; margin: auto; position: relative; top: 50%; transform: translateY(-50%); text-align: justify;">
            <span class="text-dark">
                <b>Nếu bạn quyết định chọn vé mới, vé cũ của bạn sẽ tự động bị hủy.
                    Chúng tôi thực hiện việc này để đảm bảo tính chính xác và hiệu quả trong quá trình quản lý vé.
                    Xin vui lòng kiểm tra kỹ trước khi xác nhận, để tránh bất kỳ sự bất tiện nào.</b>
            </span>


            <form action="" class="m-3" method="POST">
                <a href="javascript:window.history.back();" class="text-danger">
                    <b><i class="bi bi-arrow-left"></i> Quay lại</b>
                </a>

                <input type="submit" value="Đồng ý" class="btn btn-success" name="refreshTicket" style="float: right;">
            </form>
        </div>
    </div>

<?php
}
?>