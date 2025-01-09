$('#deptUpdateBtn').click(function() {
    var departmentId = $('#departmentSelect').val();
    var departmentName = $('#additionalInput').val();

    if (departmentId && departmentName) {
        $.ajax({
            url: 'controller/departments/update-depts.php',
            type: 'POST',
            data: {
                department_id: departmentId,
                department_name: departmentName
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                
                if (response && response.success) {
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

                    $('#additionalInput').val('').attr('readonly', true);
                    $('#departmentSelect').val('');
                    $('#seeDepartmentsModal').modal('hide');

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

function populateDepartmentSelect() {
    $.ajax({
        url: 'controller/departments/retrieve-depts.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#departmentSelect');
            select.empty();
            select.append('<option selected>Choose a department</option>');
            data.forEach(function(department) {
                select.append('<option value="' + department.department_id + '">' + department.department_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error("Error fetching departments: " + error);
        }
    });
}

$('#seeDepartmentsModal').on('show.bs.modal', function() {
    populateDepartmentSelect();
});

$('#departmentSelect').change(function() {
    var selectedDeptId = $(this).val();
    var selectedDeptName = $("#departmentSelect option:selected").text();
    
    if (selectedDeptId && selectedDeptName !== "Choose a department") {
        $('#additionalInput').val(selectedDeptName).removeAttr('readonly');
    } else {
        $('#additionalInput').val('').attr('readonly', true);
    }
});

$('#deptDeleteBtn').click(function () {
    var departmentId = $('#departmentSelect').val();

    if (departmentId && confirm('Are you sure you want to delete this department? This action cannot be undone.')) {
        $.ajax({
            url: 'controller/departments/delete-depts.php',
            type: 'POST',
            data: {
                department_id: departmentId
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                
                if (response && response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Department deleted successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#ffcccb',
                        iconColor: '#d32f2f',
                        color: '#b71c1c',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    $('#additionalInput').val('').attr('readonly', true);
                    $('#departmentSelect').val('');
                    $('#seeDepartmentsModal').modal('hide');

                    populateDepartmentSelect();
                } else {
                    alert('Error deleting department: ' + (response.message || 'Unknown error'));
                }
            },
            error: function (xhr, status, error) {
                console.error("Error deleting department: " + error);
                alert('Error deleting department');
            }
        });
    }
});
