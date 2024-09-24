$(document).ready(function () {
    $('#coordinatorForm').off('submit').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Prepare the form data
        var formData = $(this).serialize() + '&' + $('#coor_accountForm').serialize();
        console.log('Form Data:', formData); // Log form data to check if all fields are included

        // Disable the submit button to prevent multiple submissions
        $('#coorSubmitBtn').prop('disabled', true);

        // Lock the form fields after submission
        $('#coordinatorForm input, #coordinatorForm select').prop('disabled', true);
        $('#coor_accountForm input').prop('disabled', true);

        // Reset the form before making the AJAX request
        $('#coordinatorForm')[0].reset();
        $('#coor_accountForm')[0].reset();

        $.ajax({
            url: 'controller/coordinators/create-coor.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                // Check the response for success or failure
                if (response.success) {
                    // Show success SweetAlert
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Coordinator created successfully',
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
                    // Show error SweetAlert
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
                        // Re-enable the submit button if there's an error
                        $('#coorSubmitBtn').prop('disabled', false);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText); // Log response text for debugging
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'An error occurred while processing the request',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                }).then(() => {
                    // Re-enable the submit button in case of an error
                    $('#coorSubmitBtn').prop('disabled', false);
                });
            },
            complete: function() {
                // Re-enable the submit button after the request is complete
                $('#coorSubmitBtn').prop('disabled', false);
            }
        });
    });
});