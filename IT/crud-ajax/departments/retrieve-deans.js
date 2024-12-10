$(document).ready(function() {
    window.loadDeans = function() {
        $.ajax({
            url: 'controller/departments/retrieve-deans.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.deans = response.deans;
                    updateDeanList(window.deans);
                }
            },
        });
    };

    function updateDeanList(deans, message = null) {
        let deanInfo = $('#deanInfo');
        deanInfo.empty();

        if (message) {
            deanInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }

        const limitedDeans = deans.slice(0, 10);
        if (limitedDeans.length === 0) {
            updateDeanList([], 'No deans found');
            return;
        }

        limitedDeans.forEach(function(dean) {
            let deptList = dean.departments.split(', ').map(function(department) {
                return `<div class="text-gray-800">${department}</div>`;
            }).join('');

            let deanButton = `
                <button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${dean.user_id}">
                    ${dean.last_name}, ${dean.first_name}<br>
                    <div class="department-list">${deptList}</div>
                </button>
            `;
            deanInfo.append(deanButton);
        });

        $('.coor-btn').on('click', function() {
            const deanId = $(this).data('id');
            fetchDeanDetails(deanId);
        });
    }

    function fetchDeanDetails(deanId) {
        $.ajax({
            url: 'controller/departments/retrieve-dean-info.php',
            method: 'GET',
            data: { dean_id: deanId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const dean = response.dean;
    
                    $('#add_last_name').val(dean.last_name);
                    $('#add_first_name').val(dean.first_name);
                    $('#add_username').val(dean.username);
    
                    const departments = dean.departments.split(', ');
    
                    $('#add_department1').empty().append('<option selected>Choose Department 1</option>');
                    $('#add_department2').empty().append('<option selected>Choose Department 2</option>');
                    $('#add_department3').empty().append('<option selected>Choose Department 3</option>');
    
                    if (departments.length > 0) {
                        $('#add_department1').append(`<option value="${departments[0]}" selected>${departments[0]}</option>`);
                    }
    
                    if (departments.length > 1) {
                        $('#add_department2').append(`<option value="${departments[1]}" selected>${departments[1]}</option>`);
                    } else {
                        $('#add_department2').val('');
                    }
    
                    if (departments.length > 2) {
                        $('#add_department3').append(`<option value="${departments[2]}" selected>${departments[2]}</option>`);
                    } else {
                        $('#add_department3').val('');
                    }

                    // Show the "Update" and "Cancel" buttons, hide the "Submit" button
                    $('#deanSubmitBtn').hide();
                    $('#deanUpdateBtn').show();
                    $('#deanCancelBtn').show();

                    // Reset button actions
                    $('#deanCancelBtn').on('click', function() {
                        resetForm();
                    });

                    $('#deanUpdateBtn').on('click', function() {
                        updateDeanData(deanId);
                    });
                }
            },
            error: function(xhr, status, error) {
                alert('Error: Failed to fetch dean details. Please try again later.');
            }
        });
    }

    function resetForm() {
        // Reset form fields
        $('#add_last_name').val('');
        $('#add_first_name').val('');
        $('#add_username').val('');
        $('#add_department1').val('Choose Department 1');
        $('#add_department2').val('Choose Department 2');
        $('#add_department3').val('Choose Department 3');

        // Hide "Update" and "Cancel" buttons, show the "Submit" button
        $('#deanUpdateBtn').hide();
        $('#deanCancelBtn').hide();
        $('#deanSubmitBtn').show();
    }

    function updateDeanData(deanId) {
        const lastName = $('#add_last_name').val();
        const firstName = $('#add_first_name').val();
        const username = $('#add_username').val();
        const dept1 = $('#add_department1').val();
        const dept2 = $('#add_department2').val();
        const dept3 = $('#add_department3').val();
    
        // Validate that required fields are not empty
        if (!lastName || !firstName || !username || dept1 === 'Choose Department 1') {
            // Show SweetAlert for missing required fields
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please fill in all the required fields!',
                showConfirmButton: false,
                timer: 3000,
                background: '#f8bbd0',
                iconColor: '#c62828',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return; // Prevent submission if required fields are empty
        }
    
        // Send an AJAX request to update the dean's details
        $.ajax({
            url: 'controller/departments/update-dean-info.php',
            method: 'POST',
            data: {
                dean_id: deanId,
                last_name: lastName,
                first_name: firstName,
                username: username,
                department1: dept1,
                department2: dept2,
                department3: dept3
            },
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function(response) {
                console.log(response); // Log the entire response to debug
                if (response.success) {
                    // Show success message with SweetAlert
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Dean information updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    resetForm(); // Reset the form fields and buttons
                    loadDeans();  // Refresh the dean list after update
                } else {
                    // Show error validation message (e.g., username already exists)
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.message || 'An unexpected error occurred.',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                // Show generic error message
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'An unexpected error occurred',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            }
        });
    }

    loadDeans(); 
    window.refreshDeanList = loadDeans;
});