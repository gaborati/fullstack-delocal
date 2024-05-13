export function addLink(event) {
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

            fetch('http://localhost:8000/backend/controller/saveLinkController.php', {
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
                        location.reload();

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
export function getLinksInfo(data) {
    if (data.links && Array.isArray(data.links)) {
        data.links.forEach(link => {
            const linkContainer = document.createElement('div');
            linkContainer.classList.add('link-container');

            const title = document.createElement('h2');
            title.textContent = link.title;

            const url = document.createElement('p');
            url.textContent = link.url;

            const description = document.createElement('p');
            description.textContent = link.description;

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.addEventListener('click', () => deleteLink(link.id));
            linkContainer.appendChild(title);
            linkContainer.appendChild(url);
            linkContainer.appendChild(description);
            linkContainer.appendChild(deleteButton);

            document.body.appendChild(linkContainer);
        });
    } else {
        console.error('No links found , or invalid data format');
    }
}

export function deleteLink(linkId) {

    fetch('http://localhost:8000/backend/controller/deleteLinkController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('jwtToken')
        },
        body: JSON.stringify({ linkId: linkId })
    })
        .then(response => {
            if (response.ok) {
                console.log('Link deleted successfully!');
                location.reload();
            } else {
                console.error('Failed to delete link:', response.statusText);
            }
        })
        .catch(error => {
            console.error('Error occurred while deleting link:', error);
        });



}


