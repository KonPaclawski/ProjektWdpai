function addPaymentInput(paymentLink) {
    const categoryGroup = paymentLink.closest(".category-group");
    const paymentsContainer = categoryGroup.querySelector(".payments-container");

    const newPaymentInput = document.createElement("div");
    newPaymentInput.classList.add("payment-group");

    newPaymentInput.innerHTML = `
        <div class="payment-container">
            <input type="text" name="payment_title" placeholder="TYTUŁ PŁATNOŚCI" required>
            <a class="remove-btn" onclick="removePayment(this)">
                <i class="fa-solid fa-minus" style="color: #700002;"></i>
            </a>
        </div>
        <div class="info-container">
            <input type="number" name="payment_amount" placeholder="KWOTA" required>
            <input type="date" name="payment_date" placeholder="DATA PŁATNOŚCI" required>
        </div>
    `;

    paymentsContainer.appendChild(newPaymentInput);
}

function removePayment(paymentLink) {
    paymentLink.closest(".payment-group").remove();
}