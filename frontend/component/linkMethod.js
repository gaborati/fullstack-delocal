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

            fetch('/backend/controller/saveLinkController.php', {
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
    const linkContainer = document.getElementById('linkContainer');

    linkContainer.innerHTML = '';

    if (data.links && Array.isArray(data.links)) {
        data.links.forEach(link => {
            const linkDiv = document.createElement('div');
            linkDiv.classList.add('link-container');

            const title = document.createElement('h2');
            title.textContent = link.title;

            const url = document.createElement('a');
            url.textContent = link.url;
            url.href = link.url;
            url.target = "_blank";

            const description = document.createElement('p');
            description.textContent = link.description;

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.addEventListener('click', () => deleteLink(link.id));

            linkDiv.appendChild(title);
            linkDiv.appendChild(url);
            linkDiv.appendChild(description);
            linkDiv.appendChild(deleteButton);

            linkContainer.appendChild(linkDiv);
        });
    } else {
        console.error('No links found, or invalid data format');
    }
}


export function deleteLink(linkId) {

    fetch('/backend/controller/deleteLinkController.php', {
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


