export function searchLink(keyword) {
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