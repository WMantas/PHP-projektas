<?php
$slaptazodis = "";

if (isset($_POST["generuoti"])) {
    $ilgis = $_POST["ilgis"];

    $simboliai = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";

    for ($i = 0; $i < $ilgis; $i++) {
        $slaptazodis .= $simboliai[rand(0, strlen($simboliai) - 1)];
    }
}
?>

<h2>Slaptazodziu generatorius</h2>

<form method="POST">
    <input type="number" name="ilgis" value="8">
    <button name="generuoti">Generuoti</button>
</form>

<?php
if ($slaptazodis != "") {
    echo "<h3>Sugeneruotas slaptazodis:</h3>";
    echo "<input type='text' value='$slaptazodis' readonly>";
}
?>

<br><br>
<a href="../index.php">Atgal</a>