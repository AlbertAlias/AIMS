$(document).ready(function () {
    // Edit User
    $('#editButton').on('click', function () {
        var selectedId = getSelectedUserId();
        if (selectedId) {
            $.ajax({
                url: 'controller/manage-users/retrieve-users.php',
                type: 'POST',
                data: { id: selectedId },
                success: function (response) {
                    var user = JSON.parse(response); // Ensure the response is parsed correctly
                    populateForm(user);
                    $('#actionsModal').modal('show');
                },
                error: function () {
                    alert('Failed to retrieve user data.');
                }
            });
        } else {
            alert('Select a user to edit.');
        }
    });

    // Save changes (for edit)
    $('#saveChangesButton').on('click', function () {
        var formData = $('#userForm').serialize();
        $.ajax({
            url: 'controller/manage-users/update-users.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                alert('User updated successfully.');
                $('#actionsModal').modal('hide');
                loadTableData(); // Reload table data after update
            }
        });
    });

    // Helper function to get selected user ID
    function getSelectedUserId() {
        var selectedCheckbox = $('input.row-checkbox:checked');
        var selectedId = selectedCheckbox.data('id'); // Ensure this matches the attribute in your HTML
        return selectedId;
    }

    // Populate form with user data
    function populateForm(user) {
        $('#userId').val(user.id);
        $('#firstname').val(user.firstname);
        $('#lastname').val(user.lastname);
        $('#department').val(user.department);
        $('#company').val(user.company);
        $('#email').val(user.email);
        $('#user_type').val(user.user_type);
        $('#studentID').val(user.studentID);
        $('#password').val(user.password); // Set password field

        // Toggle field visibility and readonly status based on user type
        $('#user_type').trigger('change');

        if (user.user_type === 'OJT Student') {
            $('#email').prop('readonly', true);
        } else {
            $('#email').prop('readonly', false);
        }
    }
});

        // View User
    // $('#viewButton').on('click', function () {
    //     var selectedId = getSelectedUserId();
    //     if (selectedId) {
    //         $.ajax({
    //             url: 'controller/manage-users/view-users.php',
    //             type: 'POST',
    //             data: { id: selectedId },
    //             success: function (response) {
    //                 populateForm(response);
    //                 $('#actionsModal').modal('show');
    //             }
    //         });
    //     } else {
    //         alert('Select a user to view.');
    //     }
    // });