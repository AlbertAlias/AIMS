$(document).ready(function() {
    function updateDepartmentCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-deptCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("AJAX Success:", data);
                if (data.count !== undefined) {
                    $('#num-departments').text(data.count);
                } else {
                    $('#num-departments').text('0');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
                $('#num-departments').text('0');
            }
        });
    }

    updateDepartmentCount();
});