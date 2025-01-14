// $('#deptUpdateBtn').click(function() {
//     var departmentId = $('#departmentSelect').val();
//     var departmentName = $('#update_department_name').val();

//     if (departmentId && departmentName) {
//         $.ajax({
//             url: 'controller/departments/update-depts.php',
//             type: 'POST',
//             data: {
//                 department_id: departmentId,
//                 department_name: departmentName
//             },
//             dataType: 'json',
//             success: function(response) {
//                 console.log(response);
                
//                 if (response && response.success) {
//                     Swal.fire({
//                         toast: true,
//                         position: 'top-right',
//                         icon: 'success',
//                         title: 'Department updated successfully!',
//                         showConfirmButton: false,
//                         timer: 2000,
//                         background: '#b9f6ca',
//                         iconColor: '#2e7d32',
//                         color: '#155724',
//                         customClass: {
//                             popup: 'mt-5'
//                         }
//                     });

//                     $('#update_department_name').val('').attr('readonly', true);
//                     $('#departmentSelect').val('');
//                     $('#seeDepartmentsModal').modal('hide');
//                     populateDepartmentSelect();
//                     populateDepartments();
//                     loadDepartments();
//                 } else {
//                     alert('Error updating department: ' + (response.message || 'Unknown error'));
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error("Error updating department: " + error);
//                 alert('Error updating department');
//             }
//         });
//     } else {
//         alert('Please select a department and enter a valid name');
//     }
// });

$('#deptUpdateBtn').click(function () {
    var departmentId = $('#departmentSelect').val();
    var departmentName = $('#update_department_name').val();
    var departmentImage = $('#update_department_image')[0].files[0]; // Get the selected file

    if (departmentId && departmentName) {
        var formData = new FormData();
        formData.append('department_id', departmentId);
        formData.append('department_name', departmentName);
        if (departmentImage) {
            formData.append('department_image', departmentImage);
        }

        $.ajax({
            url: 'controller/departments/update-depts.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
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
                            popup: 'mt-5',
                        },
                    });

                    $('#update_department_name').val('').attr('readonly', true);
                    $('#update_department_image').val('');
                    $('#departmentSelect').val('');
                    $('#seeDepartmentsModal').modal('hide');
                    populateDepartmentSelect();
                } else {
                    alert('Error updating department: ' + (response.message || 'Unknown error'));
                }
            },
            error: function (xhr, status, error) {
                console.error('Error updating department: ' + error);
                alert('Error updating department');
            },
        });
    } else {
        alert('Please select a department and enter a valid name');
    }
});


// function populateDepartmentSelect() {
//     $.ajax({
//         url: 'controller/departments/retrieve-depts.php',
//         type: 'GET',
//         dataType: 'json',
//         success: function(response) {
//             console.log("Response:", response);
//             if (response.success) {
//                 var select = $('#departmentSelect');
//                 select.empty();
//                 select.append('<option selected>Choose a department</option>');

//                 response.data.forEach(function(department) {
//                     select.append('<option value="' + department.id + '">' + department.name + '</option>');
//                 });
//             } else {
//                 console.error("Error fetching departments:", response.error);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error("Error fetching departments: " + error);
//         }
//     });
// }

function populateDepartmentSelect() {
    $.ajax({
        url: 'controller/departments/retrieve-depts.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log("Response:", response);
            if (response.success) {
                var select = $('#departmentSelect');
                select.empty();
                select.append('<option selected>Choose a department</option>');

                response.data.forEach(function (department) {
                    select.append('<option value="' + department.id + '">' + department.name + '</option>');
                });

                // Add change event to populate fields when a department is selected
                $('#departmentSelect').change(function () {
                    var selectedDeptId = $(this).val();
                    if (selectedDeptId) {
                        var selectedDept = response.data.find(dept => dept.id == selectedDeptId);
                        if (selectedDept) {
                            $('#update_department_name').val(selectedDept.name).removeAttr('readonly');

                            // Extract the file name from the full path and display it
                            if (selectedDept.image) {
                                const fileName = selectedDept.image.split('/').pop(); // Get only the file name
                                $('#currentImageName')
                                    .text('Current file: ' + fileName)
                                    .show();
                            } else {
                                $('#currentImageName')
                                    .text('No image uploaded.')
                                    .show();
                            }
                        }
                    } else {
                        $('#update_department_name').val('').attr('readonly', true);
                        $('#currentImageName').hide(); // Hide the file name display
                    }
                });
            } else {
                console.error("Error fetching departments:", response.error);
            }
        },
        error: function (xhr, status, error) {
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
        $('#update_department_name').val(selectedDeptName).removeAttr('readonly');
    } else {
        $('#update_department_name').val('').attr('readonly', true);
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

                    $('#update_department_name').val('').attr('readonly', true);
                    $('#departmentSelect').val('');
                    $('#seeDepartmentsModal').modal('hide');
                    populateDepartmentSelect();
                    populateDepartments();
                    loadDepartments();
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
