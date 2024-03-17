$(document).ready(function() {
    let searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    scheduleList = document.querySelector(".schedule-list-area");
  
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


    // Select the date input element
    const selectedDateInput = document.querySelector('.input-date');

    // Initialize selectedDate with the current value of the input
    let selectedDate = selectedDateInput.value;

    // Add event listener for change event on the date input
    selectedDateInput.addEventListener('change', function() {
        // Update the selectedDate variable with the new value from the input
        selectedDate = selectedDateInput.value;
    });

    // Function to fetch schedule data based on selected date
    function fetchScheduleData() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "php/schedule.php?date=" + selectedDate, true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(!searchBar.classList.contains("active")){
                        scheduleList.innerHTML = data;
                    }
                }
            }
        }
        xhr.send();
    }

    // Fetch schedule data at regular intervals
    setInterval(fetchScheduleData, 500);


  });
