<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/budget.css">
    <title>Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c692ed1a4c.js" crossorigin="anonymous"></script>
    <script src="public/scripts/titleTransfer.js"></script>
</head>
<body>
<div class="menu_left">
    <div class="logo_left">
        <a>BudgetFlow</a>
        <i class="fa-solid fa-credit-card fa-5x" style="color: #630000;"></i>
    </div>
    <div class="menu_options">
        <i class="fa-solid fa-gear fa-3x" style="color: #630000" onclick="window.location.href='/budgetSettings'"></i>
        <a href="/budgetSettings">Ustawienia</a>
    </div>
    <div class="menu_options">
        <i class="fa-solid fa-circle-plus fa-3x" style="color: #630000" onclick="window.location.href='/addBudget'"></i>
        <a href="/addBudget">Nowy budżet</a>
    </div>
    <div class="menu_options">
        <i class="fa-solid fa-right-from-bracket fa-3x" style="color: #630000" onclick="window.location.href='/menu'"></i>
        <a href="/menu">Powrót</a>
    </div>
</div>

<div class="budgets-container">
    <div class="amount-container">
        <h1><?php echo htmlspecialchars($budget_current->getTitle()); ?></h1>
        <a>Wykorzystanie budżetu <?php echo htmlspecialchars($budget_current->getRemainingBudget()); ?>/<?php echo htmlspecialchars($budget_current->getBudget()); ?></a>
    </div>
    <?php foreach ($budget_current->getCategories() as $category_name => $payments): ?>
        <h3><?php echo htmlspecialchars($category_name); ?></h3>
        <div class="data-container">
        <?php foreach ($payments as $payment): ?>
        <div class="category-container">
            <div class="payments-container">
                <a><?php echo htmlspecialchars($payment['title_payment']); ?> - <?php echo htmlspecialchars($payment['to_pay']); ?> zł</a>
            </div>
            <div class="date-container">
                <a>Kolejna Płatność: <?php echo htmlspecialchars($payment['pay_date']); ?></a>
            </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </div>
</div>
</body>
