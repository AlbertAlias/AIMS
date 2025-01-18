// $(document).ready(function () {
//     $("#visorSubmitBtn").on("click", function (event) {
//         event.preventDefault();

//         // Create FormData instance to handle both text and files
//         const formData = new FormData();

//         // Add regular form fields to formData
//         formData.append("visor_last_name", $("#visor_last_name").val());
//         formData.append("visor_first_name", $("#visor_first_name").val());
//         formData.append("visor_middle_name", $("#visor_middle_name").val());
//         formData.append("visor_gender", $("#visor_gender").val());
//         formData.append("visor_personal_email", $("#visor_personal_email").val());
//         formData.append("visor_company_name", $("#visor_company_name").val());
//         formData.append("visor_company_address", $("#visor_company_address").val());
//         formData.append("visor_username", $("#visor_username").val());
//         formData.append("visor_password", $("#visor_password").val());

//         // Add files to formData
//         const companyLogo = $("#company_logo")[0].files[0];
//         const companyImage = $("#company_image")[0].files[0];

//         // Max file size (40MB)
//         const maxFileSize = 40 * 1024 * 1024;  // 40MB in bytes

//         if (companyLogo && companyLogo.size > maxFileSize) {
//             Swal.fire({
//                 toast: true,
//                 position: 'top-right',
//                 icon: 'error',
//                 title: 'Company logo file size exceeds 40MB!',
//                 showConfirmButton: false,
//                 timer: 2000,
//                 background: '#f8d7da',
//                 iconColor: '#721c24',
//                 color: '#721c24',
//                 customClass: {
//                     popup: 'mt-5'
//                 }
//             });
//             return;
//         }

//         if (companyImage && companyImage.size > maxFileSize) {
//             Swal.fire({
//                 toast: true,
//                 position: 'top-right',
//                 icon: 'error',
//                 title: 'Company image file size exceeds 40MB!',
//                 showConfirmButton: false,
//                 timer: 2000,
//                 background: '#f8d7da',
//                 iconColor: '#721c24',
//                 color: '#721c24',
//                 customClass: {
//                     popup: 'mt-5'
//                 }
//             });
//             return;
//         }

//         if (companyLogo) {
//             formData.append("company_logo", companyLogo);
//         }

//         if (companyImage) {
//             formData.append("company_image", companyImage);
//         }

//         let emptyField = false;

//         // Check required fields for emptiness
//         const requiredFields = [
//             'visor_last_name', 'visor_first_name', 'visor_gender', 'visor_personal_email', 
//             'visor_company_name', 'visor_company_address', 'visor_username', 'visor_password'
//         ];

//         for (const field of requiredFields) {
//             if (formData.get(field) === "") {  // Use .get() for FormData
//                 emptyField = true;
//                 break;
//             }
//         }

//         if (emptyField) {
//             Swal.fire({
//                 toast: true,
//                 position: 'top-right',
//                 icon: 'error',
//                 title: 'Please fill out all required fields!',
//                 showConfirmButton: false,
//                 timer: 2000,
//                 background: '#f8d7da',
//                 iconColor: '#721c24',
//                 color: '#721c24',
//                 customClass: {
//                     popup: 'mt-5'
//                 }
//             });
//             return;
//         }

//         $.ajax({
//             url: "controller/supervisors/create-visors.php",
//             type: "POST",
//             data: formData,
//             processData: false,  // Important to avoid jQuery trying to process the data
//             contentType: false,  // Important to prevent jQuery from setting the content-type header
//             dataType: "json",
//             success: function (response) {
//                 if (response.success) {
//                     Swal.fire({
//                         toast: true,
//                         position: 'top-right',
//                         icon: 'success',
//                         title: 'Supervisor added successfully!',
//                         showConfirmButton: false,
//                         timer: 2000,
//                         background: '#b9f6ca',
//                         iconColor: '#2e7d32',
//                         color: '#155724',
//                         customClass: {
//                             popup: 'mt-5'
//                         }
//                     });
//                     $("#visorForm")[0].reset();
//                     fetchUserAnalytics();
//                     loadVisor();
//                 } else {
//                     Swal.fire({
//                         toast: true,
//                         position: 'top-right',
//                         icon: 'error',
//                         title: 'Error: ' + response.message,
//                         showConfirmButton: false,
//                         timer: 2000,
//                         background: '#f8d7da',
//                         iconColor: '#721c24',
//                         color: '#721c24',
//                         customClass: {
//                             popup: 'mt-5'
//                         }
//                     });
//                 }
//             },
//             error: function (xhr, status, error) {
//                 console.error("AJAX Error:", error);
//                 console.log("Response text:", xhr.responseText); // Log the response text
//                 Swal.fire({
//                     toast: true,
//                     position: 'top-right',
//                     icon: 'error',
//                     title: 'An error occurred. Please try again.',
//                     showConfirmButton: false,
//                     timer: 2000,
//                     background: '#f8d7da',
//                     iconColor: '#721c24',
//                     color: '#721c24',
//                     customClass: {
//                         popup: 'mt-5'
//                     }
//                 });
//             },
//         });
//     });
// });

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

        // Check if required fields are filled
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

        // Check file size for company logo and image (max 40MB)
        const companyLogo = $("#company_logo")[0].files[0];
        const companyImage = $("#company_image")[0].files[0];
        const maxFileSize = 40 * 1024 * 1024; // 40MB in bytes

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
