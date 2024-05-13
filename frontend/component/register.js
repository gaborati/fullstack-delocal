document.getElementById("registration-form").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(event.target);

    fetch("http://localhost:8000/backend/controller/registerController.php", {
        method: "POST",
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .then(data => {
            const jwtToken = data.jwt;
            console.log(jwtToken);
            localStorage.setItem('jwtToken', jwtToken);
            window.location.replace("http://localhost:8000/frontend/view/dashboard.html");
        })
        .catch(error => {
            console.error('There was a problem with your fetch operation:', error);
        });
});
