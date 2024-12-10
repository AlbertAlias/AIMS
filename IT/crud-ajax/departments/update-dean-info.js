$(document).ready(function() {
    // Handle the form submission for updating the dean
    $('#deanUpdateBtn').on('click', function(e) {
        e.preventDefault();

        var deanID = $('#deanID').val();
        var last_name = $('#add_last_name').val();
        var first_name = $('#add_first_name').val();
        var username = $('#add_username').val();

        // Send the update request via AJAX
        $.ajax({
            url: 'controller/departments/update-dean-info.php', // Your update script
            method: 'POST',
            data: {
                deanID: deanID,
                last_name: last_name,
                first_name: first_name,
                username: username
            },
            success: function(response) {
                console.log(response);  // Log the response for debugging
                if (response.success) {
                    alert('Dean updated successfully');
                    loadDeans();  // Refresh the dean list
                } else {
                    alert('Error: ' + (response.message || 'Unknown error'));
                }
        
                // Reset form and buttons
                $('#deanSubmitBtn').show();
                $('#deanUpdateBtn').hide();
                $('#deanCancelBtn').hide();
                $('#assignDeanForm')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error('Update failed:', error);
                alert('Error: Failed to update dean. Please try again later.');
            }
        });
    });
});
