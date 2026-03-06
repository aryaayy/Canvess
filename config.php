<?php
    require_once __DIR__ . '/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    $HOST = $_ENV["HOST"];
    $USER = $_ENV["USER"];
    $PASS = $_ENV["PASS"];
    $DB = $_ENV["DB"];
    
    $conn = mysqli_connect($HOST, $USER, $PASS, $DB);

    if(!$conn){
        die ("Koneksi dengan database gagal: ".mysqli_connect_error());
    }
?>