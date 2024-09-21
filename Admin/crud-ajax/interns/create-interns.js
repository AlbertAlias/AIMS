$(document).ready(function () {
    $('#internsForm').on('submit', function (e) {
        e.preventDefault();

        // Prepare the form data
        var formData = $(this).serialize() + '&' + $('#accountInfoForm').serialize();
        console.log('Form Data:', formData);

        // Handle the contact number prefix
        var contactNumber = $('#contact_number').val();
        if (contactNumber.length === 10 && contactNumber[0] !== '0') {
            contactNumber = '0' + contactNumber;
            $('#contact_number').val(contactNumber);
        }

        $.ajax({
            url: 'controller/interns/create-interns.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert('Interns added successfully!');
                    loadInterns();
                    disableAndResetForms();
                    
                    // Clear the form inputs
                    $('#internsForm')[0].reset();
                    $('#accountInfoForm')[0].reset();
                } else {
                    alert('Failed to add interns: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText);
                alert('An error occurred while processing the request.');
            }
        });
    });
});