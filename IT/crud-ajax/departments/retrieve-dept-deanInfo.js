let deptCurrentPage = 1;
let deptPageLength = 10;

// Fetch and display table data
function loadTableData() {
    $.ajax({
        url: 'controller/departments/retrieve-dept-deanInfo.php',
        type: 'GET',
        dataType: 'json',  // Automatically parses JSON response
        data: {
            page: deptCurrentPage,
            length: deptPageLength,
            search: $('#depts-searchInput').val()
        },
        success: function(response) {
            console.log('Server Response:', response); // Debugging line

            // Check if the response contains an error
            if (response.error) {
                console.error('Error:', response.error);
                alert('An error occurred while fetching the data.');
                return;
            }

            // Clear table body first
            $('#deptsTable tbody').html('');

            // Check if data is available
            if (response.total > 0) {
                // Populate the table if data is available
                $('#deptsTable tbody').html(response.html);

                // Display table info
                $('#depts-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);

                // Populate pagination if data is available
                $('#depts-pagination').html(response.pagination);
            } else {
                // Show no data available message if no data is found
                $('#depts-tableInfo').text('Showing 0 to 0 of 0 entries');

                // Add "No data available" to tbody if no data is found
                $('#deptsTable tbody').html('<tr><td colspan="5" class="text-center">No data available</td></tr>');

                // Clear pagination if no data
                $('#depts-pagination').html('');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.error('Response Text:', xhr.responseText); // Log the actual response from the server
            alert('An error occurred while fetching the data.');
        }
    });
}

// Handle page length change
$('#depts-pageLengthSelect').on('change', function() {
    deptPageLength = parseInt($(this).val());
    loadTableData();
});

// Handle search input
$('#depts-searchInput').on('input', function() {
    loadTableData();
});

// Handle pagination click
$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    deptCurrentPage = $(this).data('page');
    loadTableData();
});

// Initial data load
loadTableData();