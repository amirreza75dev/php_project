function _(element){
    return document.getElementById(element)
}

// creating contancts element

var open_chat = _('contacts_show')
var settings_id = _('settings_id')
var current_chat = _('current_chat')
var chat_with_person = _('chats_with_person')
function contacts_add(contacts) {
    

    let html = '';
    for (const key in contacts) {
        html += `<div info= "${contacts[key].id}" img_src= "${contacts[key].image ? contacts[key].image : "https://th.bing.com/th/id/OIP.p1wrRwPB6yMOKftcuw1OGwHaKX?pid=ImgDet&rs=1"}" name= "${contacts[key].username}" class="contacts_people">
            <span><img src="${contacts[key].image ? contacts[key].image : "https://th.bing.com/th/id/OIP.p1wrRwPB6yMOKftcuw1OGwHaKX?pid=ImgDet&rs=1"}" alt="" class="person_img">
            <p class="person_name">Name : ${contacts[key].username}</p>
            <p class="person_email">Email: ${contacts[key].email}</p><span>
        </div>`;
    }
    open_chat.innerHTML = html;
}


// getting contacts


let contacts = _('contacts')
var loader = _('loader')
var chats = document.getElementsByClassName('chats')[0]
contacts.addEventListener('click', ()=>{

    //gettig contacts
    settings_id.style.display = "none"
    open_chat.style.display = "flex"
    var xhr = new XMLHttpRequest();
    var url = "controler/contacts_controler.php";
    
    loader.className = 'show_on'
    xhr.open('GET',url , true);
    xhr.onload = function() {
    if (this.status == 200) {
        var response = JSON.parse(this.responseText);

        loader.className = 'show_off'

        contacts_add(response)
          ///addevent listener to contacts

   

    console.log(chats);

    var contact_people = document.querySelectorAll('.contacts_people')
    

    console.log(contact_people);
        contact_people.forEach(element => {
        
        element.addEventListener('click',(e)=>{
            console.log(e);
            var user_id = element.getAttribute('info')
            var username = element.getAttribute('name')
            var img_src = element.getAttribute('img_src')
            
            chats.style.flex = "1"

            var html = `<div id= "receiver_id" info="${user_id}" style="text-align:center;">
                <p>your are chating with : ${username} </p>
                <img src=${img_src} style="display:block; margin-left:10px;" class="person_img"/>
            
            
            
            </div>`

            current_chat.innerHTML = html

    
    
    
    
    
    
            })
            
        });
    } else {
        console.error('Error:', this.statusText);
    }
    };
    xhr.onerror = function() {
    console.error('Network Error');
    };
    xhr.send();

    console.log('hi');
  




})


console.log('hi2');

// Settingss

var settings = _('save_settings')
var img_settings = _('img_settings')
var username_update = _('username_update')
var email_update = _('email_update')
var setting_modal = _('setting_modal')
var close_setting_icon = _('close_setting_icon')
var person_img = _('person_img')
var person_username = _('person_username')
var person_email = _('person_email')
var text_update = _('text_update')
const form = document.getElementById('form');

const radios = form.querySelectorAll('input[type="radio"]');
let selectedValue;
for (const radio of radios) {
if (radio.checked) {
    selectedValue = radio.value;
    break;
}
}

img_settings.addEventListener('click',()=>{
    settings_id.style.display = "block"
    open_chat.style.display = "none"
    chats.style.display = "none"
    
    chats.style.flex = "0"


})

settings.addEventListener('click', (e)=>{
        e.preventDefault()


        let sexselectedValue;
        // getting values
        const radios = form.querySelectorAll('input[type="radio"]');
        
        for (const radio of radios) {
        if (radio.checked) {
            sexselectedValue = radio.value;
            break;
        }
        }
        
        var email_value_update = email_update.value
        var username_value_update = username_update.value
        var jsonData = {
          'email' : email_value_update,
          'username': username_value_update,
          'sex': sexselectedValue
      }
      // Create a new XMLHttpRequest object
      var xhr = new XMLHttpRequest();

      // Define the request parameters
      var url = "controler/settings_controler.php";
      var method = "POST";
      console.log(jsonData);
      var jsonString = JSON.stringify(jsonData);
  
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
                //   show success model
                person_img.src = responseObject['session'].image
                person_username.innerText = `Username : ${responseObject['session'].username}`
                person_email.src = `image : ${responseObject['session'].image}`
                
                text_update.innerText ="successful"
                setting_modal.className = "settings_modal_on"

  
  
  
                  
              } else {
                  console.error("Error: " + xhr.status);
                  text_update.innerText ="unsuccessful"
                  setting_modal.className = "settings_modal_on"
              }
          }
      };
  
      // Send the request with the JSON data
      xhr.send(jsonString);
  
  
  







})


close_setting_icon.addEventListener('click',()=>{
    setting_modal.className = "settings_modal_off"
})






// chat section


var chat_icon = _('chat_icon')
chat_icon.addEventListener('click',showing_chats)

export function showing_chats(){
        settings_id.style.display = "none"
        open_chat.style.display = "block"
        chats.style.display = "block"
        chats.style.flex = "1"
        // contacts_show.style.display = "none"
        // reciver id
        var receiver = _('receiver_id')
        var receiver_id = receiver.getAttribute('info')
        var data = {
            'receiver_id': receiver_id
        }
        var datastring = JSON.stringify(data)
        const xhr = new XMLHttpRequest();
    
    
        // Set up the request
        xhr.open("POST", "controler/chat_section.php",true);
        
        // Define what should happen when the response is received
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr);
              if (xhr.response) {
                  console.log(xhr.response);
                // Update the content of the div with the response
                open_chat.innerHTML = xhr.response;
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
          
          xhr.send(datastring);
    
    
     
        
    
    
    
    
    
    

}







// getting list of previous chats
function select_chat(e) {
    // Prevent any default behavior of the click event, if needed
    e.preventDefault();

    // Get the chat_item_id from the clicked div's info attribute
    var chat_item_id = e.currentTarget.getAttribute('info');

    // Find the img and span elements within the clicked div
    const imgElement = e.currentTarget.querySelector('img');
    const usernameElement = e.currentTarget.querySelector('span');

    // Get the src attribute of the img element and the inner text of the span element
    const imageSrc = imgElement.getAttribute('src');
    const username = usernameElement.innerText;

    // Use the retrieved data as needed (e.g., display it in another element)
    var html = `<div id="receiver_id" info="${chat_item_id}" style="text-align:center;">
    <p>Your are chatting with: ${username}</p>
    <img src="${imageSrc}" style="display:block; margin-left:10px;" class="person_img"/>
    </div>`;

    current_chat.innerHTML = html;
    showing_chats()




}


var chat_list= _('list_of_chats')
list_of_chats()
function list_of_chats(){

 var receiver = _('receiver_id')

        const xhr = new XMLHttpRequest();
    
        // Set up the request
        xhr.open("GET", "controler/list_of_chats.php",true);
        
        // Define what should happen when the response is received
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr);
              if (xhr.response) {
                  console.log(xhr.response);
                // Update the content of the div with the response
                chat_list.innerHTML = xhr.response;
                var chat_lists = document.getElementsByClassName('chat_list_item');
                console.log(chat_lists);
                
                Array.from(chat_lists).forEach(chat => {
                    chat.addEventListener('click', select_chat);
                });
                
                

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
          
          xhr.send();





}






