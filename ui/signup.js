// javascripts for sign in page

function _(element){
    return document.getElementById(element)
}

var pwd = _('pwd')
var pwd_check = _('pwd_check')
var error_text = _('error_text')

// check password match


function password_match(){
    console.log("password function called");
    var match = true
    if(pwd.value == pwd_check.value){
        pwd.classList.remove('box_error');
        pwd_check.classList.remove('box_error');
        error_text.classList.remove('box_error');
    }
    else{
        pwd.classList.add('box_error');
        pwd_check.classList.add('box_error');
        error_text.classList.add('box_error');
        match = false;
    }
    return match;
}







