let studentlistsPage = 1;
let studentlistsPageLength = 10;

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
            if (response.html) {
                $('#stud-lists tbody').html(response.html);
            } else {
                $('#stud-lists tbody').html('<tr><td colspan="7">No data available</td></tr>');
            }
            if (response.pagination) {
                $('#stud-lists-pagination').html(response.pagination);
            } else {
                $('#stud-lists-pagination').html('');
            }
            // $('#stud-lists-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
            $('#stud-lists-tableInfo').text(response.total > 0 ? `Showing ${response.start} to ${response.end} of ${response.total} entries` : 'No entries available');
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

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

loadTableData();