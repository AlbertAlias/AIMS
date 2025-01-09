function populateDepartments() {
    $.ajax({
        url: "controller/departments/retrieve-depts.php?time=" + new Date().getTime(), // Add timestamp to avoid cache
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response); // Log the response to verify the data
            if (response.success) {
                const departments = response.data;

                // Define the select element IDs
                const selectElements = ["#add_department1", "#add_department2", "#add_department3"];

                // Loop through each select element to update
                selectElements.forEach((selector) => {
                    const select = $(selector);
                    select.empty(); // Clear existing options

                    // Add the "Choose Department" option (this is always available)
                    select.append('<option value="" selected>Choose Department</option>');

                    if (departments.length > 0) {
                        select.prop("disabled", false); // Enable dropdown

                        // Populate with department options
                        departments.forEach((dept) => {
                            select.append(`<option value="${dept.id}">${dept.name}</option>`);
                        });

                        // Reset "Choose Department" selection to ensure it's available
                        select.val("");

                    } else {
                        select.prop("disabled", true); // Disable dropdown if no departments
                        select.append('<option disabled selected>No available departments</option>');
                    }
                });
            } else {
                console.error("Error fetching departments:", response.error);
                alert("Failed to retrieve departments. Please try again later.");
            }
        },
        error: function () {
            console.error("An error occurred while fetching departments.");
            alert("An error occurred while communicating with the server.");
        }
    });
}

// Call the function to populate departments when the page loads
$(document).ready(function () {
    populateDepartments();

    // Re-populate departments after adding a new department
    $("#assignDeanForm").on("submit", function () {
        setTimeout(populateDepartments, 1000); // Delay to ensure the new department is added
    });

    // Allow "Choose Department" to be selected again after a department is chosen
    $(document).on('change', '.form-select', function () {
        const selectedValue = $(this).val();

        // If the "Choose Department" option (empty value) is selected, reset the department selection
        if (selectedValue === "") {
            $(this).val(""); // Reset the selection to "Choose Department"
        }
    });
});