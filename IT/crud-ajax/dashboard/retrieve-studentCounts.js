$(document).ready(function() {
    function fetchStudentCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-studentCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.count !== undefined) {
                    $('#num-students').text(data.count);
                } else {
                    $('#num-students').text('0');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching student count:", error);
                $('#num-students').text('0');
            }
        });
    }

    fetchStudentCount();
});
