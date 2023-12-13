<?php
// Povezivanje sa bazom podataka
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "football_balon";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Greska pri povezivanju sa bazom podataka: " . mysqli_connect_error());
}


?>