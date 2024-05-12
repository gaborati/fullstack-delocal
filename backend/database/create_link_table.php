<?php
require_once '../Env.php';

$env = new Env('../.env');


$conn = new mysqli($env->get('DB_SERVERNAME') , $env->get('DB_USERNAME'),$env->get('DB_PASSWORD') ,$env->get('DB_DATABASE'));



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
