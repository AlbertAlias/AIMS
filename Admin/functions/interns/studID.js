$(document).ready(function() {
    function formatStudentID(input) {
        var value = input.val().replace(/\D/g, ''); // Remove all non-numeric characters
        
        // Ensure the value is within the allowed length
        if (value.length > 7) {
            value = value.slice(0, 7);
        }

        // Add a hyphen after the first digit if there are more than 1 digit
        if (value.length > 1) {
            value = value.charAt(0) + '-' + value.slice(1);
        }

        // Set the formatted value back to the input field
        input.val(value);

        // Populate and lock account_email only if a valid student ID is provided
        if (value.length > 1) {
            $('#intern_account_email').val(value + '@aims.edu.ph').prop('disabled', true);
        } else if (value.length === 0) {
            $('#intern_account_email').val('');  // Clear the email field if no student ID is present
            // Optionally, decide if you want to keep it locked or unlocked when the student ID is cleared
            $('#intern_account_email').prop('disabled', true); // Keep it locked regardless of the student ID
        }
    }

    $('#studentID').on('input', function() {
        formatStudentID($(this));
    });

    // Prevent the user from typing more than 7 digits
    $('#studentID').on('keypress', function(e) {
        var currentLength = $(this).val().replace(/\D/g, '').length;
        if (currentLength >= 7 && e.which != 0 && e.which != 8) {
            e.preventDefault();
        }
    });
});