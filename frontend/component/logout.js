document.getElementById("logoutBtn").addEventListener("click", function() {
    localStorage.removeItem('jwtToken');
    console.log('logged out')
});