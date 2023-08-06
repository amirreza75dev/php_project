<?php

sleep(1);
session_start();
$user_id = $_SESSION['user']['id'];

require_once('../model/database_connect.php');

$userModel = new UserModel($pdo);

$response = $userModel->get_contacts($user_id);

if(!empty($_SESSION['user'])){

// set the response content type to JSON
header('Content-Type: application/json');

// send the response as JSON
echo json_encode($response);




}else{

header('Content-Type: application/json');
$response = array('message' => "please log in");
// send the response as JSON
echo json_encode($response);

}


