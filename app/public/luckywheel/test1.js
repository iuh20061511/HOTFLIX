(() => {
    document.addEventListener('DOMContentLoaded', () => {
        const $ = document.querySelector.bind(document);

        let timeRotate = 6000; // 6 giây
        let currentRotate = 0;
        let isRotating = false;
        const wheel = $('.wheel');  // Chọn thẻ <ul class="wheel">
        let inputIdGift = $('#id_gift_wheel');
        let updatePoints = $('#updatePoint');
        let btnSubmitWheel = $('#btnSubmitWheel');
        const btnWheel = $('.wheel__button');
        const modalMessage = $('#modal-message');
        const notifyWheel = $('#notify_wheel');
        const modalImageWheel = $('#image_wheel');
        const prizeModal = new bootstrap.Modal(document.getElementById('prizeModal'), {
            backdrop: 'static',  // Cấm đóng modal khi nhấn ra ngoài
            keyboard: false      // Cấm đóng modal bằng phím Escape
        });

        //=====< Lấy danh sách phần thưởng từ các thẻ li >=====
        const listGift = Array.from(wheel.children).map((li, index) => {
            return {
                id_gift: li.querySelector('b').getAttribute('data-id-gift'),
                gift_name: li.querySelector('b').innerText,
                index: index,
                image: li.querySelector('b').getAttribute('data-image-gift'),
                percent: parseFloat(li.querySelector('b').getAttribute('data-percent')),
            };
        });

        console.log(listGift);

        //=====< Chuẩn hóa phần trăm >=====
        const normalizeListGift = list => {
            const totalPercent = list.reduce((sum, item) => sum + item.percent, 0); // Tổng tỷ lệ ban đầu

            return list.map(item => ({
                ...item,
                percent: item.percent / totalPercent, // Chuẩn hóa tỷ lệ để tổng = 1
            }));
        };

        // Chuẩn hóa danh sách phần thưởng
        const normalizedListGift = normalizeListGift(listGift);

        console.log('Normalized List:', normalizedListGift);

        const size = normalizedListGift.length;
        const rotate = 360 / size;
        const skewY = 90 - rotate;

        /********** Hàm bắt đầu quay **********/
        const start = () => {
            modalMessage.innerHTML = '';
            isRotating = true;
            const random = Math.random(); // Sinh số ngẫu nhiên từ 0 đến 1
            const gift = getGift(random); // Lấy phần quà dựa trên số ngẫu nhiên
            currentRotate += 360 * 10;
            rotateWheel(currentRotate, gift.index);
            showGift(gift);
        };

        /********** Hàm quay vòng quay **********/
        const rotateWheel = (currentRotate, index) => {
            wheel.style.transition = `transform ${timeRotate / 1000}s ease-out`;
            wheel.style.transform = `rotate(${currentRotate - index * rotate - rotate / 2}deg)`;
        };

        /********** Hàm lấy phần thưởng **********/
        const getGift = randomNumber => {
            let currentPercent = 0;

            for (const item of normalizedListGift) {
                currentPercent += item.percent; // Cộng dồn tỷ lệ
                if (randomNumber <= currentPercent) {
                    return item; // Trả về phần quà phù hợp
                }
            }

            return null; // Phòng trường hợp không tìm thấy phần quà (không nên xảy ra)
        };

        /********** Hiển thị phần thưởng ra modal **********/
        const showGift = gift => {
            setTimeout(() => {
                isRotating = false;
                // Kiểm tra nếu gift_name là "may mắn lần sau"
                if (gift.gift_name.toLowerCase() === "chúc bạn may mắn lần sau") {
                    modalMessage.innerHTML = `Chúc bạn may mắn lần sau!`;
                    notifyWheel.innerHTML = 'Thật đáng tiếc!';
                } else {
                    modalMessage.innerHTML = `Bạn đã trúng thưởng "${gift.gift_name}"`;
                }
                modalImageWheel.src = gift.image;
                inputIdGift.value = gift.id_gift;
                updatePoints.value = userPoints - minPointsRequired;
                prizeModal.show();
            }, timeRotate);
        };

        /********** Sự kiện click vào nút quay **********/
        btnWheel.addEventListener('click', () => {
            if (userPoints >= minPointsRequired) {
                if (!isRotating) {
                    btnSubmitWheel.type = 'submit';
                    btnSubmitWheel.removeAttribute('data-bs-dismiss');
                    start();
                }
            } else {
                modalMessage.innerHTML = `Bạn đã không đủ điểm để tham gia vòng quay`;
                notifyWheel.innerHTML = 'Thật đáng tiếc!';
                modalImageWheel.src = srcImageFail;
                // Cập nhật cấu hình của modal
                const updateModalConfig = (backdropSetting, keyboardSetting) => {
                    prizeModal._config.backdrop = backdropSetting;  // Cập nhật backdrop
                    prizeModal._config.keyboard = keyboardSetting;  // Cập nhật keyboard
                };
                updateModalConfig('true', true);
                prizeModal.show();
            }
        });

    });
})();