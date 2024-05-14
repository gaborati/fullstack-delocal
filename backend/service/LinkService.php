<?php

require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/security/tokenHandler.php';

class LinkService {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addLink(): array
    {
        $env = new Env('../.env');
        $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
        $decoded_token = tokenHandler::decode($token,$env->get('SECRET_KEY')) ;
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
    
    
    
    
    public function getUserLinks(): array
    {
        $env = new Env('../.env');
        $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
        $decoded_token = tokenHandler::decode($token, $env->get('SECRET_KEY'));
        $user_email = $decoded_token['email'];
        $sql_get_user_links = "SELECT * FROM links WHERE user_id IN (SELECT id FROM users WHERE email = ?)";
        $stmt_get_user_links = $this->conn->prepare($sql_get_user_links);
        $stmt_get_user_links->bind_param("s", $user_email);
        $stmt_get_user_links->execute();
        $result_get_user_links = $stmt_get_user_links->get_result();
        
        $links = [];
        while ($row = $result_get_user_links->fetch_assoc()) {
            $links[] = $row;
        }
        
        return array("message" => "User links retrieved successfully", "links" => $links);
    }
    
    
    public function deleteLink($linkId): array
    {
        $sql_delete_link = "DELETE FROM links WHERE id = ?";
        $stmt_delete_link = $this->conn->prepare($sql_delete_link);
        $stmt_delete_link->bind_param("i", $linkId);
        $stmt_delete_link->execute();
        
        if ($stmt_delete_link->affected_rows > 0) {
            return array("message" => "Link deleted successfully");
        } else {
            return array("message" => "Failed to delete link from database");
        }
        
        $stmt_delete_link->close();
    }
    
    
    public function searchLinks($keyword) {
        $env = new Env('../.env');
        $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
        $decoded_token = tokenHandler::decode($token, $env->get('SECRET_KEY'));
        $user_email = $decoded_token['email'];
        
        $sql = "SELECT * FROM links WHERE user_id = (SELECT id FROM users WHERE email = ?) AND (title LIKE '%$keyword%' OR description LIKE '%$keyword%')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $links = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $links[] = $row;
            }
        }
        
        return $links;
    }
    
    
}

?>


