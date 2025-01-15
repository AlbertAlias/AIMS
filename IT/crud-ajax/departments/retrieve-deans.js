$(document).ready(function() {
    window.loadDeans = function (searchQuery = '') {
        $.ajax({
            url: 'controller/departments/retrieve-deans.php',
            method: 'GET',
            data: { search: searchQuery }, // Pass the search query
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    window.deans = response.deans;
                    updateDeanList(window.deans);
                } else {
                    console.warn('No deans found. Displaying empty list.');
                    updateDeanList([], response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load deans:', error);
                console.error('Response Text:', xhr.responseText); 
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
    
        const limitedDeans = deans.slice(0, 10); // Limit the list to 10 deans
    
        if (limitedDeans.length === 0) {
            deanInfo.append(`
                <div class="text-center">
                    <img src="../assets/img/notfound.png" alt="No Deans Found" style="margin-top: 3px; max-width: 39%; height: auto;">
                </div>
            `);
            return;
        }
    
        limitedDeans.forEach(function(dean) {
            let deptList = dean.departments.split(', ').map(function(department) {
                return `<div class="text-gray-800">${department}</div>`;
            }).join('');
    
            let deanButton = `<button class="btn btn-outline-secondary d-block mb-2 w-100 dean-btn" data-id="${dean.user_id}">
                                ${dean.last_name}, ${dean.first_name}<br><div class="department-list">${deptList}</div>
                            </button>`;
            deanInfo.append(deanButton);
        });
    
        // Bind click event to dean buttons
        $('.dean-btn').on('click', function () {
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
                    const dept1 = dean.departments.split(', ')[0] || '';
                    const dept2 = dean.departments.split(', ')[1] || 'Choose Department 2';
                    const dept3 = dean.departments.split(', ')[2] || 'Choose Department 3';

                    $('#add_last_name').val(dean.last_name);
                    $('#add_first_name').val(dean.first_name);
                    $('#add_username').val(dean.username);

                    $('#add_department1').html(`<option selected>${dept1}</option>`);
                    $('#add_department2').html(`<option selected>${dept2}</option>`);
                    $('#add_department3').html(`<option selected>${dept3}</option>`);

                    $('#deanSubmitBtn').hide();
                    $('#deanUpdateBtn').show();
                    $('#deanCancelBtn').show();

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
        $('#add_last_name').val('');
        $('#add_first_name').val('');
        $('#add_username').val('');
        $('#add_password').val('');
        $('#add_department1').html('<option selected>Choose Department 1</option>');
        $('#add_department2').html('<option selected>Choose Department 2</option>');
        $('#add_department3').html('<option selected>Choose Department 3</option>');
        populateDepartments();
        $('#deanUpdateBtn').hide();
        $('#deanCancelBtn').hide();
        $('#deanSubmitBtn').show();
    }

    function updateDeanData(deanId) {
        const lastName = $('#add_last_name').val();
        const firstName = $('#add_first_name').val();
        const username = $('#add_username').val();
        const password = $('#add_password').val();
        const dept1 = $('#add_department1').val();
        const dept2 = $('#add_department2').val();
        const dept3 = $('#add_department3').val();
    
        if (!lastName || !firstName || !username || dept1 === 'Choose Department 1') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please fill in all the required fields!',
                showConfirmButton: false,
                timer: 2000,
                background: '#f8bbd0',
                iconColor: '#c62828',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }
    
        $.ajax({
            url: 'controller/departments/update-dean-info.php',
            method: 'POST',
            data: {
                dean_id: deanId,
                last_name: lastName,
                first_name: firstName,
                username: username,
                password: password,
                department1: dept1,
                department2: dept2,
                department3: dept3
            },
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function(response) {
                console.log("AJAX Success:", response);
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Dean information updated successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    resetForm();
                    loadDeans();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.message || 'An unexpected error occurred.',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            }
        });
    }

    // Implementing the search functionality
    $('#searchDepartments').on('input', function () {
        const searchQuery = $(this).val().toLowerCase();
        loadDeans(searchQuery); // Pass search query to loadDeans function
    });

    loadDeans(); 
    window.refreshDeanList = loadDeans;
});