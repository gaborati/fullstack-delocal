<?php
	require_once '../model/UserModel.php';
	
	require_once '../Env.php';
	$env = new Env('../.env');
	session_start();
	header("Access-Control-Allow-Origin: http://localhost:63342");
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$conn = new mysqli($env->get('DB_SERVERNAME'), $env->get('DB_USERNAME'), $env->get('DB_PASSWORD'), $env->get('DB_DATABASE'));
		$userModel = new UserModel($conn);
		$input_data = json_decode(file_get_contents("php://input"), true);
		$response = $userModel->loginUser($input_data['email'], $input_data['password']);
		echo json_encode($response);
	}
?>