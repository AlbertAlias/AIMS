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

$(document).ready(function() {
    // Initialize the email field function
    updateEmailField('#coor_account_email');
});