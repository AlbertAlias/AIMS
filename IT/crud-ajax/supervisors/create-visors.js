$(document).ready(function () {
    $("#visorSubmitBtn").on("click", function (event) {
        event.preventDefault();

        const formData = {
            visor_last_name: $("#visor_last_name").val(),
            visor_first_name: $("#visor_first_name").val(),
            visor_middle_name: $("#visor_middle_name").val(),
            visor_gender: $("#visor_gender").val(),
            visor_personal_email: $("#visor_personal_email").val(),
            visor_company_name: $("#visor_company_name").val(),
            visor_company_address: $("#visor_company_address").val(),
            visor_username: $("#visor_username").val(),
            visor_password: $("#visor_password").val(),
        };

        let emptyField = false;
        for (const field in formData) {
            if (formData[field] === "") {
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
            url: "controller/supervisors/create-visors.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Supervisor added successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $("#visorForm")[0].reset();
                    fetchUserAnalytics();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Error: ' + response.message,
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
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
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
            },
        });
    });
});
