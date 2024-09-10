function editSelected() {
    var userId = $(this).data('id'); // Get the user ID from the button data attribute
    $.ajax({
        url: 'controller/manage-users/editUsers-fetch.php',
        type: 'GET',
        data: { id: userId },
        success: function(response) {
            if (response.success) {
                var user = response.user;
                $('#editUserId').val(user.id);
                $('#editFirstName').val(user.firstname);
                $('#editLastName').val(user.lastname);
                $('#editDepartment').val(user.department);
                $('#editStudentID').val(user.studentID);
                $('#editCompany').val(user.company);
                $('#editEmail').val(user.email);
                $('#editPassword').val(''); // Don't pre-fill password
                $('#editUserType').val(user.user_type);
                $('#editUserContainer').removeClass('d-none');
            } else {
                alert('Failed to load user data.');
            }
        }
    });
}

// Save edited user information
$('#editUserForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'controller/manage-users/update-users.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                alert('User updated successfully.');
                $('#editUserContainer').addClass('d-none');
                location.reload(); // Reload the table data
            } else {
                alert('Failed to update user.');
            }
        }
    });
});

// Cancel edit and hide the form
function cancelEdit() {
    $('#editUserContainer').addClass('d-none');
}