$(document).ready(function() {
    function fetchInternCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-internCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#num-interns').text(data.count);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching intern count:', error);
                $('#num-interns').text('0');
            }
        });
    }

    fetchInternCount();
});