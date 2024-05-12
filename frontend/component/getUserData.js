import {getLinksInfo} from "./linkMethod.js";
export function getUserData() {
    fetch('http://localhost:8000/backend/controller/userLinkController.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('jwtToken')
        },
    })
        .then(response => response.json())
        .then(data => {
            getLinksInfo(data);
            console.log('User data:', data);
        })
        .catch(error => {
            console.error('Error occurred while getting user data:', error);
        });
}
