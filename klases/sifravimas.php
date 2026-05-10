<?php

class Sifravimas {

    private $metodas = "AES-256-CBC";

    public function sifruoti($tekstas, $raktas) {
        $iv = openssl_random_pseudo_bytes(16);
        $uzkoduota = openssl_encrypt($tekstas, $this->metodas, $raktas, 0, $iv);

        return base64_encode($iv . $uzkoduota);
    }

    public function desifruoti($tekstas, $raktas) {
        $duomenys = base64_decode($tekstas);

        $iv = substr($duomenys, 0, 16);
        $uzkoduota = substr($duomenys, 16);

        return openssl_decrypt($uzkoduota, $this->metodas, $raktas, 0, $iv);
    }
}