<?php

class Duombaze {

    public function jungtis() {
        $conn = new mysqli("localhost", "root", "", "password_manager");

        if ($conn->connect_error) {
            die("Klaida su DB: " . $conn->connect_error);
        }

        return $conn;
    }
}