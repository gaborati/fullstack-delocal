document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();


   let email = document.getElementById("email").value;
   let password = document.getElementById("password").value;
    console.log(email)

    fetch("http://localhost:8000/backend/controller/loginController.php", {
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


        })
        .catch(error => {
            console.error('There was a problem with your fetch ', error);
        });
});
