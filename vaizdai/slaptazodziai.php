<?php

require_once "../klases/duombaze.php";

$db = new Duombaze();
$conn = $db->jungtis();

if (isset($_POST["saugoti"])) {
    $pavadinimas = $_POST["pavadinimas"];
    $slaptazodis = $_POST["slaptazodis"];

    $sql = "INSERT INTO passwords (title, password_text)
            VALUES ('$pavadinimas', '$slaptazodis')";

    if ($conn->query($sql)) {
        echo "Slaptazodis issaugotas!<br><br>";
    } else {
        echo "Klaida saugant!";
    }
}

$rez = $conn->query("SELECT * FROM passwords ORDER BY id DESC");

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
        <th>ID</th>
        <th>Pavadinimas</th>
        <th>Slaptazodis</th>
        <th>Data</th>
    </tr>

    <?php while ($row = $rez->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["title"]; ?></td>
            <td><?php echo $row["password_text"]; ?></td>
            <td><?php echo $row["created_at"]; ?></td>
        </tr>
    <?php } ?>
</table>

<br>

<a href="../index.php">Atgal</a>