$(document).ready(function () {
    function populateDepartments() {
        $.ajax({
            url: 'controller/add-coor/retrieve-coor.php', // The PHP file to fetch departments
            type: 'GET',
            dataType: 'json', // Expecting JSON response
            success: function (data) {
                // Clear existing options
                $('#department').empty();
                // Add default option
                $('#department').append('<option selected disabled>Choose Department</option>');
    
                // Populate options with department names
                $.each(data, function (index, department) {
                    $('#department').append('<option value="' + department + '">' + department + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', error);
                alert('An error occurred while fetching departments.');
            }
        });
    }    

    // Call the function to populate the departments when the document is ready
    populateDepartments();

    function loadCoordinators() {
        $.ajax({
            url: 'controller/add-coor/retrieve-coor.php', // PHP file to retrieve coordinator information
            type: 'GET',
            dataType: 'json', // Expecting JSON response
            success: function (data) {
                // Debugging: Log the data
                console.log('Coordinator Data:', data);

                // Clear existing content
                $('#coordinatorInfo').empty();

                // Check if coordinators exist
                if (Array.isArray(data) && data.length > 0) {
                    // Loop through the data to create buttons with last_name, first_name
                    $.each(data, function (index, coordinator) {
                        var coordinatorFullName = coordinator.last_name + ', ' + coordinator.first_name;
                        var buttonHtml = '<button class="btn btn-outline-secondary d-block mb-2 w-100" data-id="' + coordinator.id + '">' + coordinatorFullName + '</button>';
                        $('#coordinatorInfo').append(buttonHtml);
                    });
                } else {
                    $('#coordinatorInfo').append('<p>No coordinators found.</p>');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', error);
                alert('An error occurred while retrieving coordinators.');
            }
        });
    }

    // Call the function when the document is ready
    loadCoordinators();

    // Event listener for unlocking forms when any coordinator button is clicked
    $('#coordinatorInfo').on('click', 'button[data-id]', function () {
        var coordinatorId = $(this).data('id');
    
        // Unlock the forms
        unlockForms();
    
        // AJAX request to fetch coordinator data based on the coordinatorId
        $.ajax({
            url: 'controller/add-coor/retrieve-coor.php', // PHP file to fetch coordinator data
            type: 'GET',
            data: { id: coordinatorId }, // Send coordinatorId as a query parameter
            dataType: 'json',
            success: function (response) {
                console.log('Coordinator Details:', response); // Debugging output
    
                if (response.success) {
                    var coordinator = response.data;
    
                    // Populate coordinatorForm with the retrieved data
                    $('#coordinator_id').val(coordinator.id);
                    $('#last_name').val(coordinator.last_name);
                    $('#first_name').val(coordinator.first_name);
                    $('#middle_name').val(coordinator.middle_name);
                    $('#suffix').val(coordinator.suffix);
                    $('#gender').val(coordinator.gender);
                    $('#address').val(coordinator.address);
                    $('#birthdate').val(coordinator.birthdate);
                    $('#civil_status').val(coordinator.civil_status);
                    $('#personal_email').val(coordinator.personal_email);
                    $('#contact_number').val(coordinator.contact_number);
                    $('#department').val(coordinator.department);
    
                    // Populate accountInfoForm with the retrieved data
                    $('#account_email').val(coordinator.account_email);
                    $('#password').val(coordinator.password); // You might want to handle password differently
                } else {
                    alert('Coordinator data could not be retrieved: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', error);
                alert('An error occurred while retrieving coordinator data.');
            }
        });
    });


    // Handle form submission when 'Submit' button is clicked
    $('#submitBtn').on('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get the phone number value and prepend '+63'
        var contactNumber = $('#contact_number').val();
        var contactNumberWithPrefix = '+63' + contactNumber;

        // Update the contact_number input field with the new value
        $('#contact_number').val(contactNumberWithPrefix);

        // Collect form data from both forms
        var formData = $('#coordinatorForm, #accountInfoForm').serialize();

        var coordinatorId = $('#coordinator_id').val();

        // AJAX request to send the data to the server
        $.ajax({
            url: coordinatorId ? 'controller/add-coor/update-coor.php' : 'controller/add-coor/create-coor.php', // Use update or add endpoint
            type: 'POST',
            data: formData,
            dataType: 'json', // Expecting JSON response
            success: function (response) {
                console.log('Response:', response); // Log the response for debugging
                if (response.success) {
                    alert('Coordinator added successfully!');
                    loadCoordinators(); // Reload coordinators list
                    disableFormElements(); // Lock the forms after submission
                    
                    // Reset and lock forms after submission
                    $('#coordinatorForm')[0].reset(); // Reset coordinatorForm
                    $('#accountInfoForm')[0].reset(); // Reset accountInfoForm
                    disableFormElements(); // Call the function to disable the forms after submission
                } else {
                    alert('Failed to add coordinator: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', error);
                alert('An error occurred while processing the request.');
            }
        });

        loadCoordinators();
    });
});