<!DOCTYPE html>
<head>
    <title>Fodest Login Page</title>
    <link rel="stylesheet" type="text/css"  href="public/css/order.css">
    <link rel="stylesheet" type="text/css"  href="public/css/style.css">
</head>
<body>
<?php include('public/views/nav.php'); ?>
<div class="container">
   <h1>Zamówienie</h1>

    <form class="order-container" action="order" method="POST">
        <div class="selected-food">
            <h4>Wybrane dania</h4>
            <?php if(isset($order)){
            foreach ($order->getDishes() as $dish): ?>
                <div class="dish-box">
<!--                    <div class="dish-image">-->
                        <img class = "dish-image" src="public/uploads/<?= $dish->getImageName(); ?>">

<!--                    </div>-->
                    <div class="dish-details">
                        <input name="dishId[]" type="hidden" value="<?= $dish->getId(); ?>">
                        <input name="dishName[]" readonly value="<?= $dish->getName(); ?>">
                        <input name="description[]" readonly value="<?= $dish->getDescription(); ?>">
                        <input name="price[]" readonly value="<?= $dish->getPrice(); ?>">
                        <input name="image-name[]" type="hidden" value="<?= $dish->getImageName(); ?>">
                        <input name="categoryID[]" type="hidden" value="<?= $dish->getCategoriesId(); ?>">
                    </div>
                </div>
            <?php endforeach; } ?>
        </div>
        <div class="delivery-details">
            <h4>Szczegóły dostawy</h4>
            <input name="name" placeholder="imie" value="<?= $order->getPurchaser()->getName(); ?>">
            <input name="surname" placeholder="nazwisko" value="<?= $order->getPurchaser()->getSurname(); ?>">
            <input name="phone" placeholder="numer telefonu" value="<?= $order->getPurchaser()->getPhone(); ?>">
            <input name="email" placeholder="email" value="<?= $order->getPurchaser()->getEmail(); ?>">
            <input name="address" placeholder="adres dostawy" value="<?= $order->getPurchaser()->getAddress(); ?>">
            <div>
                <p name="totalAmount">Cena:<?= $order->getTotalAmount(); ?></p>
                <button type="submit">Zamów</button>
            </div>
        </div>
    </form>

</div>
</body>