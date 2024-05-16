import { getLinksInfo } from "./linkMethod.js";
export function searchLink(keyword) {
    fetch('/backend/controller/searchController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('jwtToken')
        },
        body: JSON.stringify({ keyword: keyword })
    })
        .then(response => response.json())
        .then(data => {
            const searchData = {
                links: data
            };
            getLinksInfo(searchData);
            console.log('Search results:', data);
        })
        .catch(error => {
            console.error('Error occurred while searching links:', error);
        });
}
