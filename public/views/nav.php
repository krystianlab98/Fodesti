<nav>
    <img src="public/images/logo.svg">
    <div class="menu">
        <ul>
            <li>
                <a href="http://localhost:8080">Home</a>
            </li>
            <li>

                <a href="http://localhost:8080/dishes">Menu</a>
            </li>
            <?php
            if($_SESSION['email']){
                $log = "Zamówienia";
                $href = "http://localhost:8080/orders";  ?>
                <li>
                    <?php
                    echo "<a href= $href >$log</a>"
                    ?>
                </li>
            <?php  } ?>
            <?php
            if($_SESSION['email']){
                $log = "Koszyk";
                $href = "http://localhost:8080/cart";  ?>
                <li>
                    <?php
                    echo "<a href= $href >$log</a>"
                    ?>
                </li>
                <?php  } ?>

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