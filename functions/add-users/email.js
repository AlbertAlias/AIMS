$(document).ready(function() {
    // Existing function for OJT Students
    $('#studentID').on('input', function() {
        var studentID = $(this).val();
        var emailDomain = '@aims.edu.ph';
        if ($('input[name="userRole"]:checked').val() === 'OJT Student') {
            $('#studentEmail').val(studentID + emailDomain);
        }
    });

    // New function for OJT Coordinator, OJT Supervisor, and Registrar
    function updateEmailField(inputId) {
        var emailDomain = '@aims.edu.ph';
        var $emailField = $(inputId);

        $emailField.on('input', function() {
            var value = $(this).val();
            if (value.includes('@')) {
                // Split the email input by '@'
                var parts = value.split('@');
                if (parts.length > 1) {
                    // Set the value to the part before '@' plus the domain
                    $emailField.val(parts[0] + emailDomain);
                }
            } else {
                // Set the email field value to what the user has typed
                $emailField.val(value);
            }
        });
    }

    // Apply the function to each relevant email field
    updateEmailField('#coordinatorEmail');
    updateEmailField('#supervisorEmail');
    updateEmailField('#registrarEmail');

    // Trigger input event on page load to initialize state for student email
    $('#studentID').trigger('input');
});