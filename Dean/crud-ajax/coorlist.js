function loadCoordinatorData() {
    $.ajax({
        url: 'controller/coorlist.php', // Update with the correct path to your PHP file
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.data) {
                let html = '';
                response.data.forEach(row => {
                    html += `
                        <tr>
                            <td>${row.coordinator_first_name}</td>
                            <td>${row.coordinator_last_name}</td>
                            <td>${row.department_name}</td>
                            <td>${row.total_students}</td>
                        </tr>`;
                });
                $('#coordata').html(html);
                $('#tableInfo').text(`Showing 1 to ${response.data.length} of ${response.data.length} entries`);
                // Optionally, update pagination dynamically
            } else if (response.error) {
                $('#coordata').html('<tr><td colspan="4">No data available</td></tr>');
                console.error(response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

// Call this function when the page loads or when you need to refresh the table data
$(document).ready(function() {
    loadCoordinatorData();
});
