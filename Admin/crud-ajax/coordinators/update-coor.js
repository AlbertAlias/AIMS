$(document).ready(function() {
    $('#coorUpdateBtn').off('click').on('click', function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Disable the update button to prevent multiple submissions
        $(this).prop('disabled', true).hide();  // Hide the button immediately
        $('#coorDeleteBtn').hide(); // Hide the cancel button immediately
        $('#coorCancelBtn').hide();
        const coorSubmitBtn = $('#coorSubmitBtn');
        coorSubmitBtn.prop('disabled', true).show();

        // Prepare the form data
        var formData = $('#coordinatorForm').serialize() + '&' + $('#coor_accountForm').serialize();
        console.log('Update Form Data:', formData); // Log form data for debugging

        $.ajax({
            url: 'controller/coordinators/update-coor.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Coordinator updated successfully',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    }).then(() => {
                        loadCoordinators(); // Refresh the list of coordinators
                        disableAndResetForms(); // Call the function to disable and reset forms
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error: ' + response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    }).then(() => {
                        $('#coorUpdateBtn').prop('disabled', false).show(); // Show button again on error
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'An error occurred while processing the request',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c628c28',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                }).then(() => {
                    $('#coorUpdateBtn').prop('disabled', false).show(); // Re-enable update button
                });
            },
        });
    });
});