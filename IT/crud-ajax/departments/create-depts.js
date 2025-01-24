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
            data: formData,
            processData: false,
            contentType: false,
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
                    populateDepartments();
                    loadDepartments();
                    populateDepartmentSelect()
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.error,
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