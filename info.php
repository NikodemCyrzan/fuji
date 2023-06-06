<?php
session_start();
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

    <!-- O nas -->
    <?php include "./components/about.php" ?>

    <!-- Informacja o płatności -->
    <?php include "./components/payment.php" ?>

    <!-- Lokalizacja biura -->
    <?php include "./components/location.php" ?>

    <!-- Kontakt -->
    <?php include "./components/contact.php" ?>

    <?php include "./components/footer.php" ?>
</body>

</html>