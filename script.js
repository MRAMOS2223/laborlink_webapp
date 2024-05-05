document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    var form = document.querySelector('form');

    // Add an event listener for form submission
    form.addEventListener('submit', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Get the email and password inputs' values
        var email = document.getElementById('uemail').value;
        var password = document.getElementById('password').value;

        // Validate email format
        if (!validateEmail(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        // Validate password format
        if (!validatePassword(password)) {
            alert("Password must be at least 8 characters long.");
            return;
        }

        // Redirect to the dashboard page
        window.location.href = 'dashboard.html';
    });
});

// Function to validate email format
function validateEmail(email) {
    var emailRegex = /\S+@\S+\.\S+/;
    return emailRegex.test(email);
}

// Function to validate password format
function validatePassword(password) {
    return password.length >= 8;
}
