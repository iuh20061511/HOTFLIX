

let countdownTime = time

function startCountdown() {
    const countdownDisplay = document.getElementById("countdown");

    const interval = setInterval(() => {

        let minutes = Math.floor(countdownTime / 60);
        let seconds = countdownTime % 60;
        countdownDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        if (countdownTime <= 30) {
            countdownDisplay.classList.toggle("blink");
        }


        countdownTime--;
        if (countdownTime < 0) {
            clearInterval(interval);

            window.location.href = "index.php";
        }
    }, 1000);
}

window.onload = startCountdown;
