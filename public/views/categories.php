<!DOCTYPE html>
<head>
    <title>Fodesti Categories</title>

    <link rel="stylesheet" type="text/css"  href="public/css/style.css">
    <link rel="stylesheet" type="text/css"  href="public/css/category.css">
    <script type="text/javascript" src="./public/js/search.js" defer>
    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="base-container">
    <?php include('public/views/nav.php'); ?>
    <main>
        <?php include('public/views/searchBar.php'); ?>
        <section class="categories">
            <h2>Categories</h2>
            <?php if(isset($user) && $user->getRole() == "ADMIN") { ?>
            <button id="addCategory" type="button">Dodaj nową kategorie</button>
            <?php } ?>
            <div class="categories-box">

                <?php if(isset($categories)){
                    foreach ($categories as $category): ?>

                    <div class="box">
                        <h3><?= $category->getTitle(); ?></h3>
                        <img class="box-image" src="public/uploads/<?= $category->getImageName(); ?>">
                    </div>

                <?php endforeach; } ?>
            </div>2
        </section>
    </main>
</div>
</body>
<script>
    document.getElementById("addCategory").onclick = function () {
        location.href = "http://localhost:8080/addCategoryView";
    }
</script>


