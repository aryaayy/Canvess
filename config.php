<?php
    $conn = mysqli_connect('localhost', 'root', 'admin123', 'db_canvess');

    if(!$conn){
        die ("Koneksi dengan database gagal: ".mysql_connect_error());
    }
?>