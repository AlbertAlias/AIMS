$(document).ready(function() {
    function fetchCoordinatorCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-coorCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Coordinator Count:", data);
                if (data.count !== undefined) {
                    $('#num-coordinators').text(data.count); // Update the count
                } else {
                    $('#num-coordinators').text('0'); // Fallback for unexpected response
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching coordinator count:", error);
                $('#num-coordinators').text('0'); // Fallback for errors
            }
        });
    }

    fetchCoordinatorCount(); // Call the function to fetch the count
});
