$(document).ready(function () {
    // Submit the dean's information
    $("#assignDeanForm").on("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        // Gather form data
        var formData = {
            deanID: $("#deanID").val(),
            last_name: $("#add_last_name").val(),
            first_name: $("#add_first_name").val(),
            username: $("#add_username").val(),
            password: $("#add_password").val(),
            department1: $("#add_department1").val(),
            department2: $("#add_department2").val(),
            department3: $("#add_department3").val()
        };

        // Send data via AJAX to PHP backend for processing
        $.ajax({
            url: "controller/departments/create-dean.php", // PHP file to handle dean creation
            type: "POST",
            data: formData,
            success: function (response) {
                console.log(response);
                var result = JSON.parse(response);
                if (result.success) {
                    alert("Dean added successfully!");
                    // Optionally clear the form or reset UI here
                } else {
                    alert("Error: " + result.error);
                }
            },
            error: function () {
                alert("An error occurred while submitting the form.");
            }
        });
    });
});