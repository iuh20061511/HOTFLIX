document.addEventListener('DOMContentLoaded', function () {
    const combos = document.querySelectorAll('.combo-item');
    const selectedCombos = document.getElementById('selected-combos');
    const totalPriceElement = document.getElementById('total-price');

    let totalPrice = parseInt(total);

    combos.forEach(combo => {
        const decreaseBtn = combo.querySelector('.decrease');
        const increaseBtn = combo.querySelector('.increase');
        const quantityInput = combo.querySelector('.quantity-value');
        const quantityprice = combo.querySelector('.price_total');

        const price = parseInt(combo.dataset.price);
        const name = combo.dataset.name;

        increaseBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;  // Cập nhật giá trị input
            totalPrice += price;
            updateSelectedCombos(name, quantity, price);
            updateTotalPrice();
        });

        decreaseBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                quantity--;
                quantityInput.value = quantity;  // Cập nhật giá trị input
                totalPrice -= price;
                updateSelectedCombos(name, quantity, price);
                updateTotalPrice();
            }
        });
    });

    function updateSelectedCombos(name, quantity, price) {
        const existingCombo = selectedCombos.querySelector(`[data-name="${name}"]`);

        if (quantity > 0) {
            if (existingCombo) {
                existingCombo.textContent = `${quantity}x ${name} - ${formatPrice(quantity * price)}`;
            } else {
                const comboElement = document.createElement('p');
                comboElement.textContent = `${quantity}x ${name} - ${formatPrice(quantity * price)}`;
                comboElement.dataset.name = name;
                selectedCombos.appendChild(comboElement);
            }
        } else if (existingCombo) {
            existingCombo.remove();
        }
    }

    function updateTotalPrice() {
        totalPriceElement.textContent = formatPrice(totalPrice);
        quantityprice.value = formatPrice(totalPrice);
    }

    function formatPrice(price) {
        return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    }
});
