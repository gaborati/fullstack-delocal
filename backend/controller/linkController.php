<?php
// addLink.php

global $conn;
require_once '../database/config.php';
require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/security/tokenHandler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_AUTHORIZATION'])) {
    $input_data = json_decode(file_get_contents("php://input"), true);


    $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);



        $decoded_token = tokenHandler::decode($token);

    $user_email = $decoded_token['email'];


    error_log("User email: " . $user_email);
    echo "User email: " . $user_email;


    if (isset($input_data['url']) && isset($input_data['imageUrl']) && isset($input_data['description']) && isset($input_data['title'])) {
        $url = $input_data['url'];
        $imageUrl = $input_data['imageUrl'];
        $description = $input_data['description'];
        $title = $input_data['title'];


        $sql_user_id = "SELECT id FROM users WHERE email = ?";
        $stmt_user_id = $conn->prepare($sql_user_id);
        $stmt_user_id->bind_param("s", $user_email);
        $stmt_user_id->execute();
        $result_user_id = $stmt_user_id->get_result();


        if ($result_user_id->num_rows > 0) {
            $user_id_row = $result_user_id->fetch_assoc();
            $user_id = $user_id_row['id'];
            echo("User ID: " . $user_id);

            $sql_insert_link = "INSERT INTO links (user_id, url, image_url, description, title) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert_link = $conn->prepare($sql_insert_link);
            $stmt_insert_link->bind_param("issss", $user_id, $url, $imageUrl, $description, $title);
            $stmt_insert_link->execute();


            if ($stmt_insert_link->affected_rows > 0) {
                http_response_code(201); // Az erőforrás sikeres létrehozása
                echo json_encode(array("message" => "Link added successfully"));
            } else {
                http_response_code(500); // Belső szerverhiba
                echo json_encode(array("message" => "Failed to add link to database"));
            }

            $stmt_insert_link->close();
        } else {
            http_response_code(500); // Belső szerverhiba
            echo json_encode(array("message" => "Failed to get user ID from database"));
        }

        $stmt_user_id->close();
    } else {
        http_response_code(400); // Hibás kérés
        echo json_encode(array("message" => "Missing data"));
    }
} else {
    http_response_code(401); // Azonosítás hiánya vagy hibás token
    echo json_encode(array("message" => "Unauthorized"));
}
?>