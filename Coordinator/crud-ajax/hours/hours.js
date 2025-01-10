document.getElementById('setHoursModal').addEventListener('show.bs.modal', function () {
    fetch('controller/hours/get_hours.php')
    .then(response => response.json())
    .then(data => {
        if (data) {
            document.getElementById('hoursNeeded').value = data.hours_needed || '';
        }
    });
});

$(document).ready(function () {
    $("#saveHoursButton").click(function () {
        const hoursNeeded = $("#hoursNeeded").val();

        if (!hoursNeeded || hoursNeeded <= 0) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Invalid Input',
                text: 'Please enter a valid number of hours.',
                showConfirmButton: false,
                timer: 2000,
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
            url: "controller/hours/save_hours.php",
            type: "POST",
            data: {
                hoursNeeded: hoursNeeded
            },
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Hours Set Successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    $('#setHoursModal').modal('hide');
                    $("#hoursNeeded").val('');
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Failed to Save Hours',
                        text: result.error,
                        showConfirmButton: false,
                        timer: 2000,
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
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'Unexpected Error',
                    text: 'Please try again later.',
                    showConfirmButton: false,
                    timer: 2000,
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
