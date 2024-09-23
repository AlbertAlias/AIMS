$(document).ready(function() {
    function fetchAdminCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-adminCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#num-admins').text(data.count);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching admin count:', error);
                $('#num-admins').text('0');
            }
        });
    }

    fetchAdminCount();
});