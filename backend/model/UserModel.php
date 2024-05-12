<?php
	require_once '../service/UserService.php';
	require_once '../Env.php';
	
	class UserModel {
		private $userService;
		
		public function __construct($conn) {
			$this->userService = new UserService($conn);
		}
		
		public function saveUser($email, $password): array {
			return $this->userService->registerUser($email, $password);
		}
		
		public function signInUser($email, $password): array {
			return $this->userService->loginUser($email, $password);
		}
	}