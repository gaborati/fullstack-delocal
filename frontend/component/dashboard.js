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



window.onload = checkAuthToken;