$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        var email = $('#email').val();
        var password = $('#password').val();

        // AJAX request
        $.ajax({
            url: '../controller/login-users.php',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var user_type = response.user_type;
                    var department = response.department;

                    // Redirect based on user type and department
                    if (user_type === 'Admin') {
                        window.location.href = '../Admin/admin.php?page=pages/admin-dashboard.php';
                    } else if (user_type === 'OJT Student') {
                        // Store department information in sessionStorage
                        sessionStorage.setItem('department', department);

                        // Redirect to student.php
                        window.location.href = '../Student/student.php';
                    } else {
                        alert('Invalid user type.');
                    }
                } else if (response.status === 'invalid_email_format') {
                    alert('Invalid email format. Please enter a valid email.');
                } else if (response.status === 'invalid_credentials') {
                    alert('Invalid email or password. Please try again.');
                } else {
                    alert('An error occurred. Please try again.');
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
