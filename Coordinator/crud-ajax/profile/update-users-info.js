$(document).ready(function () {
    // Update admin information
    $('.update-profile-info').on('click', function () {
        // Gather updated values
        var lastName = $('#editLastNameInput').val();
        var firstName = $('#editFirstNameInput').val();
        var middleName = $('#editMiddleNameInput').val();
        var location = $('#editLocationInput').val();
        var gender = $('#editGenderInput').val();
        var email = $('#editEmailInput').val();
        var username = $('#editUsernameInput').val();

        if (!lastName || !firstName) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Error',
                text: 'Last name and First name are required.',
                showConfirmButton: false,
                timer: 3000,
                background: '#f8bbd0',
                iconColor: '#c62828',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5',
                }
            });
            return;
        }

        // Send AJAX request to update information
        $.ajax({
            url: 'controller/profile/update-users-info.php',
            type: 'POST',
            data: {
                last_name: lastName,
                first_name: firstName,
                middle_name: middleName,
                address: location,
                gender: gender,
                email: email,
                username: username
            },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Information updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5',
                        }
                    });
                    // Close all modals
                    $('.modal').modal('hide');
                    refreshUserInfo();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Error updating information',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5',
                        }
                    });
                }
            },
            error: function () {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An error occurred',
                    text: 'An error occurred while updating the information.',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5',
                    }
                });
            }
        });
    });

    // Change password form submission
    $('#changePasswordForm').submit(function (event) {
        event.preventDefault();

        const oldPassword = $('#modalOldPassword').val();
        const newPassword = $('#modalNewPassword').val();
        const confirmPassword = $('#modalConfirmPassword').val();

        if (newPassword !== confirmPassword) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Error',
                text: "New passwords don't match.",
                showConfirmButton: false,
                timer: 3000,
                background: '#f8bbd0',
                iconColor: '#c62828',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5',
                }
            });
            return;
        }

        $.ajax({
            url: 'controller/profile/update-admins-info.php',
            type: 'POST',
            data: {
                old_password: oldPassword,
                new_password: newPassword
            },
            success: function (response) {
                const res = JSON.parse(response);
                if (res.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Password changed successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5',
                        }
                    });
                    $('#changePasswordModal').modal('hide');
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Error',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5',
                        }
                    });
                }
            },
            error: function () {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update password. Please try again.',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5',
                    }
                });
            }
        });
    });
});

// Refresh user info
function refreshUserInfo() {
    $.ajax({
        url: 'controller/profile/retrieve-users-info.php',
        type: 'POST',
        success: function (response) {
            var userInfo = JSON.parse(response);
            if (userInfo.status === 'success') {
                $('#users-name').text(userInfo.full_name);
                $('#users-location').text(userInfo.address);
                $('#users-gender').text(userInfo.gender);
                $('#users-email').text(userInfo.email);
                $('#users-username').text(userInfo.username);
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'Error fetching user data',
                    text: userInfo.message,
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5',
                    }
                });
            }
        },
        error: function () {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Error fetching user data',
                text: 'An error occurred while retrieving user information.',
                showConfirmButton: false,
                timer: 3000,
                background: '#f8bbd0',
                iconColor: '#c62828',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5',
                }
            });
        }
    });
}

$(document).ready(function () {
    refreshUserInfo();
});