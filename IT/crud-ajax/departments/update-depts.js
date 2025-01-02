// When the "Update" button is clicked, update the department in the database
$('#deptUpdateBtn').click(function() {
    var departmentId = $('#departmentSelect').val();
    var departmentName = $('#additionalInput').val();

    if (departmentId && departmentName) {
        // Send AJAX request to update the department
        $.ajax({
            url: 'controller/departments/update-depts.php', // Endpoint to update department
            type: 'POST',
            data: {
                department_id: departmentId,
                department_name: departmentName
            },
            dataType: 'json',  // Make sure to specify that we expect JSON in response
            success: function(response) {
                console.log(response); // Log the full response from the PHP script
                
                if (response && response.success) {
                    // SweetAlert success toast
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Department updated successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    // Reset the input and close the modal
                    $('#additionalInput').val('').attr('readonly', true);
                    $('#departmentSelect').val(''); // Reset the select dropdown
                    $('#seeDepartmentsModal').modal('hide'); // Close the modal

                    // Re-populate the department dropdown with fresh data
                    populateDepartmentSelect();
                } else {
                    alert('Error updating department: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error("Error updating department: " + error);
                alert('Error updating department');
            }
        });
    } else {
        alert('Please select a department and enter a valid name');
    }
});

// Function to populate department dropdown with updated data
function populateDepartmentSelect() {
    $.ajax({
        url: 'controller/departments/retrieve-depts.php', // Endpoint to fetch departments
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#departmentSelect');
            select.empty(); // Clear the current dropdown options
            select.append('<option selected>Choose a department</option>'); // Add default option
            data.forEach(function(department) {
                select.append('<option value="' + department.department_id + '">' + department.department_name + '</option>'); // Add departments to the dropdown
            });
        },
        error: function(xhr, status, error) {
            console.error("Error fetching departments: " + error);
        }
    });
}

// Populate departments on modal open
$('#seeDepartmentsModal').on('show.bs.modal', function() {
    populateDepartmentSelect();
});

// When the user selects a department, populate the input field and make it editable
$('#departmentSelect').change(function() {
    var selectedDeptId = $(this).val();
    var selectedDeptName = $("#departmentSelect option:selected").text();
    
    if (selectedDeptId && selectedDeptName !== "Choose a department") {
        // Populate the input field with the department name and make it editable
        $('#additionalInput').val(selectedDeptName).removeAttr('readonly');
    } else {
        // Clear input and make it readonly if no valid department is selected
        $('#additionalInput').val('').attr('readonly', true);
    }
});