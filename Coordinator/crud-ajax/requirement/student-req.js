let currentPage = 1;
let pageLength = 10;

// Fetch and display table data
function loadTableData() {
    console.log('Fetching table data...');
    $.ajax({
        url: 'controller/requirement/student-req.php',
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
                $('#student-req tbody').html(response.html);
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

// Initial data load
loadTableData();