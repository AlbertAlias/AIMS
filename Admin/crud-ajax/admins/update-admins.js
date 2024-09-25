$(document).ready(function() {
    // Attach event listener for the Update button
    $('#adminUpdateBtn').click(function() {
        // Unlock the middle name and suffix fields before serialization
        $('#admin_middle_name').prop('disabled', false);
        $('#admin_suffix').prop('disabled', false);

        // Serialize the form data
        const formData = $('#adminsForm').serialize();

        $.ajax({
            url: 'controller/admins/update-admins.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#adminUpdateBtn').prop('disabled', true);
                $('#adminUpdateBtn').text('Updating...');
            },
            success: function(response) {
                if (response.success) {
                    alert('Admin updated successfully!');
                    window.loadAdmins(); // Reload admin list
                    $('#adminsForm')[0].reset(); // Reset the form
                    $('#adminUpdateBtn').hide();
                    $('#adminSubmitBtn').show();
                } else {
                    alert('Error: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Update failed:', error);
            },
            complete: function() {
                $('#adminUpdateBtn').prop('disabled', false);
                $('#adminUpdateBtn').text('Update');
            }
        });
    });
});