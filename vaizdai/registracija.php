<?php

require_once "../klases/duombaze.php";
require_once "../klases/vartotojas.php";

$db = new Duombaze();
$conn = $db->jungtis();

$vartotojas = new Vartotojas($conn);

if (isset($_POST["registruoti"])) {

    $vardas = $_POST["vardas"];
    $slaptazodis = $_POST["slaptazodis"];

    if ($vartotojas->registruoti($vardas, $slaptazodis)) {
        echo "Sekmingai uzregistruota!";
    } else {
        echo "Klaida!";
    }
}
?>

<h2>Registracija</h2>

<form method="POST">
    <input type="text" name="vardas" placeholder="Vardas"><br><br>
    <input type="password" name="slaptazodis" placeholder="Slaptazodis"><br><br>
    <button name="registruoti">Registruotis</button>
</form>
<a href="../index.php">Atgal</a>