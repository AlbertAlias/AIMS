// New function for updating email field
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

$(document).ready(function() {
    // Initialize the email field function
    updateEmailField('#account-email');
});
