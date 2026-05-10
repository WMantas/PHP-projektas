<?php

require_once "sifravimas.php";

class Vartotojas {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registruoti($vardas, $slaptazodis) {

        $hash = password_hash($slaptazodis, PASSWORD_DEFAULT);

        $raktas = bin2hex(random_bytes(16));

        $sifravimas = new Sifravimas();
        $uzkoduotas_raktas = $sifravimas->sifruoti($raktas, $slaptazodis);

        $sql = "INSERT INTO users (username, password_hash, encrypted_key)
                VALUES ('$vardas', '$hash', '$uzkoduotas_raktas')";

        return $this->conn->query($sql);
    }

    public function prisijungti($vardas, $slaptazodis) {

        $sql = "SELECT * FROM users WHERE username='$vardas'";
        $rez = $this->conn->query($sql);

        if ($rez->num_rows > 0) {
            $user = $rez->fetch_assoc();

            if (password_verify($slaptazodis, $user["password_hash"])) {

                $sifravimas = new Sifravimas();
                $raktas = $sifravimas->desifruoti($user["encrypted_key"], $slaptazodis);

                $user["raktas"] = $raktas;

                return $user;
            }
        }

        return false;
    }
}