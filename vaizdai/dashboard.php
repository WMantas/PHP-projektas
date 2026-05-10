<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Sveikas, <?php echo $_SESSION["username"]; ?>!</h2>

<a href="slaptazodziai.php">Slaptazodziu saugojimas</a><br>
<a href="logout.php">Atsijungti</a>