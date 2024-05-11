<?php

require_once '../model/LinkModel.php';

session_start();
include_once '../database/config.php';
global $conn;

header("Access-Control-Allow-Origin: http://localhost:63342");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_AUTHORIZATION'])) {
    $linkModel = new LinkModel($conn);
    $response = $linkModel->addLink();
    echo json_encode($response);
} else {
    http_response_code(401);
    echo json_encode(array("message" => "Unauthorized"));
}

?>