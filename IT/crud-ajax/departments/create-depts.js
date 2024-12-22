$(document).ready(function () {
    // Handle form submission
    $("#deptSubmitBtn").on("click", function (e) {
        e.preventDefault(); // Prevent form default submission

        const departmentName = $("#department_name").val(); // Get input value

        // Check if the department name is empty
        if (!departmentName) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please fill in the department name!',
                showConfirmButton: false,
                timer: 3000,
                background: '#f8d7da',
                iconColor: '#721c24',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return; // Prevent form submission if the field is empty
        }

        // Proceed with AJAX request if all fields are filled
        $.ajax({
            url: "controller/departments/create-depts.php", // PHP script to handle insertion
            type: "POST",
            data: {
                department_name: departmentName
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Department added successfully!',
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
                    populateDepartments();
                    loadDepartments();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error: ' + response.error,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8d7da',
                        iconColor: '#721c24',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            },
            error: function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'An error occurred. Please try again.',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8d7da',
                    iconColor: '#721c24',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            }
        });
    });
});
