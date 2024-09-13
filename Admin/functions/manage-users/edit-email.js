$(document).ready(function() {
    // Function for OJT Students in manage-users.php
    $('#studentID').on('input', function() {
        var studentID = $(this).val();
        var emailDomain = '@aims.edu.ph';
        if ($('#user_type').val() === 'OJT Student') {
            $('#email').val(studentID + emailDomain);
        }
    });

    // Function for OJT Coordinator, OJT Supervisor, and Registrar in manage-users.php
    function updateEmailField(inputId) {
        var emailDomain = '@aims.edu.ph';
        var $emailField = $(inputId);

        $emailField.on('input', function() {
            var value = $(this).val();
            if (value.includes('@')) {
                var parts = value.split('@');
                if (parts.length > 1) {
                    $emailField.val(parts[0] + emailDomain);
                }
            } else {
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
