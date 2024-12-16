let masterlistsPage = 1;
let masterlistsPageLength = 10;

// Fetch and display table data
function loadTableData() {
    $.ajax({
        url: 'controller/masterlists/retrieve-master-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: masterlistsPage,
            length: masterlistsPageLength,
            search: $('#master-lists-searchInput').val()
        },
        success: function(response) {
            console.log('Response:', response);
            if (response.html) {
                $('#master-lists tbody').html(response.html);
            }
            if (response.pagination) {
                $('#master-lists-pagination').html(response.pagination);
            }
            $('#master-lists-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.log('Response Text:', xhr.responseText);
        }
    });
}

// Event listeners
$('#master-lists-pageLengthSelect').on('change', function() {
    masterlistsPageLength = parseInt($(this).val());
    masterlistsPage = 1;
    loadTableData();
});

$('#master-lists-searchInput').on('input', function() {
    masterlistsPage = 1;
    loadTableData();
});

$('#master-lists-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    masterlistsPage = $(this).data('page');
    loadTableData();
});

// Initial load
loadTableData();