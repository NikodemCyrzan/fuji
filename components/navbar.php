<div class="nav__wrapper">
    <div class="nav__content">
        <h3><a class="color" href="index.php">Fuji Inc</a></h3>
        <div class="nav__sub-container">
            <?php
            if (isset($_SESSION["login"]))
                echo "<a class='lower-link' href='logout.php'>Wyloguj</a><a class='highlighted-link' href='user_panel.php'>Panel użytkownika</a>";
            else
                echo "<a class='lower-link' href='register.php'>Zarejestruj</a><a class='highlighted-link' href='login.php'>Zaloguj</a>"
            ?>
        </div>
    </div>
</div>