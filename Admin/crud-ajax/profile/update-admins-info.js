$(document).ready(function() {
    $('.btn.btn-sm.btn-primary').on('click', function() {
        var lastName = $('#editLastNameInput').val();
        var firstName = $('#editFirstNameInput').val();
        var middleName = $('#editMiddleNameInput').val();
        var suffix = $('#editSuffixInput').val();
    
        if (lastName == "" || firstName == "") {
            alert("Last Name and First Name are required.");
            return;
        }
    
        $.ajax({
            url: 'controller/profile/update-admins-info.php',
            type: 'POST',
            data: {
                last_name: lastName,
                first_name: firstName,
                middle_name: middleName,
                suffix: suffix
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.success) {
                    alert("Name updated successfully!");
                    $('#editNameModal').modal('hide');
                    refreshUserInfo();
                    loadAdmins();
                } else {
                    alert("Error updating name: " + res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + ": " + error);
                alert("An error occurred while updating the name.");
            }
        });
    });
});

function refreshUserInfo() {
    $.ajax({
        url: 'controller/profile/retrieve-admins-info.php',
        type: 'POST',
        data: { email: '<?php echo $_SESSION["email"]; ?>' },
        success: function(response) {
            var userInfo = JSON.parse(response);
            if (userInfo.status === 'success') {
                // Update various sections of the page with new info
                $('#users-name').text(userInfo.full_name);
                $('#welcomeAdmin').html(`
                    <span class="fw-bold text-dark bg-light">Welcome</span> 
                    <span>${userInfo.last_name} ${userInfo.first_name} </span>
                `);
            } else {
                $('#users-name').text('User not found');
                $('#welcomeAdmin').text('Welcome, User not found');
            }
        },
        error: function() {
            $('#users-name').text('Error fetching user data');
            $('#welcomeAdmin').text('Error fetching user data');
        }
    });
}

$(document).ready(function() {
    refreshUserInfo();
});