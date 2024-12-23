let coorlistsPage = 1;
let coorlistsPageLength = 10;

// Fetch and display table data
function loadTableData() {
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
            console.log('Response:', response);
            if (response.html) {
                $('#coorTable tbody').html(response.html);
            }
            if (response.pagination) {
                $('#coor-pagination').html(response.pagination);
            }
            $('#coor-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.log('Response Text:', xhr.responseText);
        }
    });
}

// Event listeners
$('#coor-pageLengthSelect').on('change', function() {
    coorlistsPageLength = parseInt($(this).val());
    coorlistsPage = 1;
    loadTableData();
});

$('#coor-searchInput').on('input', function() {
    coorlistsPage = 1;
    loadTableData();
});

$('#coor-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    coorlistsPage = $(this).data('page');
    loadTableData();
});

// Initial load
loadTableData();