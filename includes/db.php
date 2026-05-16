<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "car_rental";
$port = 3308;

$conn = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>