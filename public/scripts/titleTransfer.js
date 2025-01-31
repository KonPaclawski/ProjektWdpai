
function sendBudgetTitle(title) {
    fetch('/budget', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ title: title })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "/budget";
            } else {
                alert("Błąd: " + data.error);
            }
        })
        .catch(error => console.error("Fetch error:", error));
}