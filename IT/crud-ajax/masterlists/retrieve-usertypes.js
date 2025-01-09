$(document).ready(function () {
    function populateUserTypeDropdown() {
        $.ajax({
            url: 'controller/masterlists/retrieve-usertypes.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const userTypeDropdown = $("#userTypeDropdown");
                    userTypeDropdown.empty();
                    userTypeDropdown.append('<option value="">Select User Type</option>');
                    response.data.forEach(function (userType) {
                        userTypeDropdown.append(`<option value="${userType}">${userType}</option>`);
                    });
                } else {
                    console.error("Error fetching user types:", response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function populateDepartmentDropdown() {
        $.ajax({
            url: 'controller/masterlists/retrieve-departments.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                const departmentDropdown = $("#departmentDropdown");
                departmentDropdown.empty();
                departmentDropdown.append('<option value="">Select Department</option>');
                response.data.forEach(function (department) {
                    departmentDropdown.append(`<option value="${department.department_id}">${department.department_name}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function populateCompanyDropdown() {
        $.ajax({
            url: 'controller/masterlists/retrieve-companies.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                const companyDropdown = $("#companyDropdown");
                companyDropdown.empty();
                companyDropdown.append('<option value="">Select Company</option>');
                response.data.forEach(function (company) {
                    companyDropdown.append(`<option value="${company.company}">${company.company}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    $("#userTypeDropdown").on("change", function () {
        const selectedUserType = $(this).val();

        $("#departmentDropdown").hide();
        $("#companyDropdown").hide();

        if (selectedUserType === "Student") {
            populateDepartmentDropdown();
            $("#departmentDropdown").show();
        } else if (selectedUserType === "Supervisor") {
            populateCompanyDropdown();
            $("#companyDropdown").show();
        }
    });

    populateUserTypeDropdown();
});