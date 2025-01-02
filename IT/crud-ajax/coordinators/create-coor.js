$(document).ready(function () {
    // Handle form submission
    $("#coorSubmitBtn").on("click", function (event) {
        event.preventDefault(); // Prevent form default submission

        // Gather form data
        const formData = {
            coor_last_name: $("#coor_last_name").val(),
            coor_first_name: $("#coor_first_name").val(),
            coor_personal_email: $("#coor_personal_email").val(),
            coor_department: $("#coor_department").val(),
            coor_username: $("#coor_username").val(),
            coor_password: $("#coor_password").val(),
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
                title: 'Please fill in all required fields.',
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
            url: 'controller/coordinators/create-coor.php', // PHP script to handle request
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log(response); // Log the entire response
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Coordinator added successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $("#coordinatorForm")[0].reset(); // Reset the form after success
                    loadCoor();
                    loadDepartments();
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
