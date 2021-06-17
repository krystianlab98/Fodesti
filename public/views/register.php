<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fodest Register Page</title>
</head>
<body>
<div class="container">
    <form action="createUser" method="POST">
        <input name="email" placeholder="email" type="text">
        <input autocomplete="new-password" name="password" placeholder="hasło" type="password">
        <input name="name" placeholder="imię" type="text">
        <input name="surname" placeholder="nazwisko" type="text">
        <input name="phone" placeholder="nr telefonu" type="number">
        <input name="address" placeholder="Podaj adres" type="text">
        <input type="submit" value="Zarejestruj się">
    </form>
</div>
</body>
</html>