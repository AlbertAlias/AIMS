$(document).ready(function () {
    // Check if the update button is clicked (and show it dynamically if needed)
    $("#deanUpdateBtn").click(function (e) {
        e.preventDefault(); // Prevent default behavior

        // Collect data from the form
        var lastName = $("#last_name").val();
        var firstName = $("#first_name").val();
        var username = $("#username").val();
        var departmentId = $("#dean_department").val(); // Selected department ID

        // Validate if fields are not empty
        if (lastName === "" || firstName === "" || username === "" || departmentId === "Choose Department") {
            alert("Please fill out all fields.");
            return;
        }

        // Send the data via AJAX to the update PHP script
        $.ajax({
            url: 'controller/departments/update-dept-deanInfo.php', // PHP script to handle the update
            type: 'POST',
            data: {
                username: username,
                last_name: lastName,
                first_name: firstName,
                department_id: departmentId
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.success) {
                    alert("Department updated successfully!");
                    // You might want to reset the form or reload data
                } else {
                    alert("Error: " + data.error);
                }
            },
            error: function () {
                alert("An error occurred. Please try again.");
            }
        });
    });

    // Optional: Dynamically show the update button when needed
    function showUpdateButton() {
        $('#deanUpdateBtn').show();
    }

    // Example usage: show the button when data is loaded
    showUpdateButton();
});