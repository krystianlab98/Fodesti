<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fodest Register Page</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/category.css">

    <!--    <link rel="stylesheet" href="public/css/add-category.css">-->
</head>
<body>
<div class="base-container">
    <?php include('public/views/nav.php'); ?>
    <main>
        <?php include('public/views/searchBar.php'); ?>
        <section class="category-form">
            <h2>Dodaj danie</h2>
            <form action="addCategory" method="POST" ENCTYPE="multipart/form-data">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <input name="title" type="text" placeholder="tytuł">
                <input type="file" name="file" placeholder="Wybierz zdjęcia kategorii"/><br/>
                <button type="submit">send</button>
            </form>
        </section>
    </main>
</div>
</body>
</html>