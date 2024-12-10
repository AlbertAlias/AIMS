$(document).ready(function () {
    function populateDepartments() {
        $.ajax({
            url: "controller/departments/retrieve-depts.php", // PHP script to fetch departments
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    const departments = response.data;

                    // Populate departments for all three select elements
                    const selectElements = ["#add_department1", "#add_department2", "#add_department3"];
                    selectElements.forEach((selector) => {
                        const select = $(selector);
                        departments.forEach((dept) => {
                            // Only add departments that are not already assigned to the dean
                            if (!select.find(`option[value="${dept.id}"]`).length) {
                                select.append(`<option value="${dept.id}">${dept.name}</option>`);
                            }
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