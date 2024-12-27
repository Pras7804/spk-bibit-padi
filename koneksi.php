<?php
$koneksi = mysqli_connect("localhost", "root", "", "bibit_padi");

if (!$koneksi) {
    die("connection failed" . mysqli_connect_error());
}
