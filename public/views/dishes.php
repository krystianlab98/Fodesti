<!DOCTYPE html>
<head>
    <title>Fodesti Categories</title>
    <link rel="stylesheet" type="text/css"  href="public/css/style.css">
    <link rel="stylesheet" type="text/css"  href="public/css/dish.css">
    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="base-container">
    <?php include('public/views/nav.php'); ?>
    <main>
        <?php include('public/views/searchBar.php'); ?>
        <section class="dishes">
            <h2>Dania</h2>
            <div class="dishes-box">

                <?php if(isset($dishes)){
                    foreach ($dishes as $dish): ?>

                        <div class="box">
                            <h3><?= $dish->getName(); ?></h3>
                            <img class = "image-dish" src="public/uploads/<?= $dish->getImageName(); ?>">
                            <h4>Opis: <?= $dish->getDescription(); ?></h4>
                            <div class="buttons">
                                <button name="price">cena: <?= $dish->getPrice(); ?> zł</button>
                                <button name="order">Dodaj do koszyka</button>
                            </div>
                        </div>
                    <?php endforeach; } ?>
            </div>
        </section>
    </main>
</div>
</body>


