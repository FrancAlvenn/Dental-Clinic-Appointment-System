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
          fetchAndDisplayUsers();
      }
    }
  

  searchBar.onkeyup = () => {
      let searchTerm = searchBar.value;
      if (searchTerm != "") {
          searchBar.classList.add("active");
      } else {
          searchBar.classList.remove("active");
          fetchAndDisplayUsers();
      }
      searchUsers(searchTerm); // Perform search
  }

  function fetchAndDisplayUsers() {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "php/all-user-list.php", true);
      xhr.onload = function() {
          if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
              let users = JSON.parse(xhr.responseText);
              updateTable(users);
          }
      };
      xhr.send();
  }

  function updateTable(users) {
      let tbody = document.querySelector("#userTable tbody");
      tbody.innerHTML = ""; // Clear existing table content
      users.forEach(user => {
          let row = document.createElement("tr");
          row.innerHTML = `
              <td class="align-middle text-center">${user.id}</td>
              <td class="align-middle text-center">${user.firstname}</td>
              <td class="align-middle text-center">${user.lastname}</td>
              <td class="align-middle text-center user-email">${user.email}</td>
              <td class="align-middle text-center">${user.status}</td>
              <td class="align-middle text-center">${user.auth}</td>
              <td class="align-middle text-center">
                  <button type="button" value="${user.id}" class="editUser btn">View Details</button>
              </td>
          `;
          tbody.appendChild(row);
      });
  }

  function searchUsers(searchTerm) {
      clearInterval(scheduleIntervalId); // Clear interval before searching
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php/all-user-search.php?unique_id=" + uniqueId, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
              let users = JSON.parse(xhr.responseText);
              updateTable(users);
          }
      }
      xhr.send("searchTerm=" + searchTerm);
  }

  // Call fetchAndDisplayUsers initially to load data on page load
  fetchAndDisplayUsers();

  // Set interval to periodically fetch and display users
  scheduleIntervalId = setInterval(fetchAndDisplayUsers, 500);
});
