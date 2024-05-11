<?php
require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/security/tokenHandler.php';

class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($email, $password): array
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password_hash);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            $tokenHandler = new tokenHandler();
            $payload = array("user_id" => $user_id, "email" => $email);
            $jwt = $tokenHandler::encode($payload);
            return array("message" => "Successful registration and login.", "jwt" => $jwt);
        } else {
            return array("message" => "Error during registration");
        }

        $stmt->close();
    }



}

?>

