let supervisorPage = 1;
let supervisorPageLength = 10;

function loadSupervisorTableData() {
    $.ajax({
        url: 'controller/supervisor/retrieve-supervisor-lists.php', // Ensure the URL points to the correct supervisor endpoint
        type: 'GET',
        dataType: 'json',
        data: {
            page: supervisorPage,
            length: supervisorPageLength,
            search: $('#supervisor-lists-searchInput').val() // Update the input ID to match the supervisor search input
        },
        success: function(response) {
            if (response.html) {
                $('#supervisortbody').html(response.html); // Update the tbody ID to 'supervisortbody'
            } else {
                $('#supervisortbody').html('<tr><td colspan="8">No data available</td></tr>'); // Ensure column count matches
            }
            if (response.pagination) {
                $('#supervisor-lists-pagination').html(response.pagination); // Update the pagination ID accordingly
            } else {
                $('#supervisor-lists-pagination').html('');
            }
            $('#supervisor-lists-tableInfo').text(response.total > 0 ? `Showing ${response.start} to ${response.end} of ${response.total} entries` : 'No entries available');
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

$('#supervisor-lists-pageLengthSelect').on('change', function() {
    supervisorPageLength = parseInt($(this).val());
    supervisorPage = 1;
    loadSupervisorTableData();
});

$('#supervisor-lists-searchInput').on('input', function() {
    supervisorPage = 1;
    loadSupervisorTableData();
});

$('#supervisor-lists-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    supervisorPage = $(this).data('page');
    loadSupervisorTableData();
});

loadSupervisorTableData();
