let deanPage = 1;
let deanPageLength = 10;

function loadDeanTableData() {
    $.ajax({
        url: 'controller/dean/retrieve-dean-lists.php', // Adjust this URL to your PHP handler for dean data
        type: 'GET',
        dataType: 'json',
        data: {
            page: deanPage,
            length: deanPageLength,
            search: $('#dean-lists-searchInput').val()
        },
        success: function(response) {
            if (response.html) {
                $('#deantbody').html(response.html);  // Changed tbody to deantbody
            } else {
                $('#deantbody').html('<tr><td colspan="8">No data available</td></tr>');  // Changed tbody to deantbody
            }
            if (response.pagination) {
                $('#dean-lists-pagination').html(response.pagination);
            } else {
                $('#dean-lists-pagination').html('');
            }
            $('#dean-lists-tableInfo').text(response.total > 0 ? `Showing ${response.start} to ${response.end} of ${response.total} entries` : 'No entries available');
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

$('#dean-lists-pageLengthSelect').on('change', function() {
    deanPageLength = parseInt($(this).val());
    deanPage = 1;
    loadDeanTableData();
});

$('#dean-lists-searchInput').on('input', function() {
    deanPage = 1;
    loadDeanTableData();
});

$('#dean-lists-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    deanPage = $(this).data('page');
    loadDeanTableData();
});

loadDeanTableData();
