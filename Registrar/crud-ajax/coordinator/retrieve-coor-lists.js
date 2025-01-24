let coordinatorPage = 1;
let coordinatorPageLength = 10;

function loadCoordinatorTableData() {
    $.ajax({
        url: 'controller/coordinator/retrieve-coor-lists.php', // Adjust this URL to match your PHP handler
        type: 'GET',
        dataType: 'json',
        data: {
            page: coordinatorPage,
            length: coordinatorPageLength,
            search: $('#coord-lists-searchInput').val()
        },
        success: function(response) {
            if (response.html) {
                $('#coortbody').html(response.html);  // Changed tbody to coortbody
            } else {
                $('#coortbody').html('<tr><td colspan="5">No data available</td></tr>');  // Changed tbody to coortbody
            }
            if (response.pagination) {
                $('#coord-lists-pagination').html(response.pagination);
            } else {
                $('#coord-lists-pagination').html('');
            }
            $('#coord-lists-tableInfo').text(response.total > 0 ? `Showing ${response.start} to ${response.end} of ${response.total} entries` : 'No entries available');
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.log('Response Text:', xhr.responseText);  // Log the response text for debugging
        }
        
    });
}

$('#coord-lists-pageLengthSelect').on('change', function() {
    coordinatorPageLength = parseInt($(this).val());
    coordinatorPage = 1;
    loadCoordinatorTableData();
});

$('#coord-lists-searchInput').on('input', function() {
    coordinatorPage = 1;
    loadCoordinatorTableData();
});

$('#coord-lists-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    coordinatorPage = $(this).data('page');
    loadCoordinatorTableData();
});

loadCoordinatorTableData();
