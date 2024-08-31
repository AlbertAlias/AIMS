function submitForm() {
    // Prevent the default form submission
    event.preventDefault();

    // Serialize form data
    var formData = $('#addUserForm').serialize();

    // Debug: Log the serialized data to the console
    console.log("Serialized Form Data: ", formData);
    
    $.ajax({
        url: 'controller/manage-user/add-users.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Server Response:', response);
            alert('User added successfully!');
            $('#addUserModal').modal('hide'); // Hide the modal
            $('#addUserForm')[0].reset(); // Reset the form
            location.reload(); // Reload the page to reflect changes
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            alert('Error adding user. Please try again.');
        }
    });
}

// Bind submitForm function to form submission
$(document).ready(function() {
    $('#addUserForm').on('submit', function(event) {
        submitForm(event); // Pass the event object here
    });
});