<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/budgetSettings.css">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c692ed1a4c.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="menu_options">
    <i class="fa-solid fa-right-from-bracket fa-3x" style="color: #630000" onclick="window.location.href='/menu'"></i>
    <a href="/menu">Powrót</a>
</div>
<div class="main-container">

    <form class="info-container" action="/settings" method="POST">
        <button class="button_style" type="submit" style="color: #700002;" name="action" value="usun">
            <i class="fa-solid fa-trash fa-2x" style="color: #700002;"></i> USUNIĘCIE KONTA
        </button>
    </form>
    <?php

    if ($role === 'admin') {
        ?>
        <form class="info-container" action="/settings" method="POST">
            <input type="text" name="user_login" placeholder="LOGIN UŻYTKOWNIKA DO USUNIĘCIA" required>
            <button class="button_style" type="submit" style="color: #006c1e;" name="action" value="admin">
                <i class="fa-solid fa-arrow-up-from-bracket fa-2x" style="color: #006c1e;"></i> USUŃ UŻYTKOWNIKA
            </button>
        </form>
        <?php
    } ?>


</body>