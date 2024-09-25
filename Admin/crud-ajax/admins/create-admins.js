function createAdmin() {
    // Capture form inputs
    const formData = {
        last_name: $("#admin_last_name").val().trim(),
        first_name: $("#admin_first_name").val().trim(),
        middle_name: $("#admin_middle_name").val().trim(),
        suffix: $("#admin_suffix").val().trim(),
        gender: $("#admin_gender").val(),
        address: $("#admin_address").val().trim(),
        birthdate: $("#admin_birthdate").val(),
        civil_status: $("#admin_civil_status").val(),
        contact_number: $("#admin_contact_number").val().trim(),
        personal_email: $("#admin_personal_email").val().trim(),
        account_email: $("#admin_account_email").val().trim(),
        password: $("#admin_password").val(),
        role: $("#role").val()
    };

    // Simple client-side validation
    if (Object.values(formData).some(value => !value)) {
        Swal.fire({
            icon: 'warning',
            title: 'Incomplete Fields',
            text: 'Please fill in all required fields.',
        });
        return;
    }

    // Disable the submit button to prevent multiple submissions
    $("#adminSubmitBtn").attr("disabled", true).text("Submitting...");

    // Perform the AJAX request
    $.ajax({
        type: 'POST',
        url: 'controller1.php',  // Replace with your PHP file
        data: { action: 'create_admin', ...formData },
        dataType: 'json',  // Expecting JSON response
        success: function(response) {
            if (response.exists) {
                Swal.fire({
                    icon: 'error',
                    title: 'Admin Exists',
                    text: 'An admin with this email already exists. Please try a different email.',
                });
            } else if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Admin Added',
                    text: 'The admin has been added successfully!',
                });
                disableAndResetAdminForms(); // Reset and lock forms after successful creation
                retrieveAdmins(); // Retrieve the list of admins
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Failed to create admin. Please try again.',
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to create admin. Please try again later.',
            });
            console.error('Error creating admin:', error);
        },
        complete: function() {
            $("#adminSubmitBtn").attr("disabled", false).text("Submit");
        }
    });
}