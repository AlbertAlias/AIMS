let deptCurrentPage = 1;
let deptPageLength = 10;
let selectedDean = null; // Store the selected dean's data

// Fetch and display table data
function loadTableData() {
    $.ajax({
        url: 'controller/departments/retrieve-dean-info.php',
        type: 'GET',
        dataType: 'json',  // Automatically parses JSON response
        data: {
            page: deptCurrentPage,
            length: deptPageLength,
            search: $('#depts-searchInput').val()
        },
        success: function(response) {
            try {
                console.log('Server Response:', response); // Debugging line

                // Check if there is an error in the response
                if (response.error) {
                    console.error('Error:', response.error);
                    alert('An error occurred while fetching the data.');
                    return;
                }

                // Clear table body first
                $('#deptsTable tbody').html('');

                // Check if data is available
                if (response.total > 0) {
                    // Populate the table if data is available
                    $('#deptsTable tbody').html(response.html);

                    // Display table info
                    $('#depts-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);

                    // Populate pagination if data is available
                    $('#depts-pagination').html(response.pagination);
                } else {
                    // Show no data available message if no data is found
                    $('#depts-tableInfo').text('Showing 0 to 0 of 0 entries');

                    // Add "No data available" to tbody if no data is found
                    $('#deptsTable tbody').html('<tr><td colspan="5" class="text-center">No data available</td></tr>');

                    // Clear pagination if no data
                    $('#depts-pagination').html('');
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                console.error('Raw response:', response);
                alert('An error occurred while processing the data.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.error('Response Text:', xhr.responseText); // Log the actual response from the server
            alert('An error occurred while fetching the data.');
        }
    });
}

// Handle page length change
$('#depts-pageLengthSelect').on('change', function() {
    deptPageLength = parseInt($(this).val());
    loadTableData();
});

// Handle search input
$('#depts-searchInput').on('input', function() {
    loadTableData();
});

// Handle pagination click
$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    deptCurrentPage = $(this).data('page');
    loadTableData();
});

// Initial data load
loadTableData();

// Capture checkbox selection
$(document).on('change', '.userCheckbox', function () {
    // Find the selected row
    const row = $(this).closest('tr');
    
    // Retrieve dean's data from the row
    selectedDean = {
        departmentId: $(this).data('id'),
        firstName: row.find('td').eq(1).text().trim(),
        lastName: row.find('td').eq(2).text().trim(),
        username: row.find('td').eq(4).text().trim(),
        departmentName: row.find('td').eq(3).text().trim()
    };

    // Show the "Edit Dean" button if a checkbox is selected
    if (selectedDean) {
        $('.btn[aria-label="Edit Dean"]').show();
    } else {
        $('.btn[aria-label="Edit Dean"]').hide();
    }
});

// When "Edit Dean" button is clicked
$('.btn[aria-label="Edit Dean"]').on('click', function () {
    if (selectedDean) {
        // Populate the modal form fields for editing department
        $('#update_first_name').val(selectedDean.firstName);  // Populate First Name field
        $('#update_last_name').val(selectedDean.lastName);    // Populate Last Name field
        $('#update_username').val(selectedDean.username);     // Populate Username field

        // Fetch and populate department options based on department_id
        $.ajax({
            url: 'controller/departments/retrieve-dean-deptsName.php',  // Create a new PHP endpoint to fetch department info by ID
            type: 'GET',
            data: {
                department_id: selectedDean.departmentId
            },
            success: function(response) {
                // If department is found, set the selected department in the dropdown
                if (response.success) {
                    const departmentSelect = $('#update_dean_department');
                    departmentSelect.empty(); // Clear existing options
                    departmentSelect.append('<option selected>Choose Department</option>'); // Default option
                    // Populate department options
                    response.departments.forEach(function(department) {
                        const option = `<option value="${department.id}" ${department.id == selectedDean.departmentId ? 'selected' : ''}>${department.department_name}</option>`;
                        departmentSelect.append(option);
                    });
                } else {
                    alert('Error fetching department name');
                }
            },
            error: function() {
                alert('Failed to load department data');
            }
        });
    }
});

// Optional: When the modal is closed, clear the selected dean data
$('#editDeanModal').on('hidden.bs.modal', function () {
    selectedDean = null;
    $('.btn[aria-label="Edit Dean"]').hide();  // Hide the edit button after modal is closed
});