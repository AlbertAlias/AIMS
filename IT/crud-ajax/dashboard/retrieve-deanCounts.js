$(document).ready(function() {
    function fetchDeanCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-deanCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#num-deans').text(data.count);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching dean count:', error);
                $('#num-deans').text('0');
            }
        });
    }

    fetchDeanCount();
});