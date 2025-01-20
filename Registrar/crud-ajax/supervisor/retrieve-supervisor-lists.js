let supervisorPage = 1;
let supervisorPageLength = 10;

function loadSupervisorTableData() {
    $.ajax({
        url: 'controller/supervisor/retrieve-supervisor-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: supervisorPage,
            length: supervisorPageLength,
            search: $('#supervisor-lists-searchInput').val()
        },
        success: function(response) {
            if (response.html) {
                $('#supertbody').html(response.html);
            } else {
                $('#supertbody').html('<tr><td colspan="8">No data available</td></tr>');
            }
            if (response.pagination) {
                $('#supervisor-lists-pagination').html(response.pagination);
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
