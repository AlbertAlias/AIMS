$(document).ready(function () {
    $('#assignDeanForm').on('submit', function (e) {
        e.preventDefault(); // Prevent form submission

        // Gather form data, including the hidden deanID
        var formData = {
            'deanID': $('#deanID').val(),  // Add deanID from the hidden field
            'last_name': $('#add_last_name').val(),
            'first_name': $('#add_first_name').val(),
            'department1': $('#add_department1').val(),
            'department2': $('#add_department2').val(),
            'department3': $('#add_department3').val(),
            'username': $('#add_username').val(),
            'password': $('#add_password').val()
        };

        // Debug log to check department values
        console.log('Department 1:', formData.department1);
        console.log('Department 2:', formData.department2);
        console.log('Department 3:', formData.department3);

        // Validate that all department values are not the default
        if (formData.department1 === "Choose Department 1" || formData.department2 === "Choose Department 2" || formData.department3 === "Choose Department 3") {
            alert("Please select valid departments.");
            return; // Prevent submission if departments are not selected
        }

        $.ajax({
            url: 'controller/departments/create-dean.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log(response); // Log the response to see if it's valid JSON
                try {
                    var data = JSON.parse(response); // Attempt to parse the response as JSON
                    if (data.success) {
                        // Success handling
                    } else {
                        alert("Error: " + data.message); // Handle failure
                    }
                } catch (e) {
                    alert("Error: Invalid response format.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", xhr.responseText); // Log the error response
                alert("There was an error in the request: " + error); // Handle request error
            }
        });
    });
});