$(document).ready(function() {
    function updateDepartmentCount() {
        $.ajax({
            url: 'controller/dashboards/retrieve-deptCounts.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("AJAX Success:", data);
                if (data.count !== undefined) {
                    $('#num-depts').text(data.count);
                } else {
                    $('#num-depts').text('0');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
                $('#num-depts').text('0');
            }
        });
    }

    updateDepartmentCount();
});