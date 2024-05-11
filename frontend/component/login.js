document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();


    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;


    fetch("http://localhost:8000/backend/user/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            email: email,
            password: password
        })
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
            console.log("Received JWT Token:", jwtToken);
            localStorage.setItem('jwtToken', jwtToken);

            window.location.replace("dashboard.html");
        })
        .catch(error => {
            console.error('There was a problem with your fetch ', error);
        });
});
