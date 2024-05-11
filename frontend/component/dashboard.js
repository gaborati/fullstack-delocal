function checkAuthToken() {
    const jwtToken = localStorage.getItem('jwtToken');
    if (!jwtToken) {
        window.location.replace("login.html");
    } else {
        showDashboard();
        document.getElementById("logoutBtn").addEventListener("click", logout);
        document.getElementById("addLinkForm").addEventListener("submit", addLink);
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

function addLink(event) {
    event.preventDefault();

    const url = document.getElementById("urlInput").value;

    fetch(url)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");

            const imageElement = doc.querySelector("img");
            const imageUrl = imageElement ? imageElement.src : "";

            const descriptionElement = doc.querySelector("meta[name='description']");
            const description = descriptionElement ? descriptionElement.content : "";

            const title = doc.title;

            console.log("Image URL:", imageUrl);
            console.log("Description:", description);
            console.log("Title:", title);

            const data = {
                url: url,
                imageUrl: imageUrl,
                description: description,
                title: title
            };

            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('jwtToken')
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (response.ok) {
                        console.log('Link added successfully!');

                    } else {
                        console.error('Failed to add link:', response.statusText);
                    }
                })
                .catch(error => {
                    console.error('Error occurred while adding link:', error);
                });
        })
        .catch(error => {
            console.error("Error occurred:", error);
        });
}


window.onload = checkAuthToken;