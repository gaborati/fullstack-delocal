<?php
	require_once '../Env.php';
	$env = new Env('../.env');
	require_once '../model/UserModel.php';
	
	header("Access-Control-Allow-Origin: http://localhost:63342");
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$conn = new mysqli($env->get('DB_SERVERNAME'), $env->get('DB_USERNAME'), $env->get('DB_PASSWORD'), $env->get('DB_DATABASE'));
		$userModel = new UserModel($conn);
		$response = $userModel->saveUser($_POST['email'], $_POST['password']);
		echo json_encode($response);
	}
?>
