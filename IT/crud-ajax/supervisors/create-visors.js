$(document).ready(function () {
    $("#visorSubmitBtn").on("click", function (event) {
        event.preventDefault();

        const formData = new FormData();
        
        // Collecting form data
        formData.append('visor_last_name', $("#visor_last_name").val());
        formData.append('visor_first_name', $("#visor_first_name").val());
        formData.append('visor_middle_name', $("#visor_middle_name").val());
        formData.append('visor_gender', $("#visor_gender").val());
        formData.append('visor_personal_email', $("#visor_personal_email").val());
        formData.append('visor_company_name', $("#visor_company_name").val());
        formData.append('visor_company_address', $("#visor_company_address").val());
        formData.append('visor_username', $("#visor_username").val());
        formData.append('visor_password', $("#visor_password").val());

        // Handling file uploads (images)
        formData.append('visor_company_image', $("#visor_company_image")[0].files[0]);
        formData.append('visor_company_logo', $("#visor_company_logo")[0].files[0]);

        let emptyField = false;

        // Check required fields for emptiness
        const requiredFields = [
            'visor_last_name', 'visor_first_name', 'visor_gender', 'visor_personal_email', 
            'visor_company_name', 'visor_company_address', 'visor_username', 'visor_password'
        ];

        for (const field of requiredFields) {
            if (formData.get(field) === "") {
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
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent setting contentType header
            dataType: "json", // Expected JSON response
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
                    loadVisor();
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
