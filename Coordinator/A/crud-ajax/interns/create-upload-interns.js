const cancelUploadBtn = document.getElementById('cancelUploadBtn');
let uploadRequest; // Store the upload request to abort if needed

// Function to get file size (mimicking the download file size function)
function getFileSize(callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('HEAD', 'controller/interns/download-intern-xlsx.php', true); // Adjust URL for upload file
    xhr.onreadystatechange = function () {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                const fileSize = xhr.getResponseHeader('Content-Length');
                callback(fileSize);
            } else {
                console.error('Error fetching file size');
                callback(null);
            }
        }
    };
    xhr.send();
}

function uploadFileWithProgress(file) {
    const formData = new FormData();
    formData.append('file', file);

    uploadRequest = new XMLHttpRequest();
    uploadRequest.open('POST', '../A/controller/interns/create-upload-interns.php', true);

    // Show the upload progress UI
    document.getElementById('uploadProgress').style.display = 'block';
    document.getElementById('uploadfileName').innerText = file.name; // Set the file name
    cancelUploadBtn.style.display = 'inline'; // Show the cancel button

    // Update progress bar during file upload
    uploadRequest.upload.onprogress = function(event) {
        if (event.lengthComputable) {
            const percentComplete = (event.loaded / event.total) * 100;
            document.getElementById('progressBar').style.width = percentComplete + '%';
            document.getElementById('progressBar').setAttribute('aria-valuenow', percentComplete);
            document.getElementById('progressPercent').innerText = Math.round(percentComplete) + '%';
        }
    };

    // Handle success or failure
    uploadRequest.onload = function() {
        if (uploadRequest.status === 200) {
            try {
                const response = JSON.parse(uploadRequest.responseText);
                if (response.success) {
                    // Handle success
                    document.getElementById('progressBar').classList.remove('progress-bar-striped', 'progress-bar-animated');
                    document.getElementById('progressBar').classList.add('bg-success');
                    document.getElementById('uploadCompleteIcon').style.display = 'inline'; // Show check icon
                } else {
                    alert('File upload failed: ' + response.message);
                }
            } catch (e) {
                console.error('Error parsing JSON response:', e);
                console.error('Server response:', uploadRequest.responseText); // Output server response for debugging
                alert('Unexpected server response. Please try again.');
            }
        } else {
            alert('Error uploading file');
        }
        cancelUploadBtn.style.display = 'none'; // Hide the cancel button after completion
    };

    // Handle error case
    uploadRequest.onerror = function() {
        alert('Error uploading file');
        cancelUploadBtn.style.display = 'none'; // Hide the cancel button on error
    };

    // Handle the cancel button click
    cancelUploadBtn.onclick = function() {
        uploadRequest.abort(); // Abort the upload
        document.getElementById('uploadProgress').style.display = 'none'; // Hide upload progress
        cancelUploadBtn.style.display = 'none'; // Hide the cancel button
        alert('Upload cancelled');
    };

    // Optionally, you can call getFileSize here if needed before sending the file
    getFileSize(function(size) {
        console.log('File size for upload: ', size); // Log the size if you need it for any logic
    });

    // Send the file
    uploadRequest.send(formData);
}