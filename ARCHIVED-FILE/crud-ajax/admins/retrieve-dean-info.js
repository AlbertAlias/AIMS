$(document).on('click', '.coor-btn', function () {
    const deanId = $(this).data('id');
    console.log("Dean ID sent to server:", deanId); // Debug

    $.ajax({
        url: 'controller/departments/retrieve-dean-info.php',
        type: 'POST',
        data: { dean_id: deanId },
        dataType: 'json',
        success: function (response) {
            console.log("AJAX Response:", response); // Debug

            if (response.success) {
                // Populate user details
                $('#add_last_name').val(response.dean.last_name);
                $('#add_first_name').val(response.dean.first_name);
                $('#add_username').val(response.dean.username);

                // Clear and populate department dropdowns
                $('#add_department1').empty().append('<option selected>Choose Department 1</option>').prop('disabled', true);
                $('#add_department2').empty().append('<option selected>Choose Department 2</option>').prop('disabled', true);
                $('#add_department3').empty().append('<option selected>Choose Department 3</option>').prop('disabled', true);

                let deptIndex = 0;
                response.departments.forEach((dept, index) => {
                    // Populate dropdowns with department names
                    if (index === 0) {
                        $('#add_department1').append(`<option value="${dept.department_id}" selected>${dept.department_name}</option>`);
                    } else if (index === 1) {
                        $('#add_department2').append(`<option value="${dept.department_id}" selected>${dept.department_name}</option>`);
                    } else if (index === 2) {
                        $('#add_department3').append(`<option value="${dept.department_id}" selected>${dept.department_name}</option>`);
                    }
                });

                // Hide dean submit and show update/cancel buttons
                $('#deanSubmitBtn').hide();
                $('#deanUpdateBtn').show();
                $('#deanCancelBtn').show();

                // populateDepartments();
            } else {
                alert(response.error || 'Unable to fetch dean details.');
            }
        },
        error: function () {
            alert('An error occurred while fetching dean details.');
        }
    });
});

// Logic for dean cancel button
$(document).on('click', '#deanCancelBtn', function () {
    // Hide update/cancel buttons and show submit button for dean
    $('#deanUpdateBtn').hide();
    $('#deanCancelBtn').hide();
    $('#deanSubmitBtn').show();

    // Optionally, reset dean inputs if you want to clear changes
    $('#add_last_name').val('');
    $('#add_first_name').val('');
    $('#add_department1').empty().append('<option selected>Choose Department 1</option>').prop('disabled', false);
    $('#add_department2').empty().append('<option selected>Choose Department 2</option>').prop('disabled', false);
    $('#add_department3').empty().append('<option selected>Choose Department 3</option>').prop('disabled', false);
    $('#add_username').val('');
});