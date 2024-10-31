$(document).ready(function() {
    // Existing function to retrieve admin user details
    $.ajax({
        url: 'controller/profile/retrieve-admin-users.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && response.status === 'success') {
                $('#welcomeAdmin').html(`
                    <span class="fw-bold text-dark bg-light">Welcome</span> 
                    <span>${response.first_name} ${response.last_name}</span>
                `);
            } else if (response.status === 'expired') {
                alert('Session expired. Please log in again.');
                window.location.href = 'index.php'; // Redirect to login page
            } else {
                console.error('Failed to retrieve user details. Response:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching user details:', xhr.responseText);
            if (xhr.status === 401) { // Unauthorized
                alert('Session expired. Please log in again.');
                window.location.href = 'index.php';
            }
        }
    });
});