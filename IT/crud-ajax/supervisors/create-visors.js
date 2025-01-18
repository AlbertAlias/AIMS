$(document).ready(function () {
    $("#visorSubmitBtn").on("click", function (event) {
        event.preventDefault();
        const form = $("#visorForm")[0];
        const formData = new FormData(form);
        const lastName = $("#visor_last_name").val();
        const firstName = $("#visor_first_name").val();
        const gender = $("#visor_gender").val();
        const email = $("#visor_personal_email").val();
        const companyName = $("#visor_company_name").val();
        const companyAddress = $("#visor_company_address").val();
        const username = $("#visor_username").val();
        const password = $("#visor_password").val();

        if (!lastName || !firstName || !gender || !email || !companyName || !companyAddress || !username || !password) {
            Swal.fire({
                toast: true,
                position: 'top-end',
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

        const companyLogo = $("#company_logo")[0].files[0];
        const companyImage = $("#company_image")[0].files[0];
        const maxFileSize = 40 * 1024 * 1024;

        if (companyLogo && companyLogo.size > maxFileSize) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Company logo file size exceeds 40MB!',
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

        if (companyImage && companyImage.size > maxFileSize) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Company image file size exceeds 40MB!',
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

        if (companyLogo) {
            formData.append("company_logo", companyLogo);
        }

        if (companyImage) {
            formData.append("company_image", companyImage);
        }

        console.log(...formData.entries());
        $.ajax({
            url: "controller/supervisors/create-visors.php",
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
                        position: 'top-end',
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
                console.log('Error Status: ' + status);
                console.log('Error Message: ' + error);
                console.log('Response Text: ' + xhr.responseText);
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
