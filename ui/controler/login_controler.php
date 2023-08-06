<?php
session_start();
require_once('../model/database_connect.php');

$errors = [];

$userModel = new UserModel($pdo);

// get data from json
// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into an object
$data = json_decode($jsonData);

// Check if the JSON data was decoded successfully
if (json_last_error() !== JSON_ERROR_NONE) {
    // JSON data could not be decoded, so display an error message or redirect to an error page
    echo "Error: JSON data could not be decoded";
    exit;
}

// Get the value of the email input
$email = $data->email_value;

if(empty($email)){
    $errors[]= "please write your email";
}

// Check if the input contains special characters
if ($email !== htmlspecialchars($email, ENT_QUOTES)) {
    // Input contains special characters
    $errors[]= "contains special characters";
} else {


    $user = $userModel->LoginUser($email);
    
    if($user){
        $responseData = array("success" => true,
                            'users' => $user
    
    );
        $_SESSION['user'] = $user;
        echo json_encode($responseData);
        
    }else{
        $errors[] = "email does not exist";  
        $responseData = array(
            "success" => false,
            "errors" => $errors
        ); 
        echo json_encode($responseData);

    }




}

