<?php
session_start();

if (!isset($_SESSION["login"]))
    header("Location: index.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">
    <script src="./js/resizer.js" defer></script>
</head>

<body>
    <?php include "./components/navbar.php" ?>

    <!-- Dane użytkownika -->
    <div class="content-wrapper">
        <h2 class="border">Użytkownik</h2>
        <p>
            Login: <?php echo $_SESSION["login"]; ?>
        </p>
    </div>

    <!-- Lista rezerwacji wycieczek -->
    <div class="content-wrapper">
        <h2 class="border" id="reserved">Zarezerwowane wycieczki</h2>
        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=fuji;charset=utf8", "root");
        $res = $pdo->query("SELECT * FROM users WHERE login = '{$_SESSION["login"]}'");

        $data = $res->fetch();

        if ($data != null) {
            $id = $data["id"];

            $prep = $pdo->prepare("SELECT * FROM orders WHERE user_id = :id");
            $prep->execute([":id" => $id]);

            while ($row = $prep->fetch(PDO::FETCH_ASSOC)) {
                $adults = $row["adults"];
                $children = $row["children"];
                $breakfast = $row["breakfast"] == 1 ? "Tak" : "Nie";
                $launch = $row["launch"] == 1 ? "Tak" : "Nie";
                $dinner = $row["dinner"] == 1 ? "Tak" : "Nie";
                $tokyo = $row["tokyo"] == 1 ? "Tak" : "Nie";
                $motosu = $row["motosu"] == 1 ? "Tak" : "Nie";
                $harder = $row["harder"] == 1 ? "Tak" : "Nie";

                $price = $adults * 1350 + $children * 1000 + // bilety
                    ($row["breakfast"] == 1 ? (100 * $adults + 50 * $children) : 0) + // śniadania
                    ($row["launch"] == 1 ? (150 * $adults + 75 * $children) : 0) + // obiady
                    ($row["dinner"] ? (100 * $adults + 50 * $children) : 0) + // kolacje
                    ($row["motosu"] == 1 ? (25 * $adults + 25 * $children) : 0) + // pobyt nad jeziorem
                    ($row["tokyo"] == 1 ? 100 : 0) + // czas w Tokio
                    ($row["harder"] == 1 ? (8000 * $adults) : 0); // wejście ze specjalistami

                echo "<p class='border'>Dorośli: $adults<br>Dzieci: $children<br><br>Śniadania: $breakfast<br>Obiady: $launch<br>Kolacje: $dinner<br><br>Dodatkowy czas na zakupy w Tokio: $tokyo<br>Pobyt nad jeziorem Motosu: $motosu<br>Wejście od stromej strony Fudżi (ze specjalistami, bez dzieci): $harder<br><br><b class='price'>Razem: {$price}PLN</b><br><br><a style='font-size: 20px' class='lower-link' href='resign.php?id={$row["id"]}'>Zrezygnuj</a></p>";
            }
        }
        ?>
    </div>

    <!-- Przejście do konfiguratora -->
    <?php include "./components/config-link.php" ?>

    <!-- Informacja o płatności -->
    <?php include "./components/payment.php" ?>

    <!-- Lokalizacja biura -->
    <?php include "./components/location.php" ?>

    <!-- Kontakt -->
    <?php include "./components/contact.php" ?>

    <!-- Galeria -->
    <?php include "./components/galery.php" ?>

    <?php include "./components/footer.php" ?>
</body>

</html>