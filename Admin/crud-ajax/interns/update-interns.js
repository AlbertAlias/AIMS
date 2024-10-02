$('#internUpdateBtn').on('click', function() {
    console.log("Update button clicked."); // Debugging line
    $('#internsForm').submit(); // Trigger form submission
});

$('#internsForm').on('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Form validation
    if (!validateForm()) {
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'error',
            title: 'Please fill in all required fields.',
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

    const formData = $(this).serialize(); // Serialize form data

    $.ajax({
        url: 'controller/interns/update-interns.php', // Path to your PHP file
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'success',
                    title: 'Intern updated successfully!',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#b9f6ca',
                    iconColor: '#2e7d32',
                    color: '#155724',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: response.message, // Error message from PHP
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
        error: function(xhr, status, error) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'An unexpected error occurred!',
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