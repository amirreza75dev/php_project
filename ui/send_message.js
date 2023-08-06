import {showing_chats} from './index.js'
function _(element){
    return document.getElementById(element)
}
document.addEventListener("DOMContentLoaded", function() {
    // Event delegation for send_btn
    document.addEventListener("click", function(event) {
        if (event.target && event.target.id === "send_btn") {
        var send_btn = _('send_btn')
        var text_area = _('text_area')
        console.log("send_btn");

        
        var text_value = text_area.value
        var chat_box = _('chats_with_person')
        // reciver id
        var receiver = _('receiver_id')
        var receiver_id = receiver.getAttribute('info')

        
        var jsondata = {
            'message' : text_value,
            'receiver_id' : receiver_id
        }
        var jsonString = JSON.stringify(jsondata);

        const xhr = new XMLHttpRequest();

        // Set up the request
        xhr.open("POST","controler/message_controler.php",true);

        // Define what should happen when the response is received
        xhr.onload = function() {
            if (xhr.status === 200) {
            
            if (xhr.response) {
                console.log(xhr.response);
                // Update the content of the div with the response
                chat_box.innerHTML = xhr.response;
            } else {
                // Handle empty response
                console.log("Error: Empty response");
            }
            } else {
            // Handle non-200 status code
            console.log("Error: " + xhr.status);
            }
        };
        
        xhr.onerror = function() {
            // Handle network error
            console.log("Error: Network error");
        };
        
        xhr.send(jsonString);

        showing_chats();















        }
    });

    // Event delegation for other elements
    // ...

    // Other JavaScript code that requires DOM elements
    // ...
});



    //send messge

