document.addEventListener('DOMContentLoaded', function () {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const uploadButton = document.getElementById('uploadButton');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop area when item is dragged over
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.backgroundColor = '#e0ffe0'; // Change background on drag over
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.backgroundColor = ''; // Reset background on drag leave or drop
        }, false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    // Open file picker on button click
    uploadButton.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle file selection from input
    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    // Handle files for upload
    function handleFiles(files) {
        // Assuming only one file will be uploaded at a time
        const file = files[0];
        // Check if the file is a .csv file
        if (file && file.name.endsWith('.csv')) {
            // Display the file name and progress elements
            document.getElementById('uploadProgress').style.display = 'block';
            const fileNameElement = document.getElementById('uploadfileName');
            
            if (fileNameElement) {
                fileNameElement.innerText = file.name; // Updated line
            }

            // Call the upload function and show progress
            uploadFile(file); // Now this will correctly call the upload function
        } else {
            alert('Please upload a valid CSV file');
        }
    }

    // Upload file function
    function uploadFile(file) {
        var formData = new FormData();
        formData.append('file', file);

        // Send AJAX request to upload the file
        $.ajax({
            url: 'controller/interns/create-upload-interns.php', // PHP file that will process the CSV
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
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
                            customClass: { popup: 'mt-5' }
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
                            customClass: { popup: 'mt-5' }
                        });

                        window.fetchInterns(); // Reload intern list (assuming this is a function that reloads the data)
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
                        customClass: { popup: 'mt-5' }
                    });
                }
            },
            error: function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error uploading file',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: { popup: 'mt-5' }
                });
            }
        });
    }
});
