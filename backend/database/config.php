<?php
$servername = "localhost";
$username = "root";
$password = "De78b427?";
$database = "delocalprob";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>