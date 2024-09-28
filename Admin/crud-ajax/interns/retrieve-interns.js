$(document).ready(function() {
    window.loadInterns = function() {
        $.ajax({
            url: 'controller/interns/retrieve-interns.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let internsInfo = $('#internsInfo');
                internsInfo.empty();
                if (response.error) {
                    internsInfo.append(`<p>${response.error}</p>`);
                } else {
                    response.forEach(function(intern) {
                        console.log(intern);
                        let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 intern-btn" data-id="${intern.id}">
                                        ${intern.last_name}, ${intern.first_name}
                                    </button>`;
                        internsInfo.append(btn);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load interns:', error);
            }
        });
    };
    
    loadInterns();
    
    window.loadInternInfo = function(id) {
        $.ajax({
            url: 'controller/interns/retrieve-intern-info.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Error:', response.error);
                    return;
                }

                $('#interns_id').val(response.id);
                $('#intern_first_name').val(response.first_name).prop('disabled', false);
                $('#intern_last_name').val(response.last_name).prop('disabled', false);
                $('#intern_middle_name').val(response.middle_name).prop('disabled', false);
                $('#intern_suffix').val(response.suffix).prop('disabled', false);
                $('#intern_address').val(response.address).prop('disabled', false);
                $('#intern_birthdate').val(response.birthdate).prop('disabled', false);
                $('#intern_personal_email').val(response.personal_email).prop('disabled', false);
                $('#intern_contact_number').val(response.contact_number).prop('disabled', false);
                $('#intern_gender').val(response.gender).prop('disabled', false);
                $('#intern_civil_status').val(response.civil_status).prop('disabled', false);
                $('#intern_account_email').val(response.account_email).prop('disabled', true);
                $('#intern_password').val(response.password).prop('disabled', true);
                $('#internSubmitBtn').prop('disabled', false);
                
                const departmentSelect = $('#intern_department');
                departmentSelect.prop('disabled', false);
                departmentSelect.val(response.department);

                $('#studentID').val(response.studentID).prop('disabled', false);
                $('#coordinator_name').val(response.coordinator_name).prop('disabled', true);
                $('#hours_needed').val(response.hours_needed).prop('disabled', false);
                $('#coordinator_email').val(response.coordinator_email).prop('disabled', true);
                $('#internship_status').val(response.internship_status).prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Failed to load interns:', error);
                console.error('Response:', xhr.responseText);
            }
        });
    };

    $(document).on('click', '.intern-btn', function() {
        let internId = $(this).data('id');
        loadInternInfo(internId);
    });
});