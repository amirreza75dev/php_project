<?php 
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if(!isset($_SESSION['user'])):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>My chat</title>
</head>
<body>

    <div class="wrapper">
        <div class="left-bar">
             <div class="categories">
             <div id="icon_radio_buttons">
                <label>
                    <input type="radio" name="icon_group" value="icon_chat">
                    <img id='chat_icon' src="icons/Chats-icon.png" alt="">
                   
                </label>
                <label>
                    <input type="radio" name="icon_group" value="icon_setting">
                    <img id="img_settings" src="icons/settings.png" alt="">
                    
                </label>
                <label>
                    <input type="radio" name="icon_group" value="icon_contact">
                    <img id="contacts" src="icons/contacts.png" alt="">

                </label>
                </div>


             </div>
             <div class="person">
                 <img src="images/OIP.jpg" alt="" class="person_img">
                 <p class="person_name">Name : please log in or sign up</p>
                 <p class="person_email">Email: please log in or sign up</p>
             </div>

        </div>
        
        <div class="right_bar">
            <div class="right_bar_header">
                My Chat

                <div class="login"><a href="login.php">Log in</a></div>
                <div class="sign_up_link"><a href="signup.php">sign up</a></div>
            </div>
            
            <hr>
            <div class="right_bar_content">
                <div class="chats"></div>
                <div id="contacts_show"class="open_chat"></div>


            </div>
    
    
    
    </div>
<script src="index.js"></script>
</body>
</html>


<?php else: ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>My chat</title>
</head>
<body>

    <div class="wrapper">
        <div class="left-bar">
             <div class="categories">
                 
                 
                 
                 <div id="icon_radio_buttons">
                <label>
                    <input type="radio" name="icon_group" value="icon_chat">
                    <img id='chat_icon' src="icons/Chats-icon.png" alt="">
                   
                </label>
                <label>
                    <input type="radio" name="icon_group" value="icon_setting">
                    <img id="img_settings" src="icons/settings.png" alt="">
                    
                </label>
                <label>
                    <input type="radio" name="icon_group" value="icon_contact">
                    <img id="contacts" src="icons/contacts.png" alt="">

                </label>
                </div>


             </div>
             <div class="person">
                 <img id="person_img"  src=<?php echo  $user['image'] ;  ?> alt="" class="person_img">
                 <p id="person_username" class="person_name">Name : <?php echo $user['username'] ;  ?></p>
                 <p id="person_email" class="person_email">Email: <?php echo $user['email'] ;  ?></p>
             </div>

        </div>
        
        <div class="right_bar">
            <div class="right_bar_header">
                My Chat
                <div class="logout"><a href="logout.php">log Out</a></div>
            </div>
            <hr>
            <div class="right_bar_content">
                <div class="chats">
                    <div id="current_chat">please select a chat or find a contact to chat</div>
                    <div id="list_of_chats"></div>
                 </div>
                <div id="contacts_show" class="open_chat">
                    <div class="show_loader"><img id="loader" class="show_off" src="images/loading-gif.webp" alt=""></div>
                            welcome to the chat application
                </div>
                <div id = "settings_id" class="settings">
                    
                    <form method="POST" id="form" action="controler/settings_controler.php">
                        <div id="setting_modal" class="settings_modal_off"><p id="text_update"></p><div id="close_setting_icon" class="close_setting"> <img src="images/OIP.jpg" alt=""></div></div>
                        <div>Settings</div>
                        <input id="username_update" type="texts" name="username"  placeholder="username" value = <?php echo $user['username']; ?> required><br>
                        <input id="email_update" type="email" name="email"  placeholder="email" value = <?php echo $user['email']; ?> required><br>
                        <input type="radio" name="sex" required value="male" <?php if ($user['sex'] === 'male') echo 'checked'; ?>>Male<br>
                        <input type="radio" name="sex" required value="female" <?php if ($user['sex'] === 'female') echo 'checked'; ?> >Female<br>
                        <button id="save_settings" class="btn_submit" type="submit">save</button><br>
        
                    </form>
                                    
                        
                        
                </div>
                       

            </div>


        </div>
    
    
    
    </div>
<script type="module" src="index.js" defer></script>
<script type="module" src="send_message.js"></script>
</body>
</html>

<?php endif; ?>