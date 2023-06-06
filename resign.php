<?php
session_start();
if (!isset($_GET["id"]) || !isset($_SESSION["login"]))
    header("Location: user_panel.php");
else {
    $pdo = new PDO("mysql:host=localhost;dbname=fuji;charset=utf8", "root");
    $prep = $pdo->prepare("DELETE FROM orders WHERE id = :id");
    $prep->execute([":id" => $_GET["id"]]);

    header("Location: user_panel.php#reserved");
}
