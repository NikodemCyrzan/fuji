<?php
session_start();

if (!isset($_SESSION["login"]))
    header("Location: login.php?p=c")
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">
</head>

<body style="overflow-y: hidden;padding-bottom: 0">
    <?php include "./components/navbar.php" ?>

    <div class="configurator__background-wrapper"></div>

    <script>
        function UpdatePrices() {
            adultsPrice.innerText = `${adults.value * 1350}PLN`;
            childrenPrice.innerText = `${children.value * 1000}PLN`;
            breakfastsPrice.innerText = `${breakfasts.checked ? (100 * adults.value + 50 * children.value) : 0}PLN`;
            lunchesPrice.innerText = `${lunches.checked ? (150 * adults.value + 75 * children.value) : 0}PLN`;
            dinnersPrice.innerText = `${dinners.checked ? (100 * adults.value + 50 * children.value) : 0}PLN`;
            lakePrice.innerText = `${lake.checked ? (25 * adults.value + 25 * children.value) : 0}PLN`;
            harderPrice.innerText = `${harder.checked ? (8000 * adults.value) : 0}PLN`;
            tokyoPrice.innerText = `${tokyo.checked ? 100 : 0}PLN`;

            Sum();
        }
    </script>
    <div class="configurator__panel-wrapper">
        <form action="order.php" method="post">
            <?php
            $elements = [["type" => "header", "text" => "Bilety"], ["type" => "input", "inputType" => "number", "min" => 1, "value" => 1, "name" => "adults", "text" => "Dorośli:", "defaultPrice" => 1350], ["type" => "input", "inputType" => "number", "min" => 0, "value" => 0, "name" => "children", "text" => "Dzieci:"], ["type" => "header", "text" => "Wyżywienie"], ["type" => "input", "inputType" => "checkbox", "name" => "breakfasts", "text" => "Śniadania"], ["type" => "input", "inputType" => "checkbox", "name" => "lunches", "text" => "Obiady"], ["type" => "input", "inputType" => "checkbox", "name" => "dinners", "text" => "Kolacje"], ["type" => "header", "text" => "Dodatki"], ["type" => "input", "inputType" => "checkbox", "name" => "tokyo", "text" => "Dodatkowy czas na zakupy w Tokio"], ["type" => "input", "inputType" => "checkbox", "name" => "lake", "text" => "Pobyt nad jeziorem Motosu"], ["type" => "input", "inputType" => "checkbox", "name" => "harder", "text" => "Wejście od stromej strony Fudżi (ze specjalistami, bez dzieci)"]];

            include "./components/configurator.php";
            ?>

            <!-- Panel sumy -->
            <div class="sum-panel">
                <b id="sum" class="price">Razem: 350PLN</b>
                <input type="submit" name="submit" value="Zamów">
            </div>
            <script>
                const sum = document.getElementById("sum");
                Sum();

                function Sum() {
                    let s = adults.value * 1350 + children.value * 1000 + // bilety
                        (breakfasts.checked ? (100 * adults.value + 50 * children.value) : 0) + // śniadania
                        (lunches.checked ? (150 * adults.value + 75 * children.value) : 0) + // obiady
                        (dinners.checked ? (100 * adults.value + 50 * children.value) : 0) + // kolacje
                        (lake.checked ? (25 * adults.value + 25 * children.value) : 0) + // pobyt nad jeziorem
                        (tokyo.checked ? 100 : 0) + // czas w Tokio
                        (harder.checked ? (8000 * adults.value) : 0); // wejście ze specjalistami
                    sum.innerText = `Razem: ${s}PLN`;
                }
            </script>
        </form>
    </div>
</body>

</html>