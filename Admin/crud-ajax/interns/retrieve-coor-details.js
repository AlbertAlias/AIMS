function loadCoordinatorDetails(departmentId) {
    $.ajax({
        url: 'controller/interns/retrieve-coor-details.php', // New PHP file
        type: 'GET',
        data: { department_id: departmentId }, // Send department id
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Populate coordinator name and email without enabling them
                $('#coordinator_name').val(`${response.data.first_name} ${response.data.last_name}`);
                $('#coordinator_email').val(response.data.personal_email);
            } else {
                console.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
}

// Event listener for department selection
$(document).ready(function () {
    $('#intern_department').change(function () {
        const departmentId = $(this).val();
        if (departmentId) {
            loadCoordinatorDetails(departmentId); // Load coordinator details
        } else {
            // Clear the coordinator fields if no department is selected
            $('#coordinator_name').val('');
            $('#coordinator_email').val('');
        }
    });
});
