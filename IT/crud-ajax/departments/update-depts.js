$(document).ready(function() {
    // Handle the update button click
    $('#editDeptUpdateBtn').on('click', function() {
        const deptId = $(this).data('dept-id');  // Get the department ID
        const updatedDeptName = $('#edit_department_name').val();  // Get the new department name

        // Check if the department name is valid
        if (updatedDeptName.trim() === '') {
            alert('Department name cannot be empty.');
            return;
        }

        // Send the AJAX request to update the department
        $.ajax({
            url: 'controller/departments/update-depts.php',
            type: 'POST',
            data: {
                dept_id: deptId,
                department_name: updatedDeptName
            },
            success: function(response) {
                console.log(response); // Log the response for debugging

                // Parse the response if it's a string (sometimes response can be a string, not a JSON object)
                if (typeof response === "string") {
                    response = JSON.parse(response);
                }

                // Check if the response status is 'success'
                if (response.status === 'success') {
                    // Only show success message if the update was successful
                    alert('Department successfully updated.');
                    $('#editDeptModal').modal('hide');  // Close the modal
                } else {
                    // If status is 'error', show the error message
                    alert('Failed to update department: ' + (response.message || 'An unknown error occurred.'));
                }
            },
            error: function(xhr, status, error) {
                // Log the error details for debugging
                console.error("AJAX request failed. Status: " + status + ", Error: " + error);
                alert('An error occurred while updating the department.');
            }
        });
    });
});
