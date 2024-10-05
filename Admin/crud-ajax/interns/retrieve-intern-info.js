function fetchInternInfo(internId) {
    $.ajax({
        url: 'controller/interns/retrieve-intern-info.php',
        method: 'GET',
        data: { id: internId },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.error);
            } else {
                // Populate the form with the fetched intern data
                $('#internID').val(response.id);
                $('#intern_last_name').val(response.last_name);
                $('#intern_first_name').val(response.first_name);
                $('#intern_middle_name').val(response.middle_name);
                $('#intern_suffix').val(response.suffix);
                $('#intern_gender').val(response.gender);
                $('#intern_address').val(response.address);
                $('#intern_birthdate').val(response.birthdate);
                $('#intern_civil_status').val(response.civil_status);
                $('#intern_personal_email').val(response.personal_email);
                $('#intern_contact_number').val(response.contact_number);
                $('#studentID').val(response.studentID);
                $('#intern_department').val(response.department_id);
                $('#intern_account_email').val(response.account_email).prop('disabled', true);
                $('#intern_password').val(response.password).prop('disabled', true);

                // Enable the intern form
                internBtnFormToggle(true);
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to load intern information:', error);
            alert('Failed to load intern information.');
        }
    });
}

// Event listener for intern buttons
$(document).on('click', '.intern-btn', function() {
    const internId = $(this).data('id');
    
    // Reset and unlock the intern form
    internBtnFormToggle(false);
    fetchInternInfo(internId);
});