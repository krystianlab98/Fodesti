<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css"  href="public/css/register.css">
    <link rel="stylesheet" type="text/css"  href="public/css/style.css">


    <script type="text/javascript" src = "./public/js/register.js" defer></script>
    <title>Fodesti Register Page</title>
</head>
<body>
    <?php include('public/views/nav.php'); ?>
    <div class="container">
        <form action="createUser" method="POST">
            <input name="email" placeholder="email" type="text">
            <input name="password" placeholder="hasło" type="password">
            <input name="confirmedPassword" placeholder="Powtórz hasło" type="password">
            <input name="name" placeholder="imię" type="text">
            <input name="surname" placeholder="nazwisko" type="text">
            <input name="phone" placeholder="nr telefonu" type="number">
            <input name="address" placeholder="Podaj adres" type="text">
            <button type="submit">Zarejestruj się</button>
        </form>
    </div>
</body>
</html>