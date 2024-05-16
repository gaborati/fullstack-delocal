<?php
	require_once '../model/LinkModel.php';
	require_once '../Env.php';
	$env = new Env('../.env');
	session_start();
	header("Access-Control-Allow-Origin: http://localhost:63342");
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SERVER['HTTP_AUTHORIZATION'])) {
		//Authenticate
		$token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
		$decoded_token = tokenHandler::decode($token, $env->get('SECRET_KEY'));
		if (!isset($decoded_token['email'])) {
			echo json_encode(array("message" => "Authentication failed"));
			exit;
		}
		
		
		$conn = new mysqli($env->get('DB_SERVERNAME'), $env->get('DB_USERNAME'), $env->get('DB_PASSWORD'), $env->get('DB_DATABASE'));
		$linkModel = new LinkModel($conn);
		$response = $linkModel->getUserInfo($decoded_token['email']);
		echo json_encode($response);
	}