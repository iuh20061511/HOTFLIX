document.addEventListener('DOMContentLoaded', function () {
    const combos = document.querySelectorAll('.combo-item');
    const selectedCombos = document.getElementById('selected-combos');
    const totalPriceElement = document.getElementById('total-price');
    let totalPrice = 80000; // Starting price for the ticket

    combos.forEach(combo => {
        const decreaseBtn = combo.querySelector('.decrease');
        const increaseBtn = combo.querySelector('.increase');
        const quantityElement = combo.querySelector('.quantity-value');
        const price = parseInt(combo.dataset.price);
        const name = combo.dataset.name;

        increaseBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent form submission
            let quantity = parseInt(quantityElement.textContent);
            quantity++;
            quantityElement.textContent = quantity;
            totalPrice += price;
            updateSelectedCombos(name, quantity, price);
            updateTotalPrice();
        });

        decreaseBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent form submission
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 0) {
                quantity--;
                quantityElement.textContent = quantity;
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
    }

    function formatPrice(price) {
        return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    }
});

