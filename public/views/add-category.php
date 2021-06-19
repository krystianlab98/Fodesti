<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fodest Register Page</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/add-category.css">
</head>
<body>
<div class="base-container">
    <nav>
        <img src="public/images/logo.svg">
        <div class="menu">
            <ul>
                <li>
                    <a href="#">Home</a>
                </li>
                <li>

                    <a href="#">Menu</a>
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
        <section class="category-form">
            <h1>UPLOAD</h1>
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
                <input name="title" type="text" placeholder="title">
                <input type="file" name="file"/><br/>
                <button type="submit">send</button>
            </form>
        </section>
    </main>
</div>
</body>
</html>