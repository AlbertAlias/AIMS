$(document).ready(function () {
    $('#assignDeanForm').on('submit', function (e) {
        e.preventDefault(); // Prevent form submission

        // Gather form data
        var formData = {
            'last_name': $('#add_last_name').val(),
            'first_name': $('#add_first_name').val(),
            'department1': $('#add_department1').val(),
            'department2': $('#add_department2').val(),
            'department3': $('#add_department3').val(),
            'username': $('#add_username').val(),
            'password': $('#add_password').val()
        };

        $.ajax({
            url: 'controller/departments/create-dean.php', // PHP script to handle the insertion
            type: 'POST',
            data: formData,
            success: function (response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // SweetAlert success notification
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Dean is assigned successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    // Reset form fields
                    $('#assignDeanForm')[0].reset();
                    loadDean();
                } else {
                    alert("Error: " + data.message); // Handle failure
                }
            },
            error: function (xhr, status, error) {
                alert("There was an error in the request: " + error); // Handle request error
            }
        });
    });
});