$(document).ready(function () {
    console.log("post-requirement.js loaded");  // This will print to the console

    $("#postRequirementBtn").on("click", function (e) {
        e.preventDefault(); // Prevent default form submission
        console.log("Post button clicked");  // Check if the click event is triggered

        const requirementTitle = $("#requirementTitle").val().trim();
        const requirementDescription = $("#requirementDescription").val().trim();
        const deadline = $(".deadline-input").val(); // Get the deadline input value

        if (!requirementTitle || !deadline) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Incomplete',
                text: 'Please fill out all fields.',
                showConfirmButton: false,
                timer: 3000,
                background: '#ffcdd2',
                iconColor: '#b71c1c',
                color: '#b71c1c',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }

        $.ajax({
            url: "controller/requirement/post-requirement.php",
            type: "POST",
            data: {
                requirementTitle: requirementTitle,
                requirementDescription: requirementDescription,
                deadline: deadline, // Include deadline
            },
            dataType: "json",
            success: function (result) {
                console.log(result);  // Log the result to see what is returned from the server

                if (result.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Posted Successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    // Reset the form fields
                    $("#requirementTitle").val('');
                    $("#requirementDescription").val('');
                    $(".deadline-input").val('');
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Failed to Post',
                        text: result.error,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#ffcdd2',
                        iconColor: '#b71c1c',
                        color: '#b71c1c',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: ", error);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'Unexpected Error',
                    text: 'Please try again later.',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#ffcdd2',
                    iconColor: '#b71c1c',
                    color: '#b71c1c',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            }
        });
    });
});