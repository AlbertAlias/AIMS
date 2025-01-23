let coorlistsPage = 1;
let coorlistsPageLength = 10;

function loadcoorTableData() {
    $.ajax({
        url: 'controller/retrieve-coor-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: coorlistsPage,
            length: coorlistsPageLength,
            search: $('#coor-searchInput').val()
        },
        success: function(response) {
            // Populate the table body
            if (response.html) {
                $('#coorTable tbody').html(response.html);
            } else {
                $('#coorTable tbody').html('<tr><td colspan="4">No data available</td></tr>'); // Match colspan with the number of columns
            }

            // Update table info or display "No entries available"
            if (response.total > 0) {
                $('#coor-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
            } else {
                $('#coor-tableInfo').text('No entries available');
            }

            // Handle pagination
            if (response.pagination) {
                $('#coor-pagination').html(response.pagination);
            } else {
                $('#coor-pagination').html('');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            $('#coorTable tbody').html('<tr><td colspan="4">An error occurred. Please try again later.</td></tr>');
            $('#coor-tableInfo').text('No entries available');
        }
    });
}


$('#coor-pageLengthSelect').on('change', function() {
    coorlistsPageLength = parseInt($(this).val());
    coorlistsPage = 1;
    loadcoorTableData();
});

$('#coor-searchInput').on('input', function() {
    coorlistsPage = 1;
    loadcoorTableData();
});

$('#coor-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    coorlistsPage = $(this).data('page');
    loadcoorTableData();
});

loadcoorTableData();