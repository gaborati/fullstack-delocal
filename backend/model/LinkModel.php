<?php

require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/security/tokenHandler.php';

class LinkModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addLink(): array
    {

        $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
        $decoded_token = tokenHandler::decode($token, "Secret_key");
        $user_email = $decoded_token['email'];


        $input_data = json_decode(file_get_contents("php://input"), true);
        if (!isset($input_data['url']) || !isset($input_data['imageUrl']) || !isset($input_data['description']) || !isset($input_data['title'])) {
            return array("message" => "Missing data");
        }

        $sql_user_id = "SELECT id FROM users WHERE email = ?";
        $stmt_user_id = $this->conn->prepare($sql_user_id);
        $stmt_user_id->bind_param("s", $user_email);
        $stmt_user_id->execute();
        $result_user_id = $stmt_user_id->get_result();


        if ($result_user_id->num_rows > 0) {
            $user_id_row = $result_user_id->fetch_assoc();
            $user_id = $user_id_row['id'];


            $url = $input_data['url'];
            $imageUrl = $input_data['imageUrl'];
            $description = $input_data['description'];
            $title = $input_data['title'];

            $sql_insert_link = "INSERT INTO links (user_id, url, image_url, description, title) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert_link = $this->conn->prepare($sql_insert_link);
            $stmt_insert_link->bind_param("issss", $user_id, $url, $imageUrl, $description, $title);
            $stmt_insert_link->execute();


            if ($stmt_insert_link->affected_rows > 0) {
                return array("message" => "Link added successfully");
            } else {
                return array("message" => "Failed to add link to database");
            }

            $stmt_insert_link->close();
        } else {
            return array("message" => "Failed to get user ID from database");
        }

        $stmt_user_id->close();

        return array("message" => "An error occurred");
    }
}

?>


