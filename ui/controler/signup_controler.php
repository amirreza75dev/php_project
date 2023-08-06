<?php
require_once('../model/database_connect.php');

$errors = [];

$userModel = new UserModel($pdo);
unique($_POST['username'],$_POST['email'],$errors,$pdo);


if(empty($_POST['username'])){
    $errors[]= 'user  is required';
}if(empty($_POST['sex'])){
    $errors[]= 'sex  is required';
}if(empty($_POST['password'])){
    $errors[]= 'password  is required';
}if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors[]= 'email  is required';
}if(sizeof($errors) > 0){
     foreach($errors as $value){
        echo $value ." <br>";

    }
    echo "<h1> please fill the form correctly <h1>";
}else{
     
$data = ['username' => $_POST['username'],'sex'=> $_POST['sex'],'email' => $_POST['email'], 'password' => $_POST['password']];
$userModel->CreateUser($data);
header('location:../login.php');


}






// check unique username and email

function unique($username, $email, &$errors, $pdo) {
    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
    $stmt->execute(['username' => $username, 'email' => $email]);
    $user = $stmt->fetch();
    if ($user) {
        if ($user['username'] == $username) {
           $errors[] = 'Username is already taken';
           
        }
        if ($user['email'] == $email) {
            $errors[] = 'Email address is already in use';
            
        }
    }
    
}

