<?php
$host = "sql12.freesqldatabase.com";
$user = "sql12774483";
$pass = "fVjC6MAcCg";
$db   = "sql12774483";
// <?php
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db   = "absensiqrcode";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
