let currentPage = 1;
let pageLength = 10;

// Fetch and display table data
function loadTableData() {
    console.log('Fetching table data...');
    $.ajax({
        url: 'controller/studentreq.php',
        type: 'GET',
        dataType: 'json',  // Automatically parses JSON response
        data: {
            page: currentPage,
            length: pageLength,
            search: $('#searchInput').val()
        },
        success: function(response) {
            console.log('Response Data:', response); // Debugging line
            if (response.html) {
                $('#usersTable tbody').html(response.html);
            }
            if (response.pagination) {
                $('#pagination').html(response.pagination);
            }
            $('#tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
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

$(document).on('click', '.open-modal-btn', function() {
    const studentId = $(this).data('id'); // Get student ID from data attribute
    $('#modalStudentId').text(`Selected Student ID: ${studentId}`);
});


// // Handle individual row checkbox
// $(document).on('change', '#usersTable tbody input[type="checkbox"]', function() {
//     const totalCheckboxes = $('#usersTable tbody input[type="checkbox"]').length;
//     const checkedCheckboxes = $('#usersTable tbody input[type="checkbox"]:checked').length;
//     $('#selectAllCheckbox').prop('checked', totalCheckboxes === checkedCheckboxes);
// });

// // Handle "Archive" button click
// $('.btn-danger').on('click', function() {
//     const selectedIds = getSelectedUserIds(); // Get the selected user IDs
//     if (selectedIds.length > 0) {
//         if (confirm("Are you sure you want to archive the selected users?")) {
//             // Send the archive request to the server
//             $.ajax({
//                 url: 'controller/archive.php', // PHP script for archiving
//                 type: 'POST',
//                 data: {
//                     user_ids: selectedIds // Pass selected user IDs
//                 },
//                 success: function(response) {
//                     if (response.success) {
//                         alert("Users archived successfully.");
//                         loadTableData(); // Reload table data
//                     } else {
//                         alert("Error archiving users: " + response.error);
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error('AJAX error:', status, error);
//                     alert("An error occurred while archiving the users.");
//                 }
//             });
//         }
//     } else {
//         alert('Please select at least one user.');
//     }
// });

// // Helper function to get selected user IDs
// function getSelectedUserIds() {
//     const selectedIds = [];
//     $('#usersTable tbody input[type="checkbox"]:checked').each(function() {
//         selectedIds.push($(this).data('id')); // Get the id from data-id
//     });
//     return selectedIds;
// }


// Initial data load
loadTableData();