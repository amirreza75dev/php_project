<?php
require_once('../model/database_connect.php');
session_start();
$user_id = $_SESSION['user']['id'];

$messageModel = new message($pdo);

$usermodel =new UserModel($pdo);

$partners = $messageModel->chat_partners($user_id);


if(empty($partners)){


   
    
    $html = '<div id="" class="chats_list">

<p>you dont have any chats</p>


</div>';




echo $html;
}else{

    $html = '<div id="" class="chats_list">';

    foreach ($partners as $partner) {
        $partner_id = $partner['chat_partner_id'];
        if($partner_id==$user_id){
            continue;
        }else{
            
            $user_information = $usermodel->get_contact($partner_id);
    
            
            $html.= '<div info="'.$user_information['0']['id'].'" class="chat_list_item" style="text-align:center;">
                    <p>your messages with :<span> '.$user_information['0']['username'].' </span> </p>
                    <img src= "'.$user_information['0']['image'].'" style="margin-left:10px;" class="person_img">
                
                
                
                </div>';
    

        }



    }


    $html.='</div>';


    
    
    
    echo $html;




}
?>