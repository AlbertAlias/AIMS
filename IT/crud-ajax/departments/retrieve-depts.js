$(document).ready(function () {
    function populateDepartments() {
        $.ajax({
            url: "controller/departments/retrieve-depts.php", // PHP script to fetch departments
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    const departments = response.data;
                    
                    // Clear and populate options for each department select
                    const selectElements = ["#add_department1", "#add_department2", "#add_department3"];
                    selectElements.forEach((selector) => {
                        const select = $(selector);
                        select.empty(); // Clear existing options
                        select.append('<option selected>Choose Department</option>'); // Default option
                        departments.forEach((dept) => {
                            select.append(`<option value="${dept.id}">${dept.name}</option>`);
                        });
                    });
                } else {
                    console.error("Error fetching departments:", response.error);
                }
            },
            error: function () {
                console.error("An error occurred while fetching departments.");
            }
        });
    }

    // Call the function to populate departments when the page loads
    populateDepartments();

    // Optional: Re-populate departments after adding a new department
    $("#addDepartmentForm").on("submit", function () {
        setTimeout(populateDepartments, 1000); // Delay to ensure the new department is added
    });
});