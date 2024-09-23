$('#adminsForm').on('submit', function (e) {
    e.preventDefault();

    // Enable all fields before serialization
    $('#adminsForm input:disabled, #adminsForm select:disabled').prop('disabled', false);

    var formData = $(this).serialize() + '&' + $('#admin_accountForm').serialize();
    console.log('Form Data:', formData);

    $.ajax({
        url: 'controller/admins/create-admins.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            console.log('AJAX response:', response);
            if (response.success) {
                alert('Admin added successfully!');
                disableAndResetForms();
                loadAdmins(); // Ensure this function is defined and called correctly
            } else {
                alert('Failed to add admin: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            console.log('Response Text:', xhr.responseText);
            alert('An error occurred while processing the request: ' + xhr.responseText);
        },
        complete: function () {
            disableAndResetForms();
            $('#adminsForm input').prop('disabled', true);
            $('#adminsForm select').prop('disabled', true);
        }
    });
});