<?php
	/*
	
	namespace App\Controller;
	
	use App\Model\UserModel;
	use App\Env;
	
	class UserController {
		private $conn;
		
		public function __construct() {
			$env = new Env('../.env');
			$this->conn = new \mysqli(
				$env->get('DB_SERVERNAME'),
				$env->get('DB_USERNAME'),
				$env->get('DB_PASSWORD'),
				$env->get('DB_DATABASE')
			);
		}
		
		public function loginUser() {
			// Token Validation
			$env = new Env('../.env');
			$token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
			$decodedToken = tokenHandler::decode($token, $env->get('SECRET_KEY'));
			
			// If the token is valid, get the email from the token
			if (isset($decodedToken['email'])) {
				$userModel = new UserModel($this->conn);
				return $userModel->signInUser($decodedToken['email'], null); // password is not necessary when we use jwt auth
			} else {
				return array('success' => false, 'message' => 'Authentication failed');
			}
		}
	}
?>
