function updateRoleOptions() {
    $.ajax({
        url: 'controller/add-users.php/retrieve-registrar.php',  // URL of the PHP script that checks Registrar count
        type: 'GET',
        success: function(response) {
            if (response === 'exists') {
                $('#roleRegistrar').prop('disabled', true); // Disable Registrar option if it already exists
                $('#roleRegistrar').parent().hide(); // Hide the Registrar option
            } else {
                $('#roleRegistrar').prop('disabled', false); // Enable Registrar option if it does not exist
                $('#roleRegistrar').parent().show(); // Show the Registrar option
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}

function serializeFormData(userRole) {
    let formData = {};
    
    // Collect data from the form based on user role
    switch(userRole) {
        case 'OJT Student':
            formData = {
                firstname: $('#studentFirstName').val(),
                lastname: $('#studentLastName').val(),
                department: $('#studentDepartment').val(),
                studentID: $('#studentID').val(),
                company: '', // OJT Student doesn't have a company field
                email: $('#studentEmail').val(),
                password: $('#studentPassword').val(),
                user_type: 'OJT Student'
            };
            break;
        case 'OJT Coordinator':
            formData = {
                firstname: $('#coordinatorFirstName').val(),
                lastname: $('#coordinatorLastName').val(),
                department: $('#coordinatorDepartment').val(),
                studentID: '', // OJT Coordinator doesn't have studentID field
                company: '', // OJT Coordinator doesn't have a company field
                email: $('#coordinatorEmail').val(),
                password: $('#coordinatorPassword').val(),
                user_type: 'OJT Coordinator'
            };
            break;
        case 'OJT Supervisor':
            formData = {
                firstname: $('#supervisorFirstName').val(),
                lastname: $('#supervisorLastName').val(),
                department: '', // OJT Supervisor doesn't have a department field
                studentID: '', // OJT Supervisor doesn't have a studentID field
                company: '', // OJT Supervisor doesn't have a company field
                email: $('#supervisorEmail').val(),
                password: $('#supervisorPassword').val(),
                user_type: 'OJT Supervisor'
            };
            break;
        case 'Registrar':
            formData = {
                firstname: $('#registrarFirstName').val(),
                lastname: $('#registrarLastName').val(),
                department: '', // Registrar doesn't have a department field
                studentID: '', // Registrar doesn't have a studentID field
                company: '', // Registrar doesn't have a company field
                email: $('#registrarEmail').val(),
                password: $('#registrarPassword').val(),
                user_type: 'Registrar'
            };
            break;
        default:
            console.error('Unknown user role:', userRole);
            return null;
    }

    return formData;
}

function validateEmail(email) {
    // Check if email contains @aims.edu.ph
    return email.endsWith('@aims.edu.ph');
}

// Function to submit form data
function submitForm(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get selected user role
    const userRole = $('input[name="userRole"]:checked').val();

    if (!userRole) {
        alert('Please select a user role.');
        return;
    }

    // Serialize form data based on selected user role
    const formData = serializeFormData(userRole);

    // Check if formData is valid
    if (!formData) {
        alert('Error serializing form data.');
        return;
    }

    // Validate email based on user role
    if (userRole !== 'OJT Student' && !validateEmail(formData.email)) {
        alert('Please enter a valid email address with @aims.edu.ph.');
        return;
    }

    // AJAX request to send form data to the server
    $.ajax({
        url: 'controller/add-users/create-users.php',  // URL of the PHP script
        type: 'POST',          // Request type
        data: formData,        // Data to be sent
        success: function(response) {
            // Handle success response
            alert('User added successfully.');
            // Optionally, reset form fields or reload the page
            location.reload();
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error:', status, error);
            alert('Failed to add user. Please try again.');
        }
    });
}

// Attach submitForm function to the form submit event
$(document).ready(function() {
    updateRoleOptions();
    // Attach event listeners for user role selection
    $('input[name="userRole"]').change(function() {
        const userRole = $(this).val();
        $('.form-container').hide(); // Hide all forms initially

        // Show the form based on selected user role
        switch(userRole) {
            case 'OJT Student':
                $('#studentForm').show();
                break;
            case 'OJT Coordinator':
                $('#coordinatorForm').show();
                break;
            case 'OJT Supervisor':
                $('#supervisorForm').show();
                break;
            case 'Registrar':
                $('#registrarForm').show();
                break;
        }
    });

    // Attach submitForm function to each form's submit event
    $('form').submit(submitForm);
});
