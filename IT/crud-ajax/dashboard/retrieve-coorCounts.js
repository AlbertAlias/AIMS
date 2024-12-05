$(document).ready(function() {
    function fetchCoordinatorCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-coorCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#num-coor').text(data.count);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching coordinator count:', error);
                $('#num-coor').text('0'); // Fallback in case of error
            }
        });
    }

    fetchCoordinatorCount(); // Call the function to fetch count
});