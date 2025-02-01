let categoriesData = [];

function collectData() {
    categoriesData = [];

    const categoryGroups = document.querySelectorAll('.category-group');
    console.log("Category Groups:", categoryGroups);

    categoryGroups.forEach(categoryGroup => {
        const categoryName = categoryGroup.querySelector('input[name="category"]').value;
        const payments = [];

        const paymentGroups = categoryGroup.querySelectorAll('.payment-group');
        paymentGroups.forEach(paymentGroup => {
            const paymentTitle = paymentGroup.querySelector('input[name="payment_title"]').value;
            const paymentAmount = paymentGroup.querySelector('input[name="payment_amount"]').value;
            const paymentDate = paymentGroup.querySelector('input[name="payment_date"]').value;

            payments.push({
                title: paymentTitle,
                amount: paymentAmount,
                date: paymentDate
            });
        });

        categoriesData.push({
            name: categoryName,
            payments: payments
        });
    });

    console.log("Categories Data:", categoriesData);
}



function sendDataToPHP() {
    collectData();

    const data = {
        categories: categoriesData,
        tytul: document.querySelector('input[name="tytul"]').value,
        budget: document.querySelector('input[name="budget_amount"]').value
    };

    fetch('/addBudget', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
}


