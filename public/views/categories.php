<!DOCTYPE html>
<head>
    <title>Fodesti Categories</title>
    <link rel="stylesheet" type="text/css"  href="public/css/style.css">
    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="base-container">
    <nav>
        <img src="public/images/logo.svg">
        <div class="menu">
            <ul>
                <li>
                    <a href="http://localhost:8080">Home</a>
                </li>
                <li>

                    <a href="http://localhost:8080/menu">Menu</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <?php
                    if($_SESSION['email']){
                        $log = "Logout";
                        $href = "http://localhost:8080/logout";
                        echo "<a href= $href >$log</a>";
                    } else {
                        $log = "Login";
                        $href = "http://localhost:8080/login";
                        echo "<a href= $href >$log</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <section class="categories">
            <h2>Categories</h2>
            <div class="categories-box">

                <?php
                if(isset($categories))
                    foreach ($categories as $category): ?>

                <div class="box">
                    <h3><?= $category->getTitle(); ?></h3>
                    <img src="public/uploads/<?= $category->getImage(); ?>">
                </div>

                <?php endforeach; ?>
            </div>
        </section>
    </main>
</div>
</body>


