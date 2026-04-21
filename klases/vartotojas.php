<?php

class Vartotojas {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registruoti($vardas, $slaptazodis) {

        $hash = password_hash($slaptazodis, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password_hash)
                VALUES ('$vardas', '$hash')";

        return $this->conn->query($sql);
    }
}