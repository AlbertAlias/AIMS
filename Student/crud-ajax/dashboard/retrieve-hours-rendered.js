$(document).ready(function() {
    fetchRenderedHours();
});

function fetchRenderedHours() {
    $.ajax({
        url: 'controller/dashboard/retrieve-hours-rendered.php',
        type: 'GET', 
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#hours_rendered').text(response.hours_rendered);
            } else {
                console.error('Error fetching hours:', response.message);
                $('#hours_rendered').text('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            $('#hours_rendered').text('Error fetching data');
        }
    });
}