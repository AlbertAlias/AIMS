$(document).ready(function() {
    $.ajax({
        url: 'controller/profile/retrieve-admin-users.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && response.status === 'success') {
                $('#welcomeAdmin').html(`
                    <span class="fw-bold text-dark bg-light">Welcome Admin,</span> 
                    <span>${response.first_name} ${response.last_name}</span>
                `);
            } else {
                console.error('Failed to retrieve user details. Response:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching user details:', xhr.responseText);
        }
    });
});