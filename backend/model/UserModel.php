<?php
	require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/service/UserService.php';
	require_once '../Env.php';
	
	class UserModel {
		private $userService;
		
		public function __construct($conn) {
			$this->userService = new UserService($conn);
		}
		
		public function registerUser($email, $password): array {
			return $this->userService->registerUser($email, $password);
		}
		
		public function loginUser($email, $password): array {
			return $this->userService->loginUser($email, $password);
		}
	}