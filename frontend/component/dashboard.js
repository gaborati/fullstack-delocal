import{ getUserData } from "./getUserData.js";
import {addLink} from "./linkMethod.js";


function checkAuthToken() {
    const jwtToken = localStorage.getItem('jwtToken');
    if (!jwtToken) {
        window.location.replace("login.html");
    } else {
        showDashboard();
        document.getElementById("logoutBtn").addEventListener("click", logout);
        document.getElementById("addLinkForm").addEventListener("submit", addLink);
        getUserData();
        document.getElementById("searchButton").addEventListener("click", function() {
            const searchKeyword = document.getElementById("searchInput").value;
            searchLinks(searchKeyword);
        });
    }
}



function showDashboard() {
    document.body.innerHTML += "<button id='logoutBtn'>Logout</button>";
}

function logout() {
    localStorage.removeItem('jwtToken');
    console.log('logged out');
    window.location.replace("login.html");
}

function searchLinks(keyword) {
    fetch('http://localhost:8000/backend/controller/searchController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('jwtToken')
        },
        body: JSON.stringify({ keyword: keyword })
    })
        .then(response => response.json())
        .then(data => {

            console.log('Search results:', data);
        })
        .catch(error => {
            console.error('Error occurred while searching links:', error);
        });
}





window.onload = checkAuthToken;