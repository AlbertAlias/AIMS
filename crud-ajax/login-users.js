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

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'You have logged in successfully',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    }).then(function() {
                        // After the alert is shown, perform the redirection based on user type or department
                        if (user_type === 'Admin' || user_type === 'Sub-Admin') {
                            window.location.href = '../Admin/admin.php';
                        } else if (user_type === 'Coordinator') {
                            window.location.href = '../Coordinator/coordinator.php';
                        } else if (user_type === 'Intern') {
                            // Redirect based on the intern's department
                            switch (department) {
                                case 'Accountancy':
                                    window.location.href = '../Intern/A/a.php';
                                    break;
                                case 'Business Administration':
                                    window.location.href = '../Intern/BA/ba.php';
                                    break;
                                case 'Computer Engineering':
                                    window.location.href = '../Intern/CpE/cpe.php';
                                    break;
                                case 'Criminology':
                                    window.location.href = '../Intern/CRIM/crim.php';
                                    break;
                                case 'Computer Science':
                                    window.location.href = '../Intern/CS/cs.php';
                                    break;
                                case 'Education':
                                    window.location.href = '../Intern/EDUC/educ.php';
                                    break;
                                case 'Hospitality Management':
                                    window.location.href = '../Intern/HM/hm.php';
                                    break;
                                case 'Information Technology':
                                    window.location.href = '../Intern/IT/it.php';
                                    break;
                                case 'Tourism Management':
                                    window.location.href = '../Intern/TM/tm.php';
                                    break;
                                default:
                                    alert('Invalid department.');
                            }
                        } else {
                            alert('Invalid user type or department.');
                        }
                    });
                } else if (response.status === 'invalid_email_format') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Invalid Email Format',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#ffebee',
                        iconColor: '#c62828',
                        color: '#d32f2f'
                    });
                } else if (response.status === 'email_not_found') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Email Not Does Not Exist',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#ffebee',
                        iconColor: '#c62828',
                        color: '#d32f2f'
                    });
                } else if (response.status === 'password_not_found') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Invalid Password',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#ffebee',
                        iconColor: '#c62828',
                        color: '#d32f2f'
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error',
                        text: 'An unknown error occurred. Please try again later.',
                        background: '#ffebee',
                        iconColor: '#c62828',
                        color: '#d32f2f'
                    });
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
});