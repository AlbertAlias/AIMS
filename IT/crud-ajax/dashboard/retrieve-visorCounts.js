$(document).ready(function() {
    function fetchSupervisorsCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-visorCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.count !== undefined) {
                    $('#num-supervisors').text(data.count);
                } else {
                    $('#num-supervisors').text('0');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching supervisors count:", error);
                $('#num-supervisors').text('0');
            }
        });
    }

    fetchSupervisorsCount();
});
