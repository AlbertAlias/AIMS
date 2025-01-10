$(document).ready(function () {
    $("#deanSubmitBtn").on("click", function (event) {
        event.preventDefault();

        const formData = {
            last_name: $("#add_last_name").val(),
            first_name: $("#add_first_name").val(),
            username: $("#add_username").val(),
            password: $("#add_password").val(),
            department1: $("#add_department1").val(),
            department2: $("#add_department2").val(),
            department3: $("#add_department3").val(),
        };

        let emptyField = false;

        if (formData.department1 === "") {
            emptyField = true;
        }

        for (const field in formData) {
            if (formData[field] === "" && field !== "department2" && field !== "department3") {
                emptyField = true;
                break;
            }
        }

        if (emptyField) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Please fill out all required fields!',
                showConfirmButton: false,
                timer: 3000,
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
            url: "controller/departments/create-dean.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Dean added successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $("#assignDeanForm")[0].reset();
                    loadDeans();
                    fetchUserAnalytics();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
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
            }
        });
    });
});