<?php
	require_once '../model/LinkModel.php';
	require_once '../Env.php';
	$env = new Env('../.env');
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_AUTHORIZATION'])) {
		$conn = new mysqli($env->get('DB_SERVERNAME'), $env->get('DB_USERNAME'), $env->get('DB_PASSWORD'), $env->get('DB_DATABASE'));
		$linkModel = new LinkModel($conn);
		$input_data = json_decode(file_get_contents("php://input"), true);
		$response = $linkModel->removeLink($input_data['linkId']);
		echo json_encode($response);
	}