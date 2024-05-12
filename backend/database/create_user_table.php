<?php
 require_once '../Env.php';
 $env = new Env('../.env');
$conn = new mysqli($env->get('DB_SERVERNAME') , $env->get('DB_USERNAME'),$env->get('DB_PASSWORD') ,$env->get('DB_DATABASE'));

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql_create_table = "CREATE TABLE IF NOT EXISTS users (
   id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "User table successfully created";
} else {
    echo "Error: " . $conn->error;
}


$conn->close();
?>
