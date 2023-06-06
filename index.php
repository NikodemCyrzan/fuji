<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">
    <script defer src="./js/resizer.js"></script>
</head>

<body>
    <?php include "./components/navbar.php" ?>

    <!-- Paralaksa -->
    <div class="start-image__wrapper">
        <img class="start-image" src="./img/start-image.jpg" id="parallax">
        <div class="start-image__gradient--bottom"></div>
    </div>
    <script>
        const parallax = document.getElementById("parallax");
        window.addEventListener("scroll", () => {
            parallax.style.transform = `translateY(${window.pageYOffset * .5}px)`;
        });
    </script>

    <!-- Tekst wprowadzający -->
    <div class="content-wrapper">
        <h1>Fudżi</h1>
        <p>Najelegantszy wulkan na świecie!</p>
    </div>

    <!-- Tekst zachęcający -->
    <div class="content-wrapper">
        <h2 class="border">Ciekawostki</h2>
        <p>Stożek jest zbudowany z aż <b>trzech</b> mniejszych wulkanów umieszczonych jeden na drugim.</p>
        <p>Góra Fudżi jest największą górą w Japonii i ma <b>wysokość 3776 metrów</b>. Znajduje się <b>na czwartym miejscu</b> największych wulkanów na świecie.</p>
        <p>Wulkan jest nadal aktywny, chociaż ostatni wybuch miał miejsce w <b>1707 roku</b>, a eksperci nie przewidują kolejnego w najbliższym czasie.</p>
        <p>Przeciętny człowiek potrzebuje <b>od 4 do 8 godzin</b>, aby wejść na szczyt. Jeśli ktoś czuje się bezpieczniej na dole, może podziwiać górę z wielu punktów. W okolicy znajdują się również malownicze jeziora Motosu, Sai, Kawaguchi, Soji czy Yamanaka.</p>
    </div>

    <!-- Widok 3D -->
    <div class="content-wrapper">
        <h2 class="border">Fudżi w 3D</h2>
        <div class="sketchfab-embed-wrapper" id="canvas-wrapper">
            <iframe id="canvas-container" title="Mount Fuji" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share width="640" height="480" src="https://sketchfab.com/models/4c36873a056947c5ad340945077b4c9a/embed?autostart=1&camera=0&preload=1"> </iframe>
        </div>
    </div>

    <!-- Przejście do konfiguratora -->
    <div class="content-wrapper">
        <center>
            <h1 style="margin-bottom: 0;">Zarezerwuj już teraz!</h1>
        </center>
    </div>
    <?php include "./components/config-link.php" ?>

    <!-- Informacje -->
    <div class="content-wrapper">
        <h2 class="border">Informacje</h2>
        <p>
            <a href="info.php" class="highlighted-link">Przejdź do informacji</a>
        </p>
    </div>

    <?php include "./components/footer.php" ?>
</body>

</html>