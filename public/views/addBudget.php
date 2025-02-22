<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/addBudget.css">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c692ed1a4c.js" crossorigin="anonymous"></script>
    <script src="public/scripts/addCategory.js"></script>
    <script src="public/scripts/addPayment.js"></script>
    <script src="public/scripts/budgetDataTransfer.js"></script>

</head>
<body>
<div class="main-container">
    <form class="info-container" action="/addBudget" method="POST">
        <input type="text" name="tytul" placeholder="TYTUŁ" required>
        <input type="number" name="budget_amount" placeholder="BUDŻET" required>


        <div id="categories-container">
            <div id="payments-container">

            </div>
        </div>
            <a id="info-container" onclick="addCategoryInput()">
                <i class="fa-solid fa-plus" style="color: #700002;"></i> Dodaj Nową Kategorię
            </a>
        <div class="submit-container">
            <a class="button_style" href="/menu" style="color: #700002;">
                <i class="fa-solid fa-x fa-2x" style="color: #700002;"></i> COFNIJ
            </a>
            <button class="button_style" type="button" style="color: #006c1e;" onclick="sendDataToPHP()">
                <i class="fa-solid fa-arrow-up-from-bracket fa-2x" style="color: #006c1e;"></i> STWÓRZ
            </button>
        </div>
    </form>
</div>


</body>