<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fodest Login Page</title>

    <link rel="stylesheet" type="text/css"  href="public/css/login.css">
    <link rel="stylesheet" type="text/css"  href="public/css/style.css">
    <script type="text/javascript" src="./public/js/redirectRegister.js" defer></script>

</head>
<body>
    <?php include('public/views/nav.php'); ?>
    <div class="container">
        <div class="logo">
          <img src="public/images/logo.svg">
         </div>
         <div class="login-container">
            <form class="login" action="logged" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input class="login-input" name="email" type="text" placeholder="email@email.com">
                <input class="login-input" name="password" type="password" placeholder="password">
                 <button type="submit">Zaloguj się</button>
                <button type="button" id="register">Zarejestruj się</button>
             </form>
        </div>
    </div>
</body>