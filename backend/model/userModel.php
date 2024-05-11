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

    public function loginUser($email, $password): array
    {
        $sql = "SELECT email, password FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $payload = array(
                    "email" => $user['email']
                );
                $jwt = tokenHandler::encode($payload, "secret_key");
                return array("message" => "Successful login.", "jwt" => $jwt);
            } else {
                http_response_code(401);
                return array("message" => "Incorrect email or password");
            }
        } else {
            http_response_code(401);
            return array("message" => "Incorrect email or password");
        }
    }




}

?>

