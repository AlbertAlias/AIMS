$(document).ready(function () {
    // When the Add Interns button is clicked
    $('#addInternsBtn').click(function () {
        // Enable all required fields in the form
        $('#internsForm input, #internsForm select').prop('disabled', false);
        
        // Call the function to populate departments
        loadDepartments();
    });

    function loadDepartments() {
        $.ajax({
            url: 'controller/interns/retrieve-intern-deptsName.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    let options = '';
                    // Add default option
                    options += '<option selected disabled>Choose Department</option>'; 
                    response.data.forEach(function (department) {
                        options += `<option value="${department.id}">${department.department_name}</option>`;
                    });
                    $('#intern_department').empty().append(options);
                } else {
                    console.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }
});



// let currentSelectedDepartment;

// function loadDepartments() {
//     $.ajax({
//         url: 'controller/interns/retrieve-deptsName.php',
//         method: 'GET',
//         dataType: 'json',
//         success: function(response) {
//             console.log(response);
//             let departmentSelect = $('#intern_department');
//             departmentSelect.empty();
//             departmentSelect.append('<option selected disabled>Choose Department</option>');
        
//             if (Array.isArray(response.departments)) {
//                 response.departments.forEach(function(department) {
//                     departmentSelect.append(`<option value="${department.department_name}">${department.department_name}</option>`);
//                 });
//             } else {
//                 console.error('Invalid response structure:', response);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Error retrieving departments:', error);
//         }
//     });
// }

// function loadCoorInfo(departmentName) {
//     $.ajax({
//         url: 'controller/interns/retrieve-coor-info.php',
//         method: 'GET',
//         data: { department: departmentName },
//         dataType: 'json',
//         success: function(response) {
//             if (response.success) {
//                 let coordinatorName = response.coordinator.last_name + ', ' + response.coordinator.first_name;
//                 $('#coordinator_name').val(coordinatorName);
//                 $('#coordinator_email').val(response.coordinator.personal_email);
//             } else {
//                 console.error('Coordinator not found for this department');
//                 $('#coordinator_name').val('');
//                 $('#coordinator_email').val('');
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Error retrieving coordinator info:', error);
//             console.error('Response text:', xhr.responseText);
//         }
//     });
// }

// $('#intern_department').on('change', function() {
//     currentSelectedDepartment = $(this).val(); // Update the variable here
//     if (currentSelectedDepartment) {
//         loadCoorInfo(currentSelectedDepartment);
//     }
// });

// $(document).ready(function() {
//     if (!$('#intern_department').data('loaded')) {
//         loadDepartments(); 
//         $('#intern_department').data('loaded', true); // Mark as loaded to prevent re-triggering
//     }
// });