function uploadFileWithProgress(file) {
    const formData = new FormData();
    formData.append('file', file);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'controller/interns/create-upload-interns.php', true);

    // Update progress bar during file upload
    xhr.upload.onprogress = function(event) {
        if (event.lengthComputable) {
            const percentComplete = (event.loaded / event.total) * 100;
            document.getElementById('progressBar').style.width = percentComplete + '%';
            document.getElementById('progressBar').setAttribute('aria-valuenow', percentComplete);
            document.getElementById('progressPercent').innerText = Math.round(percentComplete) + '%';
        }
    };

    // Handle success or failure
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Update UI to show successful upload
                document.getElementById('progressBar').classList.remove('progress-bar-striped', 'progress-bar-animated');
                document.getElementById('progressBar').classList.add('bg-success');
                document.getElementById('progressPercent').innerHTML = '100% <i class="fa-solid fa-check" style="color: green;"></i>';
            } else {
                alert('File upload failed: ' + response.message);
            }
        } else {
            alert('Error uploading file');
        }
    };

    // Handle error case
    xhr.onerror = function() {
        alert('Error uploading file');
    };

    // Send the file
    xhr.send(formData);
}