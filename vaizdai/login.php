<?php
session_start();

require_once "../klases/duombaze.php";
require_once "../klases/vartotojas.php";

$db = new Duombaze();
$conn = $db->jungtis();

$vartotojas = new Vartotojas($conn);

if (isset($_POST["login"])) {
    $vardas = $_POST["vardas"];
    $slaptazodis = $_POST["slaptazodis"];

    $user = $vartotojas->prisijungti($vardas, $slaptazodis);

    if ($user) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["raktas"] = $user["raktas"];

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Blogi prisijungimo duomenys!";
    }
}
?>

<h2>Prisijungimas</h2>

<form method="POST">
    <input type="text" name="vardas" placeholder="Vardas"><br><br>
    <input type="password" name="slaptazodis" placeholder="Slaptazodis"><br><br>
    <button name="login">Prisijungti</button>
</form>

<br>
<a href="../index.php">Atgal</a>