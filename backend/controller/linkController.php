<?php
	
	require_once '../model/LinkModel.php';
	require_once '../Env.php';
	
	$env = new Env('../.env');
	session_start();
	header("Access-Control-Allow-Origin: http://localhost:63342");


	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_AUTHORIZATION'])) {
		$conn = new mysqli($env->get('DB_SERVERNAME'), $env->get('DB_USERNAME'), $env->get('DB_PASSWORD'), $env->get('DB_DATABASE'));
		$linkModel = new LinkModel($conn);
		$response = $linkModel->addLink();
		echo json_encode($response);
	}

	elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SERVER['HTTP_AUTHORIZATION'])) {
		$conn = new mysqli($env->get('DB_SERVERNAME'), $env->get('DB_USERNAME'), $env->get('DB_PASSWORD'), $env->get('DB_DATABASE'));
		$linkModel = new LinkModel($conn);
		$response = $linkModel->getUserLinks();
		echo json_encode($response);
	}
	
	else {
		http_response_code(401);
		echo json_encode(array("message" => "Unauthorized"));
	}

?>