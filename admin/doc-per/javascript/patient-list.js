$(document).ready(function() {
  let searchBar = document.querySelector(".search input"),
      searchIcon = document.querySelector(".search button");
  
  let scheduleIntervalId;

  searchIcon.onclick = () => {
      searchBar.classList.toggle("show");
      searchIcon.classList.toggle("active");
      searchBar.focus();
      if (searchBar.classList.contains("active")) {
          searchBar.value = "";
          searchBar.classList.remove("active");
          searchBar.value = "";
          fetchAndDisplayPatients();
      }
    }
  

  searchBar.onkeyup = () => {
      let searchTerm = searchBar.value;
      if (searchTerm != "") {
          searchBar.classList.add("active");
      } else {
          searchBar.classList.remove("active");
          fetchAndDisplayPatients();
      }
      searchPatients(searchTerm); // Perform search
  }

  function fetchAndDisplayPatients() {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "php/patient-list.php", true);
      xhr.onload = function() {
          if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
              let patients = JSON.parse(xhr.responseText);
              updateTable(patients);
          }
      };
      xhr.send();
  }

  function updateTable(patients) {
      let tbody = document.querySelector("#patientTable tbody");
      tbody.innerHTML = ""; // Clear existing table content
      patients.forEach(patient => {
          let row = document.createElement("tr");
          row.innerHTML = `
              <td class="align-middle text-center">${patient.patient_id}</td>
              <td class="align-middle text-center">${patient.firstname}</td>
              <td class="align-middle text-center">${patient.lastname}</td>
              <td class="align-middle text-center patient-email">${patient.email}</td>
              <td class="align-middle text-center">${patient.phone_number}</td>
              <td class="align-middle text-center">${patient.date_of_birth || 'N/A'}</td>
              <td class="align-middle text-center patient-address">${patient.address || 'N/A'}</td>
              <td class="align-middle text-center">
                  <button type="button" value="${patient.patient_id}" class="editPatient btn">View Details</button>
              </td>
          `;
          tbody.appendChild(row);
      });
  }

  function searchPatients(searchTerm) {
      clearInterval(scheduleIntervalId); // Clear interval before searching
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php/patient-search.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
              let patients = JSON.parse(xhr.responseText);
              updateTable(patients);
          }
      }
      xhr.send("searchTerm=" + searchTerm);
  }

  // Call fetchAndDisplayPatients initially to load data on page load
  fetchAndDisplayPatients();

  // Set interval to periodically fetch and display patients
  scheduleIntervalId = setInterval(fetchAndDisplayPatients, 500);
});
