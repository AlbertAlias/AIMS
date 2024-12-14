let studentPage = 1;
let studentPageLength = 10;

// Fetch and display table data
function loadTableData() {
    console.log('Fetching table data...');
    $.ajax({
        url: 'controller/requirement/retrieve-stud-lists.php',
        type: 'GET',
        dataType: 'json',  // Automatically parses JSON response
        data: {
            page: studentPage,
            length: studentPageLength,
            search: $('#stud-lists-searchInput').val()
        },
        success: function(response) {
            console.log('Response Data:', response); // Debugging line
            if (response.html) {
                $('#stud-lists tbody').html(response.html);
            }
            if (response.pagination) {
                $('#stud-lists-pagination').html(response.pagination);
            }
            $('#stud-lists-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

// Handle page length change
$('#stud-lists-pageLengthSelect').on('change', function() {
    studentPageLength = parseInt($(this).val());
    loadTableData();
});

// Handle search input
$('#stud-lists-searchInput').on('input', function() {
    loadTableData();
});

// Handle pagination click
$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    studentPage = $(this).data('page');
    loadTableData();
});

// Initial data load
loadTableData();