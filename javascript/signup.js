$(document).ready(function() {
  let forms = document.querySelector(".signup form"),
  continueBtn = document.querySelector(".button input"),
  errorText = document.querySelector(".error-text");

  const fetchContent = function(url) {
    // AJAX request to load content from PHP file
    $.ajax({
      url: url, // URL of the PHP file
      type: 'GET',
      success: function(response) {
        $('.chat_box').html(response); // Insert content into container div
      },
      error: function() {
        console.error('Error loading content from ' + url);
      }
    });
  };

  forms.onsubmit = (e)=>{
      e.preventDefault(); //preventing form from submitting
  }

  continueBtn.onclick = ()=>{
      //AJAX Start
      let xhr = new XMLHttpRequest(); //create XML object
      xhr.open("POST", "php/signup.php", true);
      xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success"){
                  fetchContent('users.php');
                  // location.href="users.php";
                }else if(data === "failed"){
                  fetchContent('chat-user.php?user_id=1285204382');
                  // location.href = "chat-user.php?user_id=1285204382";
                }else{
                  errorText.style.display = "block";
                  errorText.textContent = data;
                }
            }
        }
      }
      let formData = new FormData(forms);
      xhr.send(formData);
  }
});

