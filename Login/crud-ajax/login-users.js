$(document).ready(function () {
    const $username = $('#username');
    const $password = $('#password');
    const $loginForm = $('#loginForm');
    const $submitButton = $loginForm.find('button[type="submit"]'); // Assuming there's a submit button

    // Add ARIA labels for accessibility
    $username.attr('aria-label', 'Username');
    $password.attr('aria-label', 'Password');
    $submitButton.attr('aria-label', 'Submit Login');

    $loginForm.on('submit', function (e) {
        e.preventDefault();

        // Disable submit button to prevent multiple submissions
        $submitButton.prop('disabled', true);

        // Get form data and trim values
        const username = $username.val().trim();
        const password = $password.val().trim();

        // Validate inputs
        if (!validateInputs(username, password)) {
            $submitButton.prop('disabled', false); // Re-enable on failure
            return;
        }

        // AJAX request (using standard jQuery AJAX method)
        $.ajax({
            url: 'controller/login-users.php',
            type: 'POST',
            data: { username, password },
            dataType: 'json',
            success: function (response) {
                handleLoginResponse(response);
            },
            error: function (xhr, status, error) {
                console.error('Request Error:', error);
                showError('Request Error', 'An error occurred while processing your request.');
                $submitButton.prop('disabled', false); // Re-enable button after error
            }
        });
    });

    // Consolidated validation logic
    function validateInputs(username, password) {
        if (!username || !password) {
            showToast('warning', 'Please fill out both username and password.', '#856404', '#fff3cd');
            return false;
        }

        if (username.length < 3 || !/^[a-zA-Z0-9]+$/.test(username)) {
            showToast('warning', 'Username must be alphanumeric and at least 3 characters long.', '#856404', '#fff3cd');
            return false;
        }

        if (password.length < 3) {
            showToast('warning', 'Password must be at least 6 characters long.', '#856404', '#fff3cd');
            return false;
        }

        return true;
    }

    // Handle login response
    function handleLoginResponse(response) {
        const { status = 'error', user_type = '', message = 'Login failed.' } = response;

        if (status === 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Login successful',
                showConfirmButton: false,
                timer: 2000,
                background: '#b9f6ca',
                iconColor: '#2e7d32',
                color: '#155724',
                customClass: { popup: 'mt-2 swal-responsive' }
            }).then(() => {
                // Reset the form using a more general method
                $loginForm[0].reset();
                handleRedirect(user_type);
            });
        } else {
            showToast('error', message, '#c62828', '#ffebee');
            $submitButton.prop('disabled', false); // Re-enable button after failed login
        }
    }

    // Handle redirection based on user type
    function handleRedirect(user_type) {
        const userRedirects = {
            IT: '../IT/it.php',
            Dean: '../Dean/dean.php',
            Coordinator: '../Coordinator/coordinator.php',
            Supervisor: '../Supervisor/supervisor.php',
            Student: '../Student/student.php',
            Registrar: '../Registrar/registrar.php',
        };

        const baseUrl = userRedirects[user_type];

        if (baseUrl) {
            console.log('Redirecting to:', baseUrl);
            window.location.href = baseUrl;
        } else {
            console.error('Unknown user type:', user_type);
            showError('Unknown User Type', 'An error occurred with your account type.');
        }
    }

    // Toast notification utility with common options
    function showToast(icon, title, color, bgColor) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: 3000,
            background: bgColor,
            iconColor: color,
            color: color,
            customClass: { popup: 'mt-2 swal-responsive' }
        });
    }

    // Show error message using Swal
    function showError(title, text) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: title,
            text: text,
            background: '#ffebee',
            iconColor: '#c62828',
            color: '#d32f2f'
        });
    }
});