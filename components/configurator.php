<?php
foreach ($elements as $element) {
    if ($element["type"] == "header")
        echo "<div class='configurator__header'>{$element["text"]}</div>";
    else if ($element["type"] == "input") {
        echo "<div class='configurator__input'>";
        if ($element["inputType"] == "checkbox") {
            echo "<span><input type='checkbox' name='{$element["name"]}' id='{$element["name"]}'> " . (isset($element["text"]) ? $element["text"] : "") . "</span>";
        } else
            echo (isset($element["text"]) ? $element["text"] : "") . "<input type='{$element["inputType"]}' name='{$element["name"]}' " . (isset($element["min"]) ? "min='{$element["min"]}'" : "") . " " . (isset($element["value"]) ? "value='{$element["value"]}'" : "") . " id='{$element["name"]}'>";

        echo "<div id='{$element["name"]}-price' class='price'>" . (isset($element["defaultPrice"]) ? $element["defaultPrice"] : 0) . "PLN</div><script>const {$element["name"]} = document.getElementById('{$element["name"]}'),{$element["name"]}Price = document.getElementById('{$element["name"]}-price');{$element["name"]}.addEventListener('change', UpdatePrices)</script></div>";
    }
}
