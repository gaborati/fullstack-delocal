<?php
	/*
	use App\Controller\LinkController;
	
	require_once 'controller/LinkController.php';
	
	$controller = new LinkController();
	
	$requestMethod = $_SERVER['REQUEST_METHOD'];
	$requestUri = $_SERVER['REQUEST_URI'];
	
	switch ($requestMethod) {
		case 'POST':
			if (preg_match('/\/add-link$/', $requestUri)) {
				echo $controller->addLink();
			} else {
				echo json_encode(array("message" => "Invalid endpoint for POST method"));
			}
			break;
		
		case 'GET':
			if (preg_match('/\/user-links$/', $requestUri)) {
				echo $controller->getUserLinks();
			} elseif (preg_match('/\/search-links$/', $requestUri)) {
				$keyword = $_GET['keyword'] ?? '';
				echo $controller->searchLinks($keyword);
			} else {
				echo json_encode(array("message" => "Invalid endpoint for GET method"));
			}
			break;
		
		case 'DELETE':
			if (preg_match('/\/delete-link\/(\d+)$/', $requestUri, $matches)) {
				$linkId = $matches[1];
				echo $controller->deleteLink($linkId);
			} else {
				echo json_encode(array("message" => "Invalid endpoint for DELETE method"));
			}
			break;
		
		default:
			echo json_encode(array("message" => "Invalid request method"));
			break;
	}
?>
