<div class="content-wrapper">
    <p>
        Weź udział w wycieczce z przewodnikiem na sam szczyt góry Fudż i odkryj cudowne, niepowtarzalne widoki. Następna odbędzie sie na początku kolejnego miesiąca, czyli:
        <b>
            <?php
            $actual_time = time();
            $seconds_to_month_end = (date("t") - date("j") + 1) * 24 * 60 * 60;
            echo date("d.m.Y", $actual_time + $seconds_to_month_end);
            ?>
        </b>
    </p>
    <center>
        <a class="highlighted-link" style="font-size: 30px;" href="configurator.php">Zarezerwuj</a>
    </center>
</div>