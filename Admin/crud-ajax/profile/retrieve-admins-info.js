$(document).ready(function() {
    // Fetch user info when the page loads
    $.ajax({
        url: 'controller/profile/retrieve-admins-info.php',
        type: 'POST',
        data: { email: '<?php echo $_SESSION["email"]; ?>' },
        success: function(response) {
            var userInfo = JSON.parse(response);
            if (userInfo.status === 'success') {
                // Display user info on the page
                $('#users-name').text(userInfo.full_name);
                $('#users-location').text(userInfo.address);
                $('#users-civil-status').text(userInfo.civil_status);
                $('#users-email').text(userInfo.personal_email);
                $('#users-account-email').text(userInfo.account_email);

                // Populate modal fields with user information
                $('#editLastNameInput').val(userInfo.last_name);
                $('#editFirstNameInput').val(userInfo.first_name);
                $('#editMiddleNameInput').val(userInfo.middle_name || '');
                $('#editSuffixInput').val(userInfo.suffix || '');
                $('#editLocationInput').val(userInfo.address);
                $('#editCivilStatusInput').val(userInfo.civil_status);
                $('#editEmailInput').val(userInfo.personal_email);
                $('#editAccountEmailInput').val(userInfo.account_email);
            } else {
                $('#users-name').text('User not found');
            }
        },
        error: function() {
            $('#users-name').text('Error fetching user data');
        }
    });

    // Event listener for the old password input change
    $('#modalOldPassword').on('input', function() {
        var oldPassword = $(this).val(); // Get the value entered in the old password input
        
        $.ajax({
            url: 'controller/profile/retrieve-admins-info.php',
            type: 'POST',
            data: { oldPassword: oldPassword }, // Send old password for verification
            success: function(response) {
                var result = JSON.parse(response);
                var feedbackElement = $('#oldPasswordFeedback');
                
                if (result.status === 'success') {
                    feedbackElement.text(result.message).removeClass('text-danger').addClass('text-success');
                } else {
                    feedbackElement.text(result.message).removeClass('text-success').addClass('text-danger');
                }
            },
            error: function() {
                $('#oldPasswordFeedback').text("Error verifying password").addClass('text-danger');
            }
        });
    });

    // Check if New Password matches Confirm Password
    $('#modalNewPassword, #modalConfirmPassword').on('input', function() {
        var newPassword = $('#modalNewPassword').val();
        var confirmPassword = $('#modalConfirmPassword').val();
        var feedbackElement = $('#passwordFeedback');

        if (newPassword && confirmPassword) {
            if (newPassword === confirmPassword) {
                feedbackElement.text('Password match').removeClass('text-danger').addClass('text-success');
            } else {
                feedbackElement.text('Password doesn\'t match').removeClass('text-success').addClass('text-danger');
            }
        } else {
            feedbackElement.text('') // Clear feedback if fields are empty
        }
    });

    // Handle form submission for password change
    $('#changePasswordForm').submit(function(event) {
        event.preventDefault();

        var oldPassword = $('#modalOldPassword').val();
        var newPassword = $('#modalNewPassword').val();
        var confirmPassword = $('#modalConfirmPassword').val();

        // Handle the password change logic if everything is correct
        if (newPassword === confirmPassword) {
            // Proceed with password change logic
            alert('Password changed successfully!');
        } else {
            alert('Please ensure the new passwords match!');
        }
    });
});
