<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Login</title>
    
</head>
<body>
<div class="wrapper">
    <div class="modal-login"><a href="signUp.php"></a></div>
    <form method="POST" class="form_login" id="login_submit">
        <div id="login_text" class="sign">Please log in</div>
        <input id="email_log" type="email" name="email_value"  placeholder="email" required><br>
        <input  type="password" id="pwd_login" name="password" required placeholder="password"><br>
        <button  class="btn_submit" type="submit">Submit</button><br>

    </form>


</div>


<script src="login.js"></script>  
</body>
</html>