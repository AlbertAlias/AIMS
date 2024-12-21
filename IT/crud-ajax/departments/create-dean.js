$(document).ready(function () {
    $("#assignDeanForm").on("submit", function (event) {
        event.preventDefault();

        // Gather form data
        var formData = {
            last_name: $("#add_last_name").val(),
            first_name: $("#add_first_name").val(),
            username: $("#add_username").val(),
            password: $("#add_password").val(),
            department1: $("#add_department1").val(),
            department2: $("#add_department2").val(),
            department3: $("#add_department3").val(),
        };

        // Debugging
        console.log("Form data being sent:", formData);

        // Validate required fields
        if (!formData.last_name || !formData.first_name || !formData.username || !formData.password || !formData.department1) {
            alert("Please fill in all required fields.");
            return;
        }

        // AJAX request
        $.ajax({
            url: "controller/departments/create-dean.php",
            type: "POST",
            data: formData,
            success: function (response) {
                console.log("Raw response from server:", response);
                try {
                    if (typeof response === "string") {
                        response = JSON.parse(response); // Parse string into JSON
                    }

                    if (response.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-right',
                            icon: 'success',
                            title: 'Dean added successfully!',
                            showConfirmButton: false,
                            timer: 3000,
                            background: '#b9f6ca',
                            iconColor: '#2e7d32',
                            color: '#155724',
                            customClass: {
                                popup: 'mt-5'
                            }
                        });
                        $("#assignDeanForm")[0].reset(); // Reset the form

                        loadDeans();
                        fetchUserAnalytics();
                    } else {
                        // Error handling for existing username
                        if (response.error === 'Username already exists') {
                            Swal.fire({
                                toast: true,
                                position: 'top-right',
                                icon: 'error',
                                title: 'Username already exists',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#f8d7da',
                                iconColor: '#721c24',
                                color: '#721c24',
                                customClass: {
                                    popup: 'mt-5'
                                }
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-right',
                                icon: 'error',
                                title: response.error,
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
                    }
                } catch (e) {
                    console.error("Error parsing response:", e, response);
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Unexpected server response. Check console for details.',
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
            error: function (xhr, status, error) {
                console.error("AJAX error details:", status, error, xhr.responseText);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An error occurred while submitting the form. Please try again.',
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