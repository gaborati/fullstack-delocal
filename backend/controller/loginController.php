<?php

require_once '../model/userModel.php';

session_start();
include_once '../database/config.php';
global $conn;

header("Access-Control-Allow-Origin: http://localhost:63342");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel($conn);
    $input_data = json_decode(file_get_contents("php://input"), true);
    $response = $userModel->loginUser($input_data['email'], $input_data['password']);
    echo json_encode($response);
}
?>