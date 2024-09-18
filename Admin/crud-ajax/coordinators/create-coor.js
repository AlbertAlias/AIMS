$(document).ready(function () {
    // Event listener for the form submission
    $('#coordinatorForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Prepare the form data
        var formData = $(this).serialize() + '&' + $('#accountInfoForm').serialize();
        console.log('Form Data:', formData); // Log form data to check if all fields are included

        // Handle the contact number prefix
        var contactNumber = $('#contact_number').val();
        if (contactNumber.length === 10 && contactNumber[0] !== '0') {
            contactNumber = '0' + contactNumber;
            $('#contact_number').val(contactNumber);
        }

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
                    $('#accountInfoForm')[0].reset();
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