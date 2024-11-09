$(document).ready(function() {
    // On clicking the update button in the modal
    $('.btn.btn-sm.btn-primary').on('click', function() {
        // Get the values from the input fields
        var lastName = $('#editLastNameInput').val();
        var firstName = $('#editFirstNameInput').val();
        var middleName = $('#editMiddleNameInput').val();
        var suffix = $('#editSuffixInput').val();

        // Ensure that lastName and firstName are not empty (required fields)
        if (lastName == "" || firstName == "") {
            alert("Last Name and First Name are required.");
            return;
        }

        // Prepare data to be sent to the server
        var userId = 1; // Assuming you're updating the admin (You can fetch dynamically)

        // Log data before sending the AJAX request
        console.log({
            user_id: userId,
            last_name: lastName,
            first_name: firstName,
            middle_name: middleName,  // Can be empty
            suffix: suffix  // Can be empty
        });

        // AJAX request to send data to PHP script
        $.ajax({
            url: 'controller/profile/update-admins-info.php', // PHP script to handle the update
            type: 'POST',
            data: {
                user_id: userId,
                last_name: lastName,
                first_name: firstName,
                middle_name: middleName,  // Can be empty
                suffix: suffix  // Can be empty
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.success) {
                    // Update was successful, close the modal and show a success message
                    alert("Name updated successfully!");
                    $('#editNameModal').modal('hide'); // Close the modal
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
