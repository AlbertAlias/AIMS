let studentPage = 1;
let studentPageLength = 10;

function loadTableData() {
    $.ajax({
        url: 'controller/student-lists/retrieve-stud-lists.php',
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
            }
            if (response.pagination) {
                $('#stud-lists-pagination').html(response.pagination);
            }
            $('#stud-lists-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
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