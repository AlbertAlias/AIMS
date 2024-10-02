$(document).on('click', '.intern-btn', function() {
    var internId = $(this).data('id');

    $.ajax({
        url: 'controller/interns/retrieve-intern-info.php', // This is the PHP script that will handle the request
        type: 'POST',
        data: { id: internId },
        dataType: 'json',
        success: function(response) {
            console.log(response); // Log the response to check its structure
            if (response.success) {
                // Populate the form fields with the retrieved data
                $('#internID').val(response.data.user.id);
                $('#intern_last_name').val(response.data.user.last_name);
                $('#intern_first_name').val(response.data.user.first_name);
                $('#intern_middle_name').val(response.data.user.middle_name);
                $('#intern_suffix').val(response.data.user.suffix);
                $('#intern_gender').val(response.data.user.gender);
                $('#intern_address').val(response.data.user.address);
                $('#intern_birthdate').val(response.data.user.birthdate);
                $('#intern_civil_status').val(response.data.user.civil_status);
                $('#intern_personal_email').val(response.data.user.personal_email);
                $('#intern_contact_number').val(response.data.user.contact_number);
                $('#studentID').val(response.data.intern.studentID);
                $('#intern_department').val(response.data.user.department_id); // Make sure to fetch department name if necessary
                $('#coordinator_name').val(response.data.intern.coordinator_name);
                $('#hours_needed').val(response.data.intern.hours_needed);
                $('#coordinator_email').val(response.data.intern.coordinator_email);
                $('#internship_status').val(response.data.intern.internship_status);
                $('#intern_account_email').val(response.data.user.account_email);
                $('#intern_password').val(response.data.user.password);

                // Enable the form fields
                $('#internsForm input, #internsForm select').prop('disabled', false);
                $('#coordinator_name').prop('disabled', true);
                $('#coordinator_email').prop('disabled', true);
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + error);
            console.error('Response Text: ' + xhr.responseText);
            alert('An error occurred while retrieving intern data. Please try again.');
        }        
    });
});