<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>sign up</title>
    
</head>
<body>
<div class="wrapper">
    <form method="POST" id="form" action="controler/signup_controler.php" onsubmit ="return password_match()">
        <div class="sign">Please Sign up</div>
        <input type="texts" name="username"  placeholder="username" required><br>
        <input type="email" name="email"  placeholder="email" required><br>
        <input type="radio" name="sex" required value="male">Male<br>
        <input type="radio" name="sex" required value="female">Female<br>
        <input type="password" id="pwd" name="password" required placeholder="password"><br>
        <input type="password" id="pwd_check" name="password" required placeholder="repeat password"><br>
        <div id="error_text" class="pwd_error">please enter the valid password</div>
        <button class="btn_submit" type="submit">Submit</button><br>

    </form>


</div>


<script src="signup.js"></script>  
</body>
</html>