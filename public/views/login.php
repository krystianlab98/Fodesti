<!DOCTYPE html>
<head>
    <title>Fodest Login Page</title>
    <link rel="stylesheet" type="text/css"  href="public/css/login.css">
    <link rel="stylesheet" type="text/css"  href="public/css/style.css">
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
                 <button type="submit">Login</button>
             </form>
        </div>
    </div>
</body>