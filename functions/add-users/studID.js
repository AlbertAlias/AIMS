// $(document).ready(function() {
//     function formatStudentID(input) {
//         var value = input.val().replace(/\D/g, ''); // Remove all non-numeric characters
        
//         // Ensure the value is within the allowed length
//         if (value.length > 7) {
//             value = value.slice(0, 7);
//         }

//         // Add a hyphen after the first digit if there are more than 1 digit
//         if (value.length > 1) {
//             value = value.charAt(0) + '-' + value.slice(1);
//         }

//         // Set the formatted value back to the input field
//         input.val(value);
//     }

//     $('#studentID').on('input', function() {
//         formatStudentID($(this));
//     });
// });

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
