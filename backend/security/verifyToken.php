<?php
	//started to implement the logic for the dynamic secret key
require_once '../security/tokenHandler.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jwtToken'])) {
    $jwtToken = $_POST['jwtToken'];
    try {

        $decodedToken = tokenHandler::decode($jwtToken, "secret_key");
        http_response_code(200);
        echo json_encode(array("message" => "Token is valid."));
    } catch (Exception $e) {

        http_response_code(401);
        echo json_encode(array("message" => "Token is invalid."));
    }
} else {

    http_response_code(400);
    echo json_encode(array("message" => "Bad request."));
}

?>