<?php
require_once('../model/database_connect.php');


session_start();
$user_id = $_SESSION['user']['id'];
// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into an object
$data = json_decode($jsonData,true);


$data_to_table = array('sender_id'=> $user_id,'receiver_id'=> $data['receiver_id']);


//inser message in database
$messageModel = new message($pdo);

$message_array = $messageModel->get_message($data_to_table['sender_id'],$data_to_table['receiver_id']);

// getting sender and receiver information
$usermodel = new UserModel($pdo);

$sender_information = $usermodel->get_contact($user_id);
$receiver_information = $usermodel->get_contact($data['receiver_id']);

// Get the profile image URLs for sender and receiver
$sender_image_url = $sender_information[0]['image'];
$receiver_image_url = $receiver_information[0]['image'];


//showing chats

if(empty($message_array)){


   
    
    $html = '<div id="chats_with_person" class="">

please send the first message


</div>
<div class="send_chat">
<input id="send_btn" type="button" value="send_chat">
<input id="text_area" type="text" name="chat_text" placeholder="enter your message">


</div>';




echo $html;
}else{

    $html = '<div id="chats_with_person" class="">';

    foreach ($message_array as $message) {
        $message_text = $message['message'];
        $sender_id = $message['sender_id'];
        $receiver_id = $message['receiver_id'];


        if($sender_id == $user_id){
            $html.= '    <div id="sender_chat">
            <img src="'.$sender_image_url.'" />
            <p>'.$message_text.'</p>
            </div>';



        }else{

            $html.='<div id="reciver_chat">
            <img src="'.$receiver_image_url.'" />
            <p>'.$message_text.'</p>
            </div>';
        }


    }


    $html.='</div>


    <div class="send_chat">
    <input id="send_btn" type="button" value="send_chat">
    <input id="text_area" type="text" name="chat_text" placeholder="enter your message">
    
    
    </div>';


    
    
    
    echo $html;




}


?>

