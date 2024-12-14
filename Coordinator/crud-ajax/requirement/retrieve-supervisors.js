// On Company selection change, fetch corresponding supervisors
$('#companySelect').on('change', function() {
    let company = $(this).val();  // Get selected company

    if (company) {
        // Fetch supervisors for the selected company
        $.ajax({
            url: 'controller/requirement/retrieve-supervisors.php', // The PHP endpoint to fetch supervisors
            type: 'GET',
            data: { company: company },
            dataType: 'json',
            success: function(data) {
                // Populate the Supervisor select element
                let supervisorSelect = $('#supervisorSelect');
                supervisorSelect.empty(); // Clear any existing options
                supervisorSelect.append('<option selected>Select Supervisor</option>'); // Default option

                // Populate options for supervisors
                data.supervisors.forEach(function(supervisor) {
                    supervisorSelect.append('<option value="' + supervisor.user_id + '">' + supervisor.first_name + ' ' + supervisor.last_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching supervisors:', error);
            }
        });
    } else {
        // Clear the supervisor dropdown if no company is selected
        $('#supervisorSelect').empty();
        $('#supervisorSelect').append('<option selected>Select Supervisor</option>');
    }
});
