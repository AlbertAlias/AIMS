$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        // Get form data
        var username = $('#username').val();
        var password = $('#password').val();

        // AJAX request
        $.ajax({
            url: '../controller/login-users.php',
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
                        // Clear form fields after login success
                        $('#username').val('');
                        $('#password').val('');
                        // Redirection logic based on user type and department
                        if (user_type === 'developer' || user_type === 'admin') {
                            window.location.href = '../Admin/admin.php';
                        } else if (user_type === 'coordinator') {
                            // Redirection for coordinators based on department
                            switch (department.toLowerCase()) { // Ensure department comparison is case-insensitive
                                case 'accountancy':
                                    window.location.href = '../Coordinator/A/acoor.php';
                                    break;
                                case 'business administration':
                                    window.location.href = '../Coordinator/BA/bacoor.php';
                                    break;
                                case 'computer engineering':
                                    window.location.href = '../Coordinator/CpE/cpecoor.php';
                                    break;
                                case 'computer science':
                                    window.location.href = '../Coordinator/CS/cscoor.php';
                                    break;
                                case 'criminology':
                                    window.location.href = '../Coordinator/CRIM/crimcoor.php';
                                    break;
                                case 'education':
                                    window.location.href = '../Coordinator/EDUC/educcoor.php';
                                    break;
                                case 'hospitality management':
                                    window.location.href = '../Coordinator/HM/hmcoor.php';
                                    break;
                                case 'information technology':
                                    window.location.href = '../Coordinator/IT/itcoor.php';
                                    break;
                                case 'tourism management':
                                    window.location.href = '../Coordinator/TM/tmcoor.php';
                                    break;
                                default:
                                    alert('Invalid department.');
                            }
                        } else if (user_type === 'intern') {
                            // Redirection for interns based on department
                            switch (department.toLowerCase()) { // Ensure department comparison is case-insensitive
                                case 'accountancy':
                                    window.location.href = '../Intern/A/a.php';
                                    break;
                                case 'business administration':
                                    window.location.href = '../Intern/BA/ba.php';
                                    break;
                                case 'computer engineering':
                                    window.location.href = '../Intern/CpE/cpe.php';
                                    break;
                                case 'computer science':
                                    window.location.href = '../Intern/CS/cs.php';
                                    break;
                                case 'criminology':
                                    window.location.href = '../Intern/CRIM/crim.php';
                                    break;
                                case 'education':
                                    window.location.href = '../Intern/EDUC/educ.php';
                                    break;
                                case 'hospitality management':
                                    window.location.href = '../Intern/HM/hm.php';
                                    break;
                                case 'information technology':
                                    window.location.href = '../Intern/IT/it.php';
                                    break;
                                case 'tourism management':
                                    window.location.href = '../Intern/TM/tm.php';
                                    break;
                                default:
                                    alert('Invalid department.');
                            }
                        } else {
                            alert('Invalid user type or department.');
                        }
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
        if (response.status === 'invalid_email_format') {
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
                title: 'Email Does Not Exist',
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
    }
});