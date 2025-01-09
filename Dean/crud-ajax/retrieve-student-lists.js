let studentlistsPage = 1;
let studentlistsPageLength = 10;

function loadstudentTableData() {
    $.ajax({
        url: 'controller/retrieve-student-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: studentlistsPage,
            length: studentlistsPageLength,
            search: $('#student-searchInput').val()
        },
        success: function(response) {
            if (response.html) {
                $('#studentsTable tbody').html(response.html);
            }
            if (response.pagination) {
                $('#student-pagination').html(response.pagination);
            }
            $('#student-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

$('#student-pageLengthSelect').on('change', function() {
    studentlistsPageLength = parseInt($(this).val());
    studentlistsPage = 1;
    loadstudentTableData();
});

$('#student-searchInput').on('input', function() {
    studentlistsPage = 1;
    loadstudentTableData();
});

$('#student-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    studentlistsPage = $(this).data('page');
    loadstudentTableData();
});

loadstudentTableData();