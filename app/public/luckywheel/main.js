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

            return null;
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
        btnWheel.addEventListener('click', (e) => {
            e.preventDefault();
            if (userPoints >= minPointsRequired) {
                if (!isRotating) {
                    start();

                    // Sau khi quay xong, gửi yêu cầu AJAX
                    setTimeout(() => {
                        const idGift = inputIdGift.value;
                        const updatedPoints = updatePoints.value;

                        // Gửi AJAX đến server để xử lý quay thưởng
                        fetch(urlSever, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id_gift: idGift, updatePoint: updatedPoints, currentPage: numberPage })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    // Cập nhật điểm người dùng và danh sách quà
                                    userPoints = data.newPoints;
                                    document.querySelector('#userPoints').innerHTML = userPoints;
                                    // Render lại danh sách quà
                                    updateGiftList(data.giftDetails);
                                } else {
                                    alert('Có lỗi xảy ra: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Lỗi kết nối tới server!');
                            });
                    }, timeRotate); // Gửi yêu cầu sau khi quay xong
                }
            } else {
                // Hiển thị thông báo không đủ điểm
                modalMessage.innerHTML = `Bạn đã không đủ điểm để tham gia vòng quay`;
                notifyWheel.innerHTML = 'Thật đáng tiếc!';
                modalImageWheel.src = srcImageFail;
                prizeModal.show();
            }
        });

        /********** Hàm cập nhật danh sách quà **********/
        const updateGiftList = giftDetails => {
            const giftTableBody = document.querySelector('#giftTableBody');
            giftTableBody.innerHTML = ''; // Xóa nội dung cũ

            giftDetails.forEach(gift => {
                const row = `
                    <tr>
                        <td class="align-middle">
                            <div class="catalog__img__wheel">
                                <img src="${urlGift}${gift.image}" alt="Gift">
                            </div>
                        </td>
                        <td class="align-middle">${gift.gift_name}</td>
                        <td class="align-middle">1</td>
                        <td class="align-middle">${gift.receiveTime ? gift.receiveTime + ' - ' + gift.cinemaLocation : 'Chưa xác định'}</td>
                        <td class="align-middle ${gift.status === 1 ? 'text-success' : 'text-danger'}">
                            ${gift.status === 1 ? 'Đã nhận' : 'Chưa nhận'}
                        </td>
                    </tr>
                `;
                giftTableBody.innerHTML += row;
            });
        };

    });
})();
