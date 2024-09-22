$(document).ready(function() {
    // Function to load and display interns in buttons
    window.loadInterns = function() {
        $.ajax({
            url: 'controller/interns/retrieve-interns.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let internsInfo = $('#internsInfo');
                internsInfo.empty();  // Clear the div before populating

                response.forEach(function(intern) {
                    // Create a button for each intern
                    let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 intern-btn" data-id="${intern.id}">
                                    ${intern.last_name}, ${intern.first_name}
                                </button>`;
                    internsInfo.append(btn);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to load interns:', error);
            }
        });
    };

    // Attach loadInternDetails to the window object
    window.loadInternDetails = function(id) {
        $.ajax({
            url: 'controller/interns/retrieve-intern-details.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Error:', response.error);
                    return;
                }

                $('#interns_id').val(response.id);
                $('#first_name').val(response.first_name).prop('disabled', false);
                $('#last_name').val(response.last_name).prop('disabled', false);
                $('#middle_name').val(response.middle_name).prop('disabled', false);
                $('#suffix').val(response.suffix).prop('disabled', false);
                $('#address').val(response.address).prop('disabled', false);
                $('#birthdate').val(response.birthdate).prop('disabled', false);
                $('#personal_email').val(response.personal_email).prop('disabled', false);
                $('#contact_number').val(response.contact_number).prop('disabled', false);
                $('#gender').val(response.gender).prop('disabled', false);
                $('#civil_status').val(response.civil_status).prop('disabled', false);
                $('#account_email').val(response.account_email).prop('disabled', true); // Lock the account email
                $('#password').val(response.password).prop('disabled', true); // Lock the hashed password
                $('#submitBtn').prop('disabled', false);
                loadDepartments(response.department, true);

                // Set the missing fields and keep them locked
                $('#studentID').val(response.studentID).prop('disabled', false); // Load student ID
                $('#coordinator_name').val(response.coordinator_name).prop('disabled', true); // Lock the coordinator name
                $('#hours_needed').val(response.hours_needed).prop('disabled', false); // Lock hours needed
                $('#coordinator_email').val(response.coordinator_email).prop('disabled', true); // Lock coordinator email
                $('#internship_status').val(response.internship_status).prop('disabled', false); // Lock internship status
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving intern details:', error);
            }
        });
    };

    loadInterns();
});