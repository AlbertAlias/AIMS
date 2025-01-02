$(document).ready(function () {
    // Handle form submission
    $("#registrarSubmitBtn").on("click", function (event) {
        event.preventDefault(); // Prevent form default submission

        // Gather form data
        const formData = {
            registrar_last_name: $("#registrar_last_name").val(),
            registrar_first_name: $("#registrar_first_name").val(),
            registrar_personal_email: $("#registrar_personal_email").val(),
            registrar_username: $("#registrar_username").val(),
            registrar_password: $("#registrar_password").val(),
        };

        // Check if any required field is empty
        let emptyField = false;
        for (const field in formData) {
            if (formData[field] === "") {
                emptyField = true;
                break;
            }
        }

        // If any required field is empty, show SweetAlert and return
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
            return; // Prevent form submission if fields are empty
        }

        // Proceed with AJAX request if all fields are filled
        $.ajax({
            url: "controller/registrar/create-registrar.php", // PHP script to handle request
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Registrar added successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $("#registrarForm")[0].reset(); // Reset the form
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
            }
        });
    });
});
