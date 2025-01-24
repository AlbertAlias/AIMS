let studentPage = 1;
let studentPageLength = 10;

function loadTableData() {
    $.ajax({
        url: 'controller/student/retrieve-stud-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: studentPage,
            length: studentPageLength,
            search: $('#stud-lists-searchInput').val()
        },
        success: function(response) {
            if (response.html) {
                $('#stud-lists tbody').html(response.html);
            } else {
                $('#stud-lists tbody').html('<tr><td colspan="8">No data available</td></tr>');
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
            console.error('AJAX error:', status, error);
            console.log('Response Text:', xhr.responseText);
        }
    });
}

$('#stud-lists-pageLengthSelect').on('change', function() {
    studentPageLength = parseInt($(this).val());
    studentPage = 1;
    loadTableData();
});

$('#stud-lists-searchInput').on('input', function() {
    studentPage = 1;
    loadTableData();
});

$('#stud-lists-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    studentPage = $(this).data('page');
    loadTableData();
});

loadTableData();