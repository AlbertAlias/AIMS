let studentlistsPage = 1;
let studentlistsPageLength = 10;

// Fetch and display table data
function loadTableData() {
    $.ajax({
        url: 'controller/retrieve-student-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: studentlistsPage,
            length: studentlistsPageLength,
            search: $('#stud-lists-searchInput').val()
        },
        success: function(response) {
            console.log('Response:', response);
            if (response.html) {
                $('#stud-lists tbody').html(response.html);
            }
            if (response.pagination) {
                $('#stud-lists-pagination').html(response.pagination);
            }
            $('#stud-lists-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.log('Response Text:', xhr.responseText);
        }
    });
}

// Event listeners
$('#stud-lists-pageLengthSelect').on('change', function() {
    studentlistsPageLength = parseInt($(this).val());
    studentlistsPage = 1;
    loadTableData();
});

$('#stud-lists-searchInput').on('input', function() {
    studentlistsPage = 1;
    loadTableData();
});

$('#stud-lists-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    studentlistsPage = $(this).data('page');
    loadTableData();
});

// Initial load
loadTableData();