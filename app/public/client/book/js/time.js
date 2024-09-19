function startCountdown(duration, display) {
    var timer = duration, minutes, seconds;
    var warningThreshold = 30; // Thời gian còn lại để bắt đầu nhấp nháy

    var interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        // Thêm lớp cảnh báo khi thời gian còn lại dưới ngưỡng
        if (timer <= warningThreshold) {
            display.classList.add('warning');
        }

        if (--timer < 0) {
            clearInterval(interval); // Dừng đếm ngược khi hết thời gian
            display.textContent = "Hết thời gian!";
        }
    }, 1000);
}

window.onload = function () {
    var countdownElement = document.getElementById('countdown');
    var duration = 60 * 6; // 6 minutes in seconds
    startCountdown(duration, countdownElement);
};