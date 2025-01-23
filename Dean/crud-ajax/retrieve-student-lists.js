// let studentlistsPage = 1;
// let studentlistsPageLength = 10;

// function loadstudentTableData() {
//     $.ajax({
//         url: 'controller/retrieve-student-lists.php',
//         type: 'GET',
//         dataType: 'json',
//         data: {
//             page: studentlistsPage,
//             length: studentlistsPageLength,
//             search: $('#student-searchInput').val()
//         },
//         success: function(response) {
//             if (response.html) {
//                 $('#studentsTable tbody').html(response.html);
//             } else {
//                 $('#studentsTable tbody').html('<tr><td colspan="7">No data available</td></tr>');
//             }
//             if (response.pagination) {
//                 $('#student-pagination').html(response.pagination);
//             } else {
//                 $('#student-pagination').html('');
//             }
//             // $('#student-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
//             $('#student-tableInfo').text(response.total > 0 ? `Showing ${response.start} to ${response.end} of ${response.total} entries` : 'No entries available');
//         },
//         error: function(xhr, status, error) {
//             console.error('AJAX Error:', status, error);
//         }
//     });
// }

// $('#student-pageLengthSelect').on('change', function() {
//     studentlistsPageLength = parseInt($(this).val());
//     studentlistsPage = 1;
//     loadstudentTableData();
// });

// $('#student-searchInput').on('input', function() {
//     studentlistsPage = 1;
//     loadstudentTableData();
// });

// $('#student-pagination').on('click', '.page-link', function(e) {
//     e.preventDefault();
//     studentlistsPage = $(this).data('page');
//     loadstudentTableData();
// });

// loadstudentTableData();

let studentlistsPage = 1;
let studentlistsPageLength = 10;

function loadStudentTableData() {
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
            } else {
                $('#studentsTable tbody').html('<tr><td colspan="8">No data available</td></tr>');
            }
            if (response.pagination) {
                $('#student-pagination').html(response.pagination);
            } else {
                $('#student-pagination').html('');
            }
            $('#student-tableInfo').text(response.total > 0
                ? `Showing ${response.start} to ${response.end} of ${response.total} entries`
                : 'No entries available');
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            $('#studentsTable tbody').html('<tr><td colspan="8">Error loading data</td></tr>');
            $('#student-tableInfo').text('Error retrieving data');
        }
    });
}

$('#student-pageLengthSelect').on('change', function () {
    studentlistsPageLength = parseInt($(this).val());
    studentlistsPage = 1;
    loadStudentTableData();
});

$('#student-searchInput').on('input', function () {
    studentlistsPage = 1;
    loadStudentTableData();
});

$('#student-pagination').on('click', '.page-link', function (e) {
    e.preventDefault();
    studentlistsPage = $(this).data('page');
    loadStudentTableData();
});

loadStudentTableData();
