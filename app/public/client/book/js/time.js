function startCountdown(duration, display) {
    var timer = duration, minutes, seconds;
    var warningThreshold = 30; // Thời gian còn lại để bắt đầu nhấp nháy

    var interval = setInterval(function () {
        if (timer <= 0) {
            clearInterval(interval); // Dừng đếm ngược khi hết thời gian
            display.textContent = "Hết thời gian!";
            localStorage.removeItem('endTime'); // Xóa thời gian kết thúc khi hết
        } else {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            // Thêm lớp cảnh báo khi thời gian còn lại dưới ngưỡng
            if (timer <= warningThreshold) {
                display.classList.add('warning');
            }

            // Lưu thời gian còn lại vào localStorage
            localStorage.setItem('remainingTime', timer);
            timer--; // Giảm timer sau khi cập nhật hiển thị
        }
    }, 1000);
}

window.onload = function () {
    var countdownElement = document.getElementById('countdown');
    var duration = 60 * 6; // 6 minutes in seconds
    var endTime;

    // Kiểm tra xem đã có thời gian kết thúc được lưu trong localStorage không
    if (localStorage.getItem('endTime')) {
        endTime = new Date(localStorage.getItem('endTime'));
        var timeLeft = Math.floor((endTime - new Date()) / 1000); // Tính toán thời gian còn lại
        if (timeLeft > 0) {
            // Nếu còn thời gian, sử dụng nó
            startCountdown(timeLeft, countdownElement);
        } else {
            // Nếu thời gian đã hết, xóa giá trị trong localStorage
            localStorage.removeItem('endTime');
            countdownElement.textContent = "Hết thời gian!"; // Hiển thị thông báo hết thời gian
        }
    } else {
        // Nếu không có, tính thời gian kết thúc mới và lưu vào localStorage
        endTime = new Date(Date.now() + duration * 1000);
        localStorage.setItem('endTime', endTime);
        startCountdown(duration, countdownElement);
    }
};