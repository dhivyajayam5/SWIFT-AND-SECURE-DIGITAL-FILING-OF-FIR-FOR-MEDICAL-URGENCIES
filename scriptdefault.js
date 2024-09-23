document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    
    // Check if the provided credentials match the default admin credentials
    if (username === "admin" && password === "admin111") {
        //alert("Login successful!");
        window.location.href = "newadminlogin.html";
        
        // You can redirect the user to a different page or perform other actions here
    } else {
        alert("Invalid username or password. Please try again.");
    }
});
