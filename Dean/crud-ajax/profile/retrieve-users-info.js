$(document).ready(function () {
    $.ajax({
        url: 'controller/profile/retrieve-users-info.php',
        type: 'POST',
        data: { username: '<?php echo $_SESSION["username"]; ?>' },
        success: function (response) {
            var userInfo = JSON.parse(response);
            if (userInfo.status === 'success') {
                $('#users-name').text(userInfo.full_name);
                $('#users-location').text(userInfo.address);
                $('#users-gender').text(userInfo.gender);
                $('#users-email').text(userInfo.email);
                $('#users-username').text(userInfo.username);
                $('#editLastNameInput').val(userInfo.last_name);
                $('#editFirstNameInput').val(userInfo.first_name);
                $('#editMiddleNameInput').val(userInfo.middle_name || '');
                $('#editLocationInput').val(userInfo.address);
                $('#editGenderInput').val(userInfo.gender);
                $('#editEmailInput').val(userInfo.email);
                $('#editUsernameInput').val(userInfo.username);
            } else {
                $('#users-name').text('User not found');
            }
        },
        error: function () {
            $('#users-name').text('Error fetching user data');
        }
    });

    $('#modalOldPassword').on('input', function () {
        var oldPassword = $(this).val();

        $.ajax({
            url: 'controller/profile/retrieve-users-info.php',
            type: 'POST',
            data: { oldPassword: oldPassword },
            success: function (response) {
                var result = JSON.parse(response);
                var feedbackElement = $('#oldPasswordFeedback');

                if (result.status === 'success') {
                    feedbackElement.text(result.message).removeClass('text-danger').addClass('text-success');
                } else {
                    feedbackElement.text(result.message).removeClass('text-success').addClass('text-danger');
                }
            },
            error: function () {
                $('#oldPasswordFeedback').text("Error verifying password").addClass('text-danger');
            }
        });
    });

    $('#modalNewPassword, #modalConfirmPassword').on('input', function () {
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
            feedbackElement.text('');
        }
    });

    $('#changePasswordForm').submit(function (event) {
        event.preventDefault();

        var oldPassword = $('#modalOldPassword').val();
        var newPassword = $('#modalNewPassword').val();
        var confirmPassword = $('#modalConfirmPassword').val();

        if (newPassword === confirmPassword) {
            alert('Password changed successfully!');
        } else {
            alert('Please ensure the new passwords match!');
        }
    });
});