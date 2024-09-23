$(document).ready(function () {
    // Event listener for the form submission
    $('#coordinatorForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Prepare the form data
        var formData = $(this).serialize() + '&' + $('#coor_accountForm').serialize();
        console.log('Form Data:', formData); // Log form data to check if all fields are included

        $.ajax({
            url: 'controller/coordinators/create-coor.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert('Coordinator added successfully!');
                    loadCoordinators(); // Assuming this function refreshes the list of coordinators
                    disableAndResetForms(); // Call the function to disable and reset forms
                    
                    // Clear the form inputs
                    $('#coordinatorForm')[0].reset();
                    $('#coor_accountForm')[0].reset();
                } else {
                    alert('Failed to add coordinator: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText); // Log response text for debugging
                alert('An error occurred while processing the request.');
            }
        });
    });
});