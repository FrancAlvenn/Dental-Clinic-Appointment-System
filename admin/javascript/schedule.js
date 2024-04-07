$(document).ready(function() {
    let searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    scheduleList = document.querySelector(".schedule-list-area");

    // Get the radio buttons
    const confirmedRadio = document.querySelector('#confirm-radio');
    const pendingRadio = document.querySelector('#pending-radio');
    const rejectedRadio = document.querySelector('#rejected-radio');
    const comboBoxSelect = document.getElementById('show-all-select');
    const scheduleDateInput = document.querySelector('.input-date');
    let selectedDate;

    //Initial Get
    document.getElementById("confirm-radio").checked = true;
    let scheduleIntervalId;
    clearInterval(scheduleIntervalId);
    const scheduleDate = scheduleDateInput.value; // Get the selected date

    if (confirmedRadio.checked) {
        // Select the date input element
        const selectedDateInput = document.querySelector('.input-date');

        // Initialize selectedDate with the current value of the input
        selectedDate = selectedDateInput.value;

        // Add event listener for change event on the date input
        selectedDateInput.addEventListener('change', function() {
            // Update the selectedDate variable with the new value from the input
            selectedDate = selectedDateInput.value;
        });
    }

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

    // Search Show
    searchIcon.onclick = ()=>{
      searchBar.classList.toggle("show");
      searchIcon.classList.toggle("active");
      searchBar.focus();
      if(searchBar.classList.contains("active")){
        searchBar.value = "";
        searchBar.classList.remove("active");
      }
    }
  
    // Search Key Up
    // Search Key Up
    searchBar.addEventListener('input', function() {
    let searchTerm = searchBar.value;
    if (searchTerm != "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }

    const selectedOption = comboBoxSelect.value;
    const status = confirmedRadio.checked ? 'confirmed' : pendingRadio.checked ? 'pending' : 'rejected';
    const selectedDate = scheduleDateInput.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/schedule-search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                scheduleList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm + "&status=" + status + "&comboBoxSelect=" + selectedOption + "&date=" + selectedDate);
});



  // Add event listeners to the radio button
  confirmedRadio.addEventListener('change', updateSchedule);
  pendingRadio.addEventListener('change', updateSchedule);
  rejectedRadio.addEventListener('change', updateSchedule);
  comboBoxSelect.addEventListener('change',updateSchedule);
  scheduleDateInput.addEventListener('change',resetComboBox);

  function resetComboBox(){
    comboBoxSelect.selectedIndex = 0;
    updateSchedule();
  }


  // Function to update the schedule based on the selected radio button
  function updateSchedule() {
    clearInterval(scheduleIntervalId);
    const selectedOption = comboBoxSelect.value;

    const status = confirmedRadio.checked ? 'confirmed' : pendingRadio.checked ? 'pending' : 'rejected';

    const selectedDate = scheduleDateInput.value;

    function fetchScheduleData() {
        let xhr = new XMLHttpRequest();
        let url = "php/schedule.php?status=" + status + "&comboBoxSelect=" + selectedOption + "&date=" + selectedDate;

        xhr.open("GET", url, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (!searchBar.classList.contains("active")) {
                        scheduleList.innerHTML = data;
                    }
                }
            }
        }
        xhr.send();
    }

    scheduleIntervalId = setInterval(fetchScheduleData, 500);
  
}
});