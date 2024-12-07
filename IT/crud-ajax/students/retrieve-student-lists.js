let currentPage = 1;
let pageLength = 10;

// Fetch and display table data
function loadTableData() {
    console.log('Fetching table data...');
    $.ajax({
        url: 'controller/students/retrieve-student-lists.php',
        type: 'GET',
        dataType: 'json',  // Automatically parses JSON response
        data: {
            page: currentPage,
            length: pageLength,
            search: $('#searchInput').val()
        },
        success: function(response) {
            console.log('Response Data:', response); // Debugging line

            // Clear table body first
            $('#usersTable tbody').html('');

            // Check if data is available
            if (response.total > 0) {
                // Populate the table if data is available
                $('#usersTable tbody').html(response.html);
                
                // Display table info
                $('#tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);

                // Populate pagination if data is available
                $('#pagination').html(response.pagination);
            } else {
                // Show no data available message if no data is found
                $('#tableInfo').text('Showing 0 to 0 of 0 entries');
                
                // Add "No data available" to tbody if no data is found
                $('#usersTable tbody').html('<tr><td colspan="8" class="text-center">No data available</td></tr>');
                
                // Clear pagination if no data
                $('#pagination').html('');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

// Handle page length change
$('#pageLengthSelect').on('change', function() {
    pageLength = parseInt($(this).val());
    loadTableData();
});

// Handle search input
$('#searchInput').on('input', function() {
    loadTableData();
});

// Handle pagination click
$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    currentPage = $(this).data('page');
    loadTableData();
});

// Handle "Select All" checkbox
$('#selectAllCheckbox').on('change', function() {
    const isChecked = $(this).prop('checked');
    $('#usersTable tbody input[type="checkbox"]').each(function() {
        $(this).prop('checked', isChecked);
    });
});

// Handle individual row checkbox
$(document).on('change', '#usersTable tbody input[type="checkbox"]', function() {
    const totalCheckboxes = $('#usersTable tbody input[type="checkbox"]').length;
    const checkedCheckboxes = $('#usersTable tbody input[type="checkbox"]:checked').length;
    $('#selectAllCheckbox').prop('checked', totalCheckboxes === checkedCheckboxes);
});

// Handle "Delete" button click
$('.btn-danger').on('click', function() {
    const selectedIds = getSelectedUserIds(); // Get the selected user IDs
    if (selectedIds.length > 0) {
        if (confirm("Are you sure you want to delete the selected users?")) {
            // Send the delete request to the server
            $.ajax({
                url: 'controller/students/delete-students.php', // PHP script for deletion
                type: 'POST',
                data: {
                    user_ids: selectedIds // Pass selected user IDs
                },
                success: function(response) {
                    if (response.success) {
                        alert("Users deleted successfully.");
                        loadTableData(); // Reload table data
                    } else {
                        alert("Error deleting users: " + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    alert("An error occurred while deleting the users.");
                }
            });
        }
    } else {
        alert('Please select at least one user.');
    }
});

// Helper function to get selected user IDs
function getSelectedUserIds() {
    const selectedIds = [];
    $('#usersTable tbody input[type="checkbox"]:checked').each(function() {
        selectedIds.push($(this).data('id')); // Get the id from data-id
    });
    return selectedIds;
}

// Initial data load
loadTableData();