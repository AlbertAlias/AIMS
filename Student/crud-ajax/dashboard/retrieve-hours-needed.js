$(document).ready(function() {
    function fetchHoursNeeded() {
        $.ajax({
            url: 'controller/dashboard/retrieve-hours-needed.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const hoursNeeded = response.hours_needed;
                    $('#hours_needed').text(hoursNeeded);

                    // Now fetch hours rendered and calculate remaining hours
                    fetchRenderedHours(hoursNeeded);
                } else {
                    console.error('Error:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error); 
            }
        });
    }

    function fetchRenderedHours(hoursNeeded) {
        $.ajax({
            url: 'controller/dashboard/retrieve-hours-rendered.php',
            type: 'GET', 
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const hoursRendered = response.hours_rendered;
                    $('#hours_rendered').text(hoursRendered);

                    // Calculate remaining hours
                    const hoursRemaining = hoursNeeded - hoursRendered;
                    $('#hours_remaining').text(hoursRemaining);
                } else {
                    console.error('Error fetching hours:', response.message);
                    $('#hours_rendered').text('Error: ' + response.message);
                    $('#hours_remaining').text('Error calculating remaining hours');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                $('#hours_rendered').text('Error fetching data');
                $('#hours_remaining').text('Error calculating remaining hours');
            }
        });
    }

    fetchHoursNeeded();
});