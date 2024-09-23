$(document).ready(function () {
    // Event listener for the Update button
    $('#internUpdateBtn').on('click', function () {
        console.log('Update button clicked');

        const internID = $('#internID').val(); // Ensure you're using the correct ID

        // Validate the birthdate format
        const birthdate = $('#intern_birthdate').val();
        if (!birthdate || birthdate === "0000-00-00") {
            alert("Invalid birthdate. Please enter a valid date.");
            return;
        }

        // Collect the form data
        const data = {
            id: internID,
            intern_last_name: $('#intern_last_name').val(),
            intern_first_name: $('#intern_first_name').val(),
            intern_middle_name: $('#intern_middle_name').val(),
            intern_suffix: $('#intern_suffix').val(),
            intern_gender: $('#intern_gender').val(),
            intern_address: $('#intern_address').val(),
            birthdate: birthdate,
            intern_civil_status: $('#intern_civil_status').val(),
            intern_personal_email: $('#intern_personal_email').val(),
            intern_contact_number: $('#intern_contact_number').val(),
            studentID: $('#studentID').val(),
            intern_department: $('#intern_department').val(),
            coordinator_name: $('#coordinator_name').val(),
            hours_needed: $('#hours_needed').val(),
            coordinator_email: $('#coordinator_email').val(),
            internship_status: $('#internship_status').val(),
            intern_account_email: $('#intern_account_email').val(),
            intern_password: $('#intern_password').val()
        };

        // Log the data to be sent
        console.log('Data to be sent:', data);

        // Perform AJAX call
        $.ajax({
            url: 'controller/interns/update-interns.php',
            method: 'POST',
            data: data,
            dataType: 'json', // Expect JSON response from the server
            success: function (response) {
                console.log(response);
                if (response.success) {
                    alert('Intern updated successfully!');
                    disableAndResetForms();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('An error occurred while updating intern data. Please try again.');
            }
        });
    });
});