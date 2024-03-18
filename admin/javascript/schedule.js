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


  // Get the radio buttons
  const confirmedRadio = document.querySelector('#confirm-radio');
  const pendingRadio = document.querySelector('#pending-radio');
  const rejectedRadio = document.querySelector('#rejected-radio');
  const scheduleDateInput = document.querySelector('.input-date');

  // Add event listeners to the radio buttons
  confirmedRadio.addEventListener('change', updateSchedule);
  pendingRadio.addEventListener('change', updateSchedule);
  rejectedRadio.addEventListener('change', updateSchedule);

  let scheduleIntervalId;
  // Function to update the schedule based on the selected radio button
  function updateSchedule() {
      clearInterval(scheduleIntervalId);
      const scheduleDate = scheduleDateInput.value; // Get the selected date

      if (confirmedRadio.checked) {
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
              xhr.open("GET", "php/schedule.php?date=" + selectedDate + "&status=confirmed", true);
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
          scheduleIntervalId = setInterval(fetchScheduleData, 500);
        console.log(`Schedule for confirmed appointments on ${scheduleDate}`);
      } else if (pendingRadio.checked) {
        clearInterval(scheduleIntervalId);
          // Function to fetch schedule data based on selected date
          function fetchScheduleData() {
              let xhr = new XMLHttpRequest();
              xhr.open("GET", "php/schedule.php?status=pending", true);
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
          scheduleIntervalId = setInterval(fetchScheduleData, 500);
          console.log('Schedule for pending appointments regardless of the date');
      } else if (rejectedRadio.checked) {
          clearInterval(scheduleIntervalId);
          // Function to fetch schedule data based on selected date
          function fetchScheduleData() {
              let xhr = new XMLHttpRequest();
              xhr.open("GET", "php/schedule.php?status=rejected", true);
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
          scheduleIntervalId = setInterval(fetchScheduleData, 500);
          console.log('Schedule for pending appointments regardless of the date');
          console.log('Schedule for declined appointments regardless of the date');
      }
  }


















  });
