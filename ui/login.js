function _(element){
    return document.getElementById(element)
}

// javascripts for login page


var email_log = _('email_log');
var pass_log = _('pass_log');
var login_submit = _('login_submit')
var modal_login = document.getElementsByClassName('modal-login')[0]
var sign = document.getElementsByClassName('sign')[0]

var login_text = _('login_text')


login_submit.addEventListener("submit", (e)=>{
    e.preventDefault();
    
    var email_value = email_log.value;
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Define the request parameters
    var url = "controler/login_controler.php";
    var jsonData = {
        "email_value": email_value,
        
    };
    var jsonString = JSON.stringify(jsonData);
    var method = "POST";

    // Set up the request
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Define the callback function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                    // Parse the JSON response
                console.log(xhr.status === 200);
                console.log(xhr.responseText);
                var responseObject = JSON.parse(xhr.responseText);
                console.log(responseObject)
                console.log("byy");

                // Use the response object to do whatever you need to do with the data
                console.log(responseObject.success);
                if(responseObject.success){
                    // modal_login.classList.add('modal-login-show')
                    login_text.innerText = `welcome ${responseObject.users["username"]}`
                    setTimeout(function() {
                        
                        window.location.href = "index.php"
                    }, 3000);

                }else{
                    modal_login.classList.add('modal-login-show')
                    modal_login.innerHTML = `
                                                
                                                <p>${responseObject.errors[0]}</p> 
                                                <a href="signUp.php">Please sign up</a>   
                                                
                                            `;
                    sign.classList.add('sign-hidden')
                }



                
            } else {
                console.error("Error: " + xhr.status);
            }
        }
    };

    // Send the request with the JSON data
    xhr.send(jsonString);




  
    


})