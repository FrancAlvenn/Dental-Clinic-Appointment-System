$(document).ready(function() {
  let form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-text");

  form.onsubmit = (e)=>{
      e.preventDefault();
  }

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

  continueBtn.onclick = ()=>{
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php/login.php", true);
      xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "Receptionist"){
                  location.href="dashboard.php";
                }else if(data === "Doctor"){
                  location.href = "doc-per/dashboard.php";
                }else if(data === "IT Admin"){
                  location.href = "it-admin/dashboard.php";
                }else{
                  errorText.style.display = "block";
                  errorText.textContent = data;
                }
            }
        }
      }
      let formData = new FormData(form);
      xhr.send(formData);
  }
});

