<?php
session_start();
if (!isset($_POST["submit"]) || !isset($_SESSION["login"]))
    header("Location: index.php");
else {
    $pdo = new PDO("mysql:host=localhost;dbname=fuji;charset=utf8", "root");
    $res = $pdo->query("SELECT * FROM users WHERE login = '{$_SESSION["login"]}'");

    $data = $res->fetch();

    $id = $data["id"];
    $adults = isset($_POST["adults"]) ? $_POST["adults"] : 1;
    $children = isset($_POST["children"]) ? $_POST["children"] : 0;
    $breakfast = isset($_POST["breakfasts"]) ? 1 : 0;
    $launch = isset($_POST["launches"]) ? 1 : 0;
    $dinner = isset($_POST["dinners"]) ? 1 : 0;
    $tokyo = isset($_POST["tokyo"]) ? 1 : 0;
    $motosu = isset($_POST["lake"]) ? 1 : 0;
    $harder = isset($_POST["harder"]) ? 1 : 0;

    $prep = $pdo->prepare("INSERT INTO orders (user_id, adults, children, breakfast, launch, dinner, tokyo, motosu, harder) VALUES (:user_id, :adults, :children, :breakfast, :launch, :dinner, :tokyo, :motosu, :harder)");
    $prep->execute([":user_id" => $id, "adults" => $adults, "children" => $children, "breakfast" => $breakfast, "launch" => $launch, "dinner" => $dinner, "tokyo" => $tokyo, "motosu" => $motosu, "harder" => $harder]);

    header("Location: user_panel.php#reserved");
}
