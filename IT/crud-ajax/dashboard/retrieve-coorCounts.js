$(document).ready(function() {
    function fetchCoordinatorCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-coorCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.count !== undefined) {
                    $('#num-coordinators').text(data.count);
                } else {
                    $('#num-coordinators').text('0');
                }
            },
            error: function(xhr, status, error) {
                $('#num-coordinators').text('0');
            }
        });
    }

    fetchCoordinatorCount();
});