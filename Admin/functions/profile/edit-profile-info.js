document.getElementById("changePasswordBtn").addEventListener("click", function() {
    const passwordFields = document.getElementById("passwordFields");
    const passwordLabel = this.parentElement.querySelector("label"); // Label with dots
    const changePasswordBtn = document.getElementById("changePasswordBtn"); // Change Password button

    if (passwordFields.style.display === "block") {
        // Hide password input fields and show dots and Change Password button
        passwordFields.style.display = "none";
        passwordLabel.style.display = "flex"; // Use flex to keep items aligned properly
        changePasswordBtn.style.display = "inline-flex"; // Ensure the button is displayed properly
    } else {
        // Hide dots and Change Password button, show password input fields
        passwordLabel.style.display = "none";
        passwordFields.style.display = "block";
        changePasswordBtn.style.display = "none"; // Hide button when editing
    }
});

// New event listener for the passCancelBtn
document.getElementById("passCancelBtn").addEventListener("click", function() {
    const passwordFields = document.getElementById("passwordFields");
    const passwordLabel = document.querySelector("label span.password-dots").parentElement; // Get the label containing dots
    const changePasswordBtn = document.getElementById("changePasswordBtn");

    // Hide password input fields
    passwordFields.style.display = "none";
    
    // Show the label with the dots and Change Password button
    passwordLabel.style.display = "flex"; // Make sure the label is visible
    changePasswordBtn.style.display = "inline-flex"; // Keep button styled correctly
});