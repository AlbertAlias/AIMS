$(document).on('click', '.open-modal-btn', function() {
    var studentId = $(this).data('user-id');
    console.log('Student ID:', studentId); // Log the student ID to verify it's being set
    $('#assignSupervisorModal').data('student-id', studentId);  // Store student ID in modal
});

// Handle the "Submit" button click inside the modal to assign the supervisor
$('#assignSupervisorBtn').on('click', function() {
    var company = $('#companySelect').val();   // Get selected company
    var supervisorId = $('#supervisorSelect').val();  // Get selected supervisor ID
    var studentId = $('#assignSupervisorModal').data('student-id');  // Retrieve the student ID from modal

    console.log('Company:', company);
    console.log('Supervisor ID:', supervisorId);
    console.log('Student ID:', studentId);  // Check if student ID is being correctly passed

    // Check if company, supervisor, and student ID are selected
    if (company && supervisorId && studentId) {
        // Send the data to the server using AJAX
        $.ajax({
            url: 'controller/requirement/create-assign-supervisors.php',  // PHP script to handle the assignment
            type: 'POST',
            data: {
                company: company,
                supervisor_id: supervisorId,
                student_id: studentId  // Send the student ID along with other data
            },
            success: function(response) {
                console.log('Response:', response);  // Log the response
                // Parse JSON if the response is a string (AJAX response can sometimes be a string)
                if (typeof response === "string") {
                    response = JSON.parse(response);
                }

                if (response.success) {
                    alert('Supervisor assigned successfully!');
                    $('#assignSupervisorModal').modal('hide');  // Close the modal
                } else {
                    alert('Error assigning supervisor: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    } else {
        alert('Please select both a company and a supervisor.');
    }
});