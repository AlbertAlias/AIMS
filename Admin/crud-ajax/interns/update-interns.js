$(document).ready(function() {
    $('#internUpdateBtn').off('click').on('click', function() {
        $('#internsForm input, #internsForm select').prop('disabled', false);

        // Collect form data
        const internID = $('#internID').val();
        const internLastName = $('#intern_last_name').val();
        const internFirstName = $('#intern_first_name').val();
        const internGender = $('#intern_gender').val();
        const studentID = $('#studentID').val();
        const internDepartment = $('#intern_department').val();  // department_id (e.g., 1)
        const internUsername = $('#intern_username').val();
        const internPassword = $('#intern_password').val();

        // Log department value for debugging
        console.log('Department ID selected:', internDepartment);

        const data = {
            id: internID,
            intern_last_name: internLastName,
            intern_first_name: internFirstName,
            intern_gender: internGender,
            studentID: studentID,
            intern_department: internDepartment,  // Now passing department ID
            intern_username: internUsername,
            intern_password: internPassword
        };

        $(this).prop('disabled', true);

        $.ajax({
            url: 'controller/interns/update-interns.php',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Intern updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    resetAndLockForms(); // Lock and reset the form after successful update
                    $('#internUpdateBtn').prop('disabled', true); // Disable the update button
                    $('#internCancelBtn').hide(); // Hide the cancel button
                    window.loadIntern(); // Reload intern data (optional, if needed)
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Error: ' + response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#ffcccb',
                        iconColor: '#c0392b',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An error occurred while updating intern data. Please try again.',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#ffcccb',
                    iconColor: '#c0392b',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            },
            complete: function() {
                $('#internUpdateBtn').prop('disabled', false);
            }
        });
    });

    function resetAndLockForms() {
        $('#internsForm input, #internsForm select').val('').prop('disabled', true);
        $('#internUpdateBtn').prop('disabled', true); // Disable update button after reset
        $('#internCancelBtn').hide(); // Hide cancel button after reset
    }
});