$(document).on('click', '.open-modal-btn', function () {
    var studentId = $(this).data('user-id');
    console.log('Student ID:', studentId);
    $('#assignSupervisorModal').data('student-id', studentId);
});

$('#assignSupervisorBtn').on('click', function () {
    var company = $('#companySelect').val();
    var supervisorId = $('#supervisorSelect').val();
    var studentId = $('#assignSupervisorModal').data('student-id');

    if (!company || company === "Assign Company") {
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'error',
            title: 'Please select a valid company.',
            showConfirmButton: false,
            timer: 2000,
            background: '#ffcccb',
            iconColor: '#c62828',
            color: '#d32f2f',
            customClass: {
                popup: 'mt-5'
            }
        });
        return;
    }

    if (!supervisorId || supervisorId === "Assign Supervisor") {
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'error',
            title: 'Please select a valid supervisor.',
            showConfirmButton: false,
            timer: 2000,
            background: '#ffcccb',
            iconColor: '#c62828',
            color: '#d32f2f',
            customClass: {
                popup: 'mt-5'
            }
        });
        return;
    }

    if (!studentId) {
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'error',
            title: 'No student ID selected.',
            showConfirmButton: false,
            timer: 2000,
            background: '#ffcccb',
            iconColor: '#c62828',
            color: '#d32f2f',
            customClass: {
                popup: 'mt-5'
            }
        });
        return;
    }

    $.ajax({
        url: 'controller/student-lists/create-assign-supervisors.php',
        type: 'POST',
        data: {
            company: company,
            supervisor_id: supervisorId,
            student_id: studentId
        },
        success: function (response) {
            if (typeof response === "string") {
                response = JSON.parse(response);
            }

            if (response.success) {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'success',
                    title: 'Supervisor assigned successfully!',
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#b9f6ca',
                    iconColor: '#2e7d32',
                    color: '#155724',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
                $('#assignSupervisorModal').modal('hide');
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'Error: ' + response.error,
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#ffcccb',
                    iconColor: '#c62828',
                    color: '#d32f2f',
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
                title: 'AJAX error: ' + error,
                showConfirmButton: false,
                timer: 2000,
                background: '#ffcccb',
                iconColor: '#c62828',
                color: '#d32f2f',
                customClass: {
                    popup: 'mt-5'
                }
            });
        }
    });
});