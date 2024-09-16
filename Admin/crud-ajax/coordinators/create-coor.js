$(document).ready(function () {
    $('#submitBtn').on('click', function (e) {
        e.preventDefault();

        var coordinatorId = $('#coordinator_id').val(); // Get coordinator ID
        if (!coordinatorId) { // Only run if no ID (create mode)
            var contactNumber = $('#contact_number').val();
            if (contactNumber.length === 10 && contactNumber[0] !== '0') {
                contactNumber = '0' + contactNumber;
            }
            $('#contact_number').val(contactNumber);

            var formData = $('#coordinatorForm, #accountInfoForm').serialize();

            $.ajax({
                url: 'controller/coordinators/create-coor.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert('Coordinator added successfully!');
                        loadCoordinators();
                        disableFormElements();
                        $('#coordinatorForm')[0].reset();
                        $('#accountInfoForm')[0].reset();
                    } else {
                        alert('Failed to add coordinator: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ', error);
                    alert('An error occurred while processing the request.');
                }
            });
        } else {
            console.log('Coordinator ID exists, skipping create.');
        }
    });
});