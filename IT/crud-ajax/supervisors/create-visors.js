$(document).ready(function () {
    // Handle form submission
    $("#visorForm").on("submit", function (event) {
        event.preventDefault(); // Prevent form default submission

        // Gather form data
        const formData = {
            visor_last_name: $("#visor_last_name").val(),
            visor_first_name: $("#visor_first_name").val(),
            visor_middle_name: $("#visor_middle_name").val(),
            visor_gender: $("#visor_gender").val(),
            visor_personal_email: $("#visor_personal_email").val(),
            visor_company_name: $("#visor_company_name").val(),
            visor_company_address: $("#visor_company_address").val(),
            visor_username: $("#visor_username").val(),
            visor_password: $("#visor_password").val(),
        };

        $.ajax({
            url: "controller/supervisors/create-visors.php", // PHP script to handle request
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert("Supervisor added successfully!");
                    $("#visorForm")[0].reset(); // Reset the form
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
