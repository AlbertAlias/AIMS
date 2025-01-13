$(document).ready(function () {
    $("#deptSubmitBtn").on("click", function (e) {
        e.preventDefault();
        const form = $("#addDepartmentForm")[0];
        const formData = new FormData(form);
        const departmentName = $("#department_name").val();

        if (!departmentName) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please fill in the department name!',
                showConfirmButton: false,
                timer: 2000,
                background: '#f8d7da',
                iconColor: '#721c24',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }

        $.ajax({
            url: "controller/departments/create-depts.php",
            type: "POST",
            data: formData, // Send the FormData object for file handling
            processData: false, // Do not process the data
            contentType: false, // Do not set content type
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Department added successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $("#addDepartmentForm")[0].reset();
                    populateDepartments(); // If you have a function to update the department list
                    loadDepartments(); // If you have a function to load departments dynamically
                    populateDepartmentSelect() // If you want to populate a select dropdown with the new department
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error: ' + response.error,
                        showConfirmButton: false,
                        timer: 2000,
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
                    timer: 2000,
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