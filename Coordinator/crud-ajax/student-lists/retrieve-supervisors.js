$('#companySelect').on('change', function() {
    let company = $(this).val();

    if (company) {
        $.ajax({
            url: 'controller/student-lists/retrieve-supervisors.php',
            type: 'GET',
            data: { company: company },
            dataType: 'json',
            success: function(data) {
                let supervisorSelect = $('#supervisorSelect');
                supervisorSelect.empty();
                supervisorSelect.append('<option selected>Select Supervisor</option>');

                data.supervisors.forEach(function(supervisor) {
                    supervisorSelect.append('<option value="' + supervisor.user_id + '">' + supervisor.first_name + ' ' + supervisor.last_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching supervisors:', error);
            }
        });
    } else {
        $('#supervisorSelect').empty();
        $('#supervisorSelect').append('<option selected>Select Supervisor</option>');
    }
});
