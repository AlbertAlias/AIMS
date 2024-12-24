let studentCurrentPage = 1;
let studentPageLength = 10;

// Fetch and display table data
function loadTableData() {
    console.log('Fetching table data...');
    $.ajax({
        url: 'controller/retrieve-student-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: studentCurrentPage,
            length: studentPageLength,
            search: $('#student-searchInput').val()
        },
        success: function(response) {
            console.log('Response Data:', response);
            if (response.html) {
                $('#studentsTable tbody').html(response.html);
            }
            if (response.pagination) {
                $('#student-pagination').html(response.pagination);
            }
            $('#student-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.error('Raw Response:', xhr.responseText); // Log raw response for debugging
            alert('An error occurred while fetching data. Please try again.');
        }
    });
}


// Handle page length change
$('#student-pageLengthSelect').on('change', function() {
    studentPageLength = parseInt($(this).val());
    loadTableData();
});

// Handle search input
$('#student-searchInput').on('input', function() {
    loadTableData();
});

// Handle pagination click
$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    studentCurrentPage = $(this).data('page');
    loadTableData();
});

// Handle "Select All" checkbox
$('#selectAllCheckbox').on('change', function() {
    const isChecked = $(this).prop('checked');
    $('#studentsTable tbody input[type="checkbox"]').each(function() {
        $(this).prop('checked', isChecked);
    });
});

// Handle individual row checkbox
$(document).on('change', '#studentsTable tbody input[type="checkbox"]', function() {
    const totalCheckboxes = $('#studentsTable tbody input[type="checkbox"]').length;
    const checkedCheckboxes = $('#studentsTable tbody input[type="checkbox"]:checked').length;
    $('#selectAllCheckbox').prop('checked', totalCheckboxes === checkedCheckboxes);
});

// Handle "Archive" button click
$('.btn-danger').on('click', function() {
    const selectedIds = getSelectedUserIds(); // Get the selected user IDs
    if (selectedIds.length > 0) {
        if (confirm("Are you sure you want to archive the selected users?")) {
            // Send the archive request to the server
            $.ajax({
                url: 'controller/archive.php', // PHP script for archiving
                type: 'POST',
                data: {
                    user_ids: selectedIds // Pass selected user IDs
                },
                success: function(response) {
                    if (response.success) {
                        alert("Users archived successfully.");
                        loadTableData(); // Reload table data
                    } else {
                        alert("Error archiving users: " + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    alert("An error occurred while archiving the users.");
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
    $('#studentsTable tbody input[type="checkbox"]:checked').each(function() {
        selectedIds.push($(this).data('id')); // Get the id from data-id
    });
    return selectedIds;
}


// Initial data load
loadTableData();