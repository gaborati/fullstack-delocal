<?php

global $conn;
require_once '/Users/gaborattila/PhpstormProjects/auth01delocal/backend/user/tokenHandler.php';
require_once '../database/config.php';
require_once '../model/userModel.php';

header("Access-Control-Allow-Origin: http://localhost:63342");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel($conn);
    $response = $userModel->registerUser($_POST['email'], $_POST['password']);
    echo json_encode($response);
}
?>
