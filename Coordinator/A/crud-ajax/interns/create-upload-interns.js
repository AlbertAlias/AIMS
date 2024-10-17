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
            // Handle success response
            let res;
            try {
                res = JSON.parse(response); // Parse the response
                if (res.error) {
                    alert(res.error);
                } else {
                    alert(res.success);
                    // Optionally reset the upload progress
                    $('#uploadProgress').hide();
                    $('#progressBar').css('width', '0%');
                    $('#uploadfileName').text('');
                }
            } catch (e) {
                alert('Error parsing response: ' + e.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error: ' + textStatus);
        }
    });
}