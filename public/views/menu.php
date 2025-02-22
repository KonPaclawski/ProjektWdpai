<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <title>Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c692ed1a4c.js" crossorigin="anonymous"></script>
    <script src="public/scripts/titleTransfer.js"></script>
</head>
<body>
<div class="container">
    <div class="menu_left">
        <div class="logo_left">
            <a>BudgetFlow</a>
            <i class="fa-solid fa-credit-card fa-5x" style="color: #630000;"></i>
        </div>
        <div class="options-container">
            <div class="menu_options">
                <i class="fa-solid fa-circle-plus fa-3x"  style="color: #630000" onclick="window.location.href='/addBudget'"></i>
                <a href="/addBudget">Nowy budżet</a>
            </div>
            <div class="menu_options">
                <i class="fa-solid fa-gear fa-3x" style="color: #630000" onclick="window.location.href='/settings'"></i>
                <a href="/settings">Ustawienia</a>
            </div>
            <div class="menu_options">
                <i class="fa-solid fa-right-from-bracket fa-3x" style="color: #630000" onclick="window.location.href='/login'"></i>
                <a href="/login">Wyloguj się</a>
            </div>
        </div>
    </div>

    <div class="budgets-container">
        <?php if (isset($budgets) && count($budgets) > 0): ?>
            <?php foreach ($budgets as $budget): ?>
                <div class="budget-box" onclick="sendBudgetTitle('<?php echo htmlspecialchars($budget['title']); ?>')">
                    <?php echo htmlspecialchars($budget['title']); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</body>
