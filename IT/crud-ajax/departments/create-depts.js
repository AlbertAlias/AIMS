$(document).ready(function () {
    $("#addDepartmentForm").on("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        const departmentName = $("#department_name").val(); // Get input value
        const deptID = $("#deptID").val(); // Get department ID if it's for updating

        // Perform AJAX request
        $.ajax({
            url: "controller/departments/create-depts.php", // PHP script to handle insertion or update
            type: "POST",
            data: {
                department_name: departmentName,
                id: deptID // Include the deptID if it's an update
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // SweetAlert success notification
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: deptID ? 'Department updated successfully!' : 'Department added successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    $("#department_name").val(""); // Clear the input field
                    $("#deptID").val(""); // Reset deptID field after success
                    setTimeout(populateDepartments, 1000); // Refresh department list
                } else {
                    alert("Error: " + response.error);
                }
            },
            error: function () {
                alert("An error occurred. Please try again.");
            }
        });
    });
});