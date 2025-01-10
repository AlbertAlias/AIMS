function populateDepartments() {
    $.ajax({
        url: "controller/departments/retrieve-depts.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.success) {
                const departments = response.data;
                const selectElements = ["#add_department1", "#add_department2", "#add_department3"];

                selectElements.forEach((selector) => {
                    const select = $(selector);
                    select.empty();
                    select.append('<option value="" selected>Choose Department</option>');

                    if (departments.length > 0) {
                        select.prop("disabled", false);
                        departments.forEach((dept) => {
                            select.append(`<option value="${dept.id}">${dept.name}</option>`);
                        });
                        select.val("");
                    } else {
                        select.prop("disabled", true);
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

$(document).ready(function () {
    populateDepartments();
});