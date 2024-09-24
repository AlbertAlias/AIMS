$(document).ready(function () {
    let isSubmitting = false;

    // Remove any previous submit event listener and add a new one
    $('#internsForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        // If already submitting, do not proceed
        if (isSubmitting) {
            return;
        }

        // Set the isSubmitting flag to true
        isSubmitting = true;
        $('#internSubmitBtn').prop('disabled', true);

        // Enable the necessary fields
        $('#intern_accountForm input:disabled').prop('disabled', false);
        $('#internsForm input:disabled, #internsForm select:disabled').prop('disabled', false);

        var formData = $(this).serialize() + '&' + $('#intern_accountForm').serialize();
        console.log('Form Data:', formData);

        $.ajax({
            url: 'controller/interns/create-interns.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log('AJAX response:', response);
                if (response.success) {
                    // SweetAlert for successful intern creation
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
                    });

                    disableAndResetForms();
                    loadInterns();
                } else {
                    alert('Failed to add intern: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText);
                alert('An error occurred while processing the request: ' + xhr.responseText);
            },
            complete: function () {
                disableAndResetForms();
                $('#internsForm input').prop('disabled', true);
                $('#internsForm select').prop('disabled', true);
                $('#intern_accountForm input').prop('disabled', true);
                $('#internSubmitBtn').prop('disabled', false);
                isSubmitting = false; // Reset the submitting flag
            }
        });
    });
});