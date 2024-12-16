$(document).ready(function () {
    // Handle form submission
    $("#registrarForm").on("submit", function (event) {
        event.preventDefault(); // Prevent form default submission

        // Gather form data
        const formData = {
            registrar_last_name: $("#registrar_last_name").val(),
            registrar_first_name: $("#registrar_first_name").val(),
            registrar_personal_email: $("#registrar_personal_email").val(),
            registrar_username: $("#registrar_username").val(),
            registrar_password: $("#registrar_password").val(),
        };

        $.ajax({
            url: "controller/registrar/create-registrar.php", // PHP script to handle request
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log(response); // Log the entire response
                if (response.success) {
                    alert("Registrar added successfully!");
                    $("#registrarForm")[0].reset(); // Reset the form
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                alert("An error occurred. Please try again.");
            },
        });
    });
});
