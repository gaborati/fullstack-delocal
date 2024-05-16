
<?php
/*
	namespace App\Controller;
	
	require_once '../model/LinkModel.php';
	require_once '../Env.php';
	
	use Env;
	use tokenHandler;
	
	class LinkController {
		private $conn;
		
		public function __construct()
		{
			$env = new Env('../.env');
			$this->conn = new \mysqli(
				$env->get('DB_SERVERNAME'),
				$env->get('DB_USERNAME'),
				$env->get('DB_PASSWORD'),
				$env->get('DB_DATABASE')
			);
		}
		
		
		public function addLink() {
			$token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
			$decoded_token = tokenHandler::decode($token, $this->model->getEnv()->get('SECRET_KEY'));
			$user_email = $decoded_token['email'];
			$input_data = json_decode(file_get_contents("php://input"), true);
			
			if (!isset($input_data['url']) || !isset($input_data['imageUrl']) || !isset($input_data['description']) || !isset($input_data['title'])) {
				return json_encode(array("message" => "Missing data"));
			}
			
			$userId = $this->model->getUserIdByEmail($user_email);
			if ($userId) {
				$result = $this->model->addLink($userId, $input_data['url'], $input_data['imageUrl'], $input_data['description'], $input_data['title']);
				return json_encode(array("message" => $result['message']));
			} else {
				return json_encode(array("message" => "Failed to get user ID from database"));
			}
		}
		
		
		public function deleteLink($linkId) {
			$sql_delete_link = "DELETE FROM links WHERE id = ?";
			$stmt_delete_link = $this->conn->prepare($sql_delete_link);
			$stmt_delete_link->bind_param("i", $linkId);
			$stmt_delete_link->execute();
			
			if ($stmt_delete_link->affected_rows > 0) {
				return json_encode(array("message" => "Link deleted successfully"));
			} else {
				return json_encode(array("message" => "Failed to delete link from database"));
			}
			
			$stmt_delete_link->close();
		}
		
		
		}