function addCategoryInput() {
    const categoriesContainer = document.getElementById("categories-container");

    const newCategory = document.createElement("div");
    newCategory.classList.add("category-group");

    newCategory.innerHTML = `
        <div class="category-container">
            <input type="text" name="category" placeholder="KATEGORIA" required>
            <a class="remove-btn" onclick="removeCategory(this)">
                <i class="fa-solid fa-minus" style="color: #700002;"></i>
            </a>
        </div>
        <div class="payments-container"></div>
        <div class="info-container">
            <a class="payment-a" onclick="addPaymentInput(this)">
                <i class="fa-solid fa-plus" style="color: #700002;"></i> Dodaj Płatność
            </a>
        </div>
    `;

    categoriesContainer.appendChild(newCategory);
}

function removeCategory(categoryLink) {
    const categoryGroup = categoryLink.closest(".category-group");
    const categoryName = categoryGroup.querySelector('input[name="category"]').value;
    // Remove the category from the categoriesData object
    categoriesData = categoriesData.filter(category => category.name !== categoryName);
    categoryGroup.remove();
}