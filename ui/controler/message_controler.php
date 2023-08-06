<?php
require_once('../model/database_connect.php');

$errors = [];

session_start();
$user_id = $_SESSION['user']['id'];
// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into an object
$data = json_decode($jsonData,true);

$information = array('sender_id'=> $user_id,'receiver_data'=> $data);

$data_to_table = array('sender_id'=> $user_id,'receiver_id'=> $data['receiver_id'], 'message'=>$data['message']);


//inser message in database
$messageModel = new message($pdo);

$messageModel->CreateMessage($data_to_table);

