$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        // Get form data
        var username = $('#username').val();
        var password = $('#password').val();

        // AJAX request to server
        $.ajax({
            url: 'controller/login-users.php',
            type: 'POST',
            data: {
                username: username,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var user_type = response.user_type.toLowerCase(); // Ensure case consistency
                    var department = response.department;

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
                        customClass: {
                            popup: 'mt-5'
                        }
                    }).then(function() {
                        // Clear form fields after successful login
                        $('#username').val('');
                        $('#password').val('');

                        // Redirect based on user type and department
                        handleRedirect(user_type, department);
                    });
                } else {
                    handleLoginErrors(response);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Request Error',
                    text: 'An error occurred while processing your request.',
                    background: '#ffebee',
                    iconColor: '#c62828',
                    color: '#d32f2f'
                });
            }
        });
    });

    // Handle login errors
    function handleLoginErrors(response) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: response.message || 'Unknown error',
            showConfirmButton: false,
            timer: 3000,
            background: '#ffebee',
            iconColor: '#c62828',
            color: '#d32f2f'
        });
    }

    // Handle redirection based on user type and department
    function handleRedirect(user_type, department) {
        var baseUrl = '';

        if (user_type === 'it') {
            baseUrl = '../IT/it.php';
        } else if (user_type === 'dean') {
            // Redirection for Deans based on department
            baseUrl = '../Dean/' + department.toUpperCase() + '/dean.php';
        } else if (user_type === 'coordinator') {
            baseUrl = '../Coordinator/coordinator.php';
        } else if (user_type === 'supervisor') {
            baseUrl = '../Supervisor/supervisor.php';
        } else if (user_type === 'student') {
            baseUrl = '../Student/' + department.toUpperCase() + '/student.php';
        } else if (user_type === 'registrar') {
            baseUrl = '../Registrar/registrar.php';
        } else {
            alert('Unknown user type');
            return;
        }

        window.location.href = baseUrl;
    }
});