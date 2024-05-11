<?php


global $servername, $username, $password, $database;
require_once 'config.php';


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_create_table = "CREATE TABLE links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    url VARCHAR(255),
    image_url VARCHAR(255),
    description TEXT,
    title VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Links table successfully created";
} else {
    echo "Error: " . $conn->error;
}


$conn->close();
