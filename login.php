<?php
session_start();

$error = null;

if (isset($_POST["submit"])) {
    if (!isset($_POST["login"]) && $error == null)
        $error = "Nie podano loginu";

    if (!isset($_POST["pass"]) && $error == null)
        $error = "Nie podano hasła";

    if ($error == null) {
        $pdo = new PDO("mysql:host=localhost;dbname=fuji;charset=utf8", "root");
        $prep = $pdo->prepare("SELECT * FROM users WHERE login = :login");
        $prep->execute([":login" => $_POST["login"]]);

        $data = $prep->fetch();
        if ($data != null) {
            if ($data["pass"] == sha1($_POST["pass"])) {
                $_SESSION["login"] = $_POST["login"];

                if (isset($_GET["p"]) && $_GET["p"] == "c")
                    header("Location: configurator.php");
                else
                    header("Location: user_panel.php");
            } else
                $error = "Podano błędne hasło";
        } else
            $error = "Podano błędny login";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">
</head>

<body>
    <?php include "./components/navbar.php" ?>

    <!-- Tło -->
    <div class="background__container">
        <img src="./img/login-image.jpg" class="background">
    </div>

    <!-- Formularz -->
    <div class="login__wrapper">
        <div class="login__container">
            <?php
            if (isset($_GET["p"]) && $_GET["p"] == "c" && !isset($_GET["login"]))
                echo "<div class='color'>Najpierw musisz się zalogować</div><br>";
            ?>
            <form action="login.php<?php echo isset($_GET["p"]) && $_GET["p"] == "c" ? "?p=c" : ""; ?>" method="post">
                <table>
                    <tr>
                        <td>Login</td>
                        <td><input type="text" name="login" id="login" value="<?php echo isset($_POST["login"]) ? $_POST["login"] : (isset($_GET["login"]) ? $_GET["login"] : ""); ?>"></td>
                    </tr>
                    <tr>
                        <td>Hasło</td>
                        <td><input type="password" name="pass" id="pass"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><a class="color" style="text-decoration: underline;" href="register.php<?php echo isset($_GET["p"]) && $_GET["p"] == "c" ? "?p=c" : ""; ?>">Nie masz konta?</a></td>
                    </tr>
                    <tr>
                        <td style=" color: red" colspan="2"><?php echo $error != null ? $error : "&nbsp;"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <input type="submit" name="submit" value="Zaloguj">
                            </center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php include "./components/footer.php" ?>
</body>

</html>