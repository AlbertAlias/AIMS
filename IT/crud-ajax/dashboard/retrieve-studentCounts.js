$(document).ready(function() {
    function fetchStudentCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-studentCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Student Count Response:", data);
                if (data.count !== undefined) {
                    $('#num-students').text(data.count); // Update the student count
                } else {
                    $('#num-students').text('0'); // Fallback in case of unexpected response
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching student count:", error);
                $('#num-students').text('0'); // Fallback on error
            }
        });
    }

    fetchStudentCount(); // Call the function to fetch the count
});
