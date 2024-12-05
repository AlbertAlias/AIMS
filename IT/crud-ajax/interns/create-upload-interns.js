function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);

    $.ajax({
        url: 'controller/interns/create-upload-interns.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#uploadProgress').show(); // Show progress before sending
            $('#progressBar').css('width', '0%'); // Reset progress bar
        },
        xhr: function () {
            const xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (evt) {
                if (evt.lengthComputable) {
                    const percentComplete = (evt.loaded / evt.total) * 100;
                    $('#progressBar').css('width', percentComplete + '%');
                    $('#progressPercent').text(Math.round(percentComplete) + '%');
                }
            }, false);
            return xhr;
        },
        success: function (response) {
            let res;
            try {
                res = JSON.parse(response); // Parse the response
                if (res.error) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: res.error,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Intern lists uploaded successfully',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    // Optionally reset the upload progress
                    $('#uploadProgress').hide();
                    $('#progressBar').css('width', '0%');
                    $('#uploadfileName').text('');
                    window.fetchInterns();
                }
            } catch (e) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error parsing response: ' + e.message,
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
        error: function (jqXHR, textStatus, errorThrown) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Error: ' + textStatus,
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