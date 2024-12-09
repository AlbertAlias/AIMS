$(document).ready(function () {
    let departments = [];
    // Fetch department data for the dropdown
    $.ajax({
        url: 'controller/departments/retrieve-add-department.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            departments = response; // Store department data
        },
    });

    // Handle checkbox selection
    $(document).on('change', '.userCheckbox', function () {
        if ($('.userCheckbox:checked').length > 0) {
            // Hide "Add Department" and "Assign Dean" buttons
            $('button[aria-label="Add Department"]').hide();
            $('button[aria-label="Assign Dean"]').hide();
            // Show the "Edit" button
            $('#deanEditBtn').show();
        } else {
            // No checkbox selected: Reset to default visibility
            $('button[aria-label="Add Department"]').show();
            $('button[aria-label="Assign Dean"]').show();
            $('#deanEditBtn').hide();
            $('#deanUpdateBtn').hide();
        }
    });

    // Handle "Edit" button click
    $('#deanEditBtn').click(function () {
        $('.userCheckbox:checked').each(function () {
            var row = $(this).closest('tr');
            row.find('td.editable').each(function () {
                var text = $(this).text().trim();
                var field = $(this).data('field');

                // Convert the department field to a dropdown
                if (field === 'department_id') {
                    var selectHTML = '<select class="form-select form-select-sm" data-field="department_id">';
                    departments.forEach(function (department) {
                        var selected = department.department_id == text ? 'selected' : '';
                        selectHTML += `<option value="${department.department_id}" ${selected}>${department.department_name}</option>`;
                    });
                    selectHTML += '</select>';
                    $(this).html(selectHTML);
                } else {
                    // Convert other fields to input fields
                    $(this).html('<input type="text" class="form-control form-control-sm" data-field="' + field + '" value="' + text + '">');
                }
            });
        });

        // Hide "Edit" button and show "Update" button
        $('#deanEditBtn').hide();
        $('#deanUpdateBtn').show();
    });

    // Handle "Update" button click
    $('#deanUpdateBtn').click(function () {
        $('.userCheckbox:checked').each(function () {
            var row = $(this).closest('tr');
            var userId = $(this).data('id');
            var updatedData = {};

            row.find('td.editable input, td.editable select').each(function () {
                var field = $(this).data('field');
                var value = $(this).val();
                updatedData[field] = value;
            });

            // Send updated data to the server
            $.ajax({
                url: 'controller/departments/update-dean-info.php',
                method: 'POST',
                data: {
                    user_id: userId,
                    updatedData: updatedData,
                },
                success: function (response) {
                    if (response.success) {
                        alert('Dean information updated successfully!');
                        location.reload();
                    } else {
                        alert('Failed to update dean information');
                    }
                },
            });
        });

        // Reset button visibility after update
        $('#deanUpdateBtn').hide();
        $('#deanEditBtn').show();
        $('button[aria-label="Add Department"]').show();
        $('button[aria-label="Assign Dean"]').show();
    });
});
