<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fodest Register Page</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/dish.css">

<!--    <link rel="stylesheet" href="public/css/add-category.css">-->
</head>
<body>
<div class="base-container">
    <?php include('public/views/nav.php'); ?>
    <main>
        <?php include('public/views/searchBar.php'); ?>
        <section class="dish-form">
            <h2>Dodaj danie</h2>
            <form action="addDish" method="POST" ENCTYPE="multipart/form-data">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <select name="title">
                    <?php if(isset($categories)){
                        foreach ($categories as $category): ?>
                    <option><?= $category->getTitle(); ?></option>
                    <?php endforeach;  } ?>
                </select>
                <input name="name" type="text" placeholder="nazwa">
                <input name="price" type="number" placeholder="cena">
                <textarea name="description" type="text" placeholder="opis"></textarea>
                <input type="file" name="file" placeholder="Wybierz zdjęcia dania"/><br/>
                <button type="submit">send</button>
            </form>
        </section>
    </main>
</div>
</body>
</html>