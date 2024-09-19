document.addEventListener("DOMContentLoaded", function () {
    const seatInputs = document.querySelectorAll("input[name='seat[]']");
    const doubleSeatInputs = document.querySelectorAll("input[name='seat_double[]']");
    const seatDisplay = document.querySelector(".count_seat_buy"); // Chỗ hiển thị ghế ngồi
    const totalDisplay = document.querySelector(".total"); // Chỗ hiển thị tổng tiền

    let selectedSeats = [];
    let totalPrice = 0;

    // Hàm cập nhật thông tin ghế ngồi và tổng tiền
    function updateSeatInfo() {
        seatDisplay.innerText = `Ghế ngồi: ${selectedSeats.join(', ')}`;
        totalDisplay.innerText = `Tổng tiền: ${totalPrice.toLocaleString('vi-VN')} VNĐ`;
    }

    // Hàm xử lý chọn ghế
    function handleSeatSelection(event) {
        const seatElement = event.target;
        const seatLabel = seatElement.nextElementSibling.innerText; // Lấy giá trị của ghế
        let seatPrice = a;

        if (seatElement.closest("label").classList.contains("seat-vip")) {
            seatPrice = b;
        } else if (seatElement.closest("label").classList.contains("seat_double")) {
            seatPrice = c;
        }

        if (seatElement.checked) {
            selectedSeats.push(seatLabel);
            totalPrice += seatPrice;
        } else {
            selectedSeats = selectedSeats.filter(seat => seat !== seatLabel);
            totalPrice -= seatPrice;
        }

        updateSeatInfo();
    }

    // Gán sự kiện thay đổi cho các ghế
    seatInputs.forEach(seat => {
        seat.addEventListener("change", handleSeatSelection);
    });

    doubleSeatInputs.forEach(seat => {
        seat.addEventListener("change", handleSeatSelection);
    });
});