$(document).ready(function() {
    $('.btn.btn-sm.btn-primary').on('click', function() {
        var lastName = $('#editLastNameInput').val();
        var firstName = $('#editFirstNameInput').val();
        var middleName = $('#editMiddleNameInput').val();
        var suffix = $('#editSuffixInput').val();
        var location = $('#editLocationInput').val();
        var civilStatus = $('#editCivilStatusInput').val();
        var personalEmail = $('#editEmailInput').val();
        var accountEmail = $('#editAccountEmailInput').val();
        
        if (lastName == "" || firstName == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Last Name and First Name are required.'
            });
            return;
        }

        $.ajax({
            url: 'controller/profile/update-admins-info.php',
            type: 'POST',
            data: {
                last_name: lastName,
                first_name: firstName,
                middle_name: middleName,
                suffix: suffix,
                address: location,
                civil_status: civilStatus,
                personal_email: personalEmail,
                account_email: accountEmail
            },
            success: function(response) {
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
                            popup: 'mt-5'
                        }
                    });
                    // Close all modals
                    $('#editNameModal').modal('hide');
                    $('#editLocationModal').modal('hide');
                    $('#editCivilStatusModal').modal('hide');
                    $('#editEmailModal').modal('hide');
                    $('#editAccountEmailModal').modal('hide');
                    // Refresh user info
                    refreshUserInfo();
                    loadAdmins();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error updating information',
                        text: res.message
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + ": " + error);
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred',
                    text: 'An error occurred while updating the information.'
                });
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
                $('#users-name').text(userInfo.full_name);
                $('#users-location').text(userInfo.address);
                $('#users-civil-status').text(userInfo.civil_status);
                $('#users-email').text(userInfo.personal_email);
                $('#users-account-email').text(userInfo.account_email);
                $('#welcomeAdmin').html(`
                    <span class="fw-bold text-dark bg-light">Welcome</span> 
                    <span>${userInfo.last_name} ${userInfo.first_name}</span>
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