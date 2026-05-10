<?php
session_start();

require_once "../klases/duombaze.php";
require_once "../klases/sifravimas.php";



if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$db = new Duombaze();
$conn = $db->jungtis();

$sifravimas = new Sifravimas();

$user_id = $_SESSION["user_id"];
$raktas = $_SESSION["raktas"];

if (isset($_POST["saugoti"])) {
    $pavadinimas = $_POST["pavadinimas"];
    $slaptazodis = $_POST["slaptazodis"];

    $uzkoduotas = $sifravimas->sifruoti($slaptazodis, $raktas);

    $sql = "INSERT INTO passwords (user_id, title, encrypted_password)
            VALUES ('$user_id', '$pavadinimas', '$uzkoduotas')";

    if ($conn->query($sql)) {
        echo "Slaptazodis issaugotas!<br><br>";
    } else {
        echo "Klaida!";
    }
}

$rez = $conn->query("SELECT * FROM passwords WHERE user_id='$user_id' ORDER BY id DESC");
?>

<h2>Slaptazodziu saugojimas</h2>

<form method="POST">
    <input type="text" name="pavadinimas" placeholder="Pvz Gmail"><br><br>
    <input type="text" name="slaptazodis" placeholder="Slaptazodis"><br><br>
    <button name="saugoti">Saugoti</button>
</form>

<h2>Issaugoti slaptazodziai</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Pavadinimas</th>
        <th>Slaptazodis</th>
        <th>Data</th>
    </tr>

    <?php while ($row = $rez->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["title"]; ?></td>
            <td><?php echo $sifravimas->desifruoti($row["encrypted_password"], $raktas); ?></td>
            <td><?php echo $row["created_at"]; ?></td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="dashboard.php">Atgal</a>