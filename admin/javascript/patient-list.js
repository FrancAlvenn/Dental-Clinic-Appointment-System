$(document).ready(function() {
    let searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    patientList = document.querySelector(".patient-list-area");

      searchIcon.onclick = ()=>{
        searchBar.classList.toggle("show");
        searchIcon.classList.toggle("active");
        searchBar.focus();
        if(searchBar.classList.contains("active")){
          searchBar.value = "";
          searchBar.classList.remove("active");
        }
      }

      searchBar.onkeyup = ()=>{
        let searchTerm = searchBar.value;
        if(searchTerm != ""){
          searchBar.classList.add("active");
        }else{
          searchBar.classList.remove("active");
        }
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/schedule-search.php?date=" + selectedDate, true);
        xhr.onload = ()=>{
          if(xhr.readyState === XMLHttpRequest.DONE){
              if(xhr.status === 200){
                let data = xhr.response;
                scheduleList.innerHTML = data;
              }
          }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + searchTerm);
      }


      setInterval(() =>{
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "php/patient-list.php", true);
        xhr.onload = ()=>{
          if(xhr.readyState === XMLHttpRequest.DONE){
              if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                  patientList.innerHTML = data;
                }
              }
          }
        }
        xhr.send();
      }, 500);



});