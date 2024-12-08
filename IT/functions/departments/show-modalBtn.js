$(document).ready(function() {
    // When any checkbox with the class 'userCheckbox' is clicked
    $(document).on('change', '.userCheckbox', function() {
        // Check if at least one checkbox is checked
        var isChecked = $('.userCheckbox:checked').length > 0;

        // Toggle the visibility of buttons based on checkbox selection
        if (isChecked) {
            // Show Edit Dept and Edit Dean buttons, hide Add Dept and Assign Dean buttons
            $('.btn[aria-label="Edit Dept"]').show();
            $('.btn[aria-label="Edit Dean"]').show();
            $('.btn[aria-label="Add Department"]').hide();
            $('.btn[aria-label="Assign Dean"]').hide();
        } else {
            // If no checkboxes are checked, show Add Dept and Assign Dean buttons, hide Edit Dept and Edit Dean buttons
            $('.btn[aria-label="Edit Dept"]').hide();
            $('.btn[aria-label="Edit Dean"]').hide();
            $('.btn[aria-label="Add Department"]').show();
            $('.btn[aria-label="Assign Dean"]').show();
        }
    });
});
