<?php
    $conn = mysqli_connect('localhost', 'root', '', 'db_canvess');

    if(!$conn){
        die ("Koneksi dengan database gagal: ".mysql_connect_error());
    }
?>