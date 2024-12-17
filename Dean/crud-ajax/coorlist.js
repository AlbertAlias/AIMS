// function loadCoordinatorData() {
//     $.ajax({
//         url: 'controller/coorlist.php', // Update with the correct path to your PHP file
//         type: 'GET',
//         dataType: 'json',
//         success: function(response) {
//             if (response.data) {
//                 let html = '';
//                 response.data.forEach(row => {
//                     html += `
//                         <tr>
//                             <td>${row.coordinator_first_name}</td>
//                             <td>${row.coordinator_last_name}</td>
//                             <td>${row.department_name}</td>
//                             <td>${row.total_students}</td>
//                         </tr>`;
//                 });
//                 $('#coordata').html(html);
//                 $('#tableInfo').text(`Showing 1 to ${response.data.length} of ${response.data.length} entries`);
//                 // Optionally, update pagination dynamically
//             } else if (response.error) {
//                 $('#coordata').html('<tr><td colspan="4">No data available</td></tr>');
//                 console.error(response.error);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('AJAX error:', status, error);
//         }
//     });
// }

// // Call this function when the page loads or when you need to refresh the table data
// $(document).ready(function() {
//     loadCoordinatorData();
// });



let coorCurrentPage = 1;
let coorPageLength = 10;

// Fetch table data dynamically
function loadCoorTableData() {
    console.log('Fetching coordinator table...');
    $.ajax({
        url: 'controller/coorlist.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: coorCurrentPage,
            length: coorPageLength,
            search: $('#coorSearchInput').val()
        },
        success: function(response) {
            if (response.html) {
                $('#coorUsersTable tbody').html(response.html);
            }
            if (response.pagination) {
                $('#coorPagination').html(response.pagination);
            }
            $('#coorTableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

// Handle changes in page length
$('#coorPageLengthSelect').on('change', function() {
    coorPageLength = parseInt($(this).val());
    loadCoorTableData();
});

// Handle search
$('#coorSearchInput').on('input', function() {
    loadCoorTableData();
});

// Handle pagination clicks
$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    coorCurrentPage = $(this).data('page');
    loadCoorTableData();
});

// Load the initial table
loadCoorTableData();
