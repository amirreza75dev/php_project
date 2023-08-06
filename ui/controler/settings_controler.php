<?php

// sleep(1);
session_start();
require_once('../model/database_connect.php');
$user_id = $_SESSION['user']['id'];


$userModel = new UserModel($pdo);
// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into an object
$data = json_decode($jsonData,true);



$response = $userModel-> UpdateUser($user_id, $data);

$updated_user = $userModel->LoginUser($user_id);
$_SESSION['user'] = $updated_user;
$updated_session = array("session"=>$_SESSION['user'],"response"=>$response);

header('Content-Type: application/json');
// send the response as JSON

echo json_encode($updated_session);


