$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        var email = $('#email').val();
        var password = $('#password').val();

        // AJAX request
        $.ajax({
            url: 'controller/manage-users/login-users.php',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response === 'success') {
                    // Redirect to the admin dashboard with the correct URL
                    window.location.href = 'admin.php?page=pages/admin-dashboard.php';
                } else if (response === 'invalid_email_format') {
                    alert('Invalid email format. Please enter a valid email.');
                } else {
                    // Show an error message
                    alert('Invalid email or password. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors here
                console.error(xhr.responseText);
                alert('An error occurred while processing your request.');
            }
        });
    });
});