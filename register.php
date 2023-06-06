<?php
session_start();

$error = null;

if (isset($_POST["submit"])) {
    if (!isset($_POST["login"]) && $error == null)
        $error = "Nie podano loginu";

    if (!isset($_POST["pass"]) && $error == null)
        $error = "Nie podano hasła";

    if (!isset($_POST["pass2"]) && $error == null)
        $error = "Nie powtórzono hasła";

    if ($_POST["pass"] != $_POST["pass2"] && $error == null)
        $error = "Hasła nie są takie same";
    else if ($error == null) {
        $pdo = new PDO("mysql:host=localhost;dbname=fuji;charset=utf8", "root");
        $prep = $pdo->prepare("SELECT * FROM users WHERE login = :login");
        $prep->execute([":login" => $_POST["login"]]);

        if ($prep->fetch() == null) {
            $prep = $pdo->prepare("INSERT INTO users (login, pass) VALUES (:login, :pass)");
            $prep->execute([":login" => $_POST["login"], ":pass" => sha1($_POST["pass"])]);

            if (isset($_GET["p"]) && $_GET["p"] == "c")
                header("Location: login.php?login={$_POST["login"]}&p=c");
            else
                header("Location: login.php?login={$_POST["login"]}");
        } else
            $error = "Login jest zajęty";
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
            <form action="register.php<?php echo isset($_GET["p"]) && $_GET["p"] == "c" ? "?p=c" : ""; ?>" method="post">
                <table>
                    <tr>
                        <td>Login</td>
                        <td><input required type="text" name="login" id="login" value="<?php echo isset($_POST["login"]) ? $_POST["login"] : ""; ?>"></td>
                    </tr>
                    <tr>
                        <td>Hasło</td>
                        <td><input required type="password" name="pass" id="pass"></td>
                    </tr>
                    <tr>
                        <td>Powtórz hasło</td>
                        <td><input required type="password" name="pass2" id="pass2"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><a class="color" style="text-decoration: underline;" href="login.php<?php echo isset($_GET["p"]) && $_GET["p"] == "c" ? "?p=c" : ""; ?>">Mam już konto</a></td>
                    </tr>
                    <tr>
                        <td style="color: red" colspan="2"><?php echo $error != null ? $error : "&nbsp;"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <input type="submit" name="submit" value="Zarejestruj">
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