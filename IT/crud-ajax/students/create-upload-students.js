document.addEventListener('DOMContentLoaded', function () {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const uploadButton = document.getElementById('uploadButton');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.backgroundColor = '#e0ffe0';
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.backgroundColor = '';
        }, false);
    });

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    uploadButton.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    function handleFiles(files) {
        const file = files[0];
        if (file && file.name.endsWith('.csv')) {
            uploadButton.disabled = true;
            uploadButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Uploading...';

            uploadFile(file);
        } else {
            alert('Please upload a valid CSV file');
        }
    }

    function uploadFile(file) {
        var formData = new FormData();
        formData.append('file', file);
    
        $.ajax({
            url: 'controller/students/create-upload-students.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log('Raw Response:', response);
                try {
                    let res = typeof response === 'object' ? response : JSON.parse(response);
                    console.log('Parsed Response:', res);
                    if (res.error) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: res.error,
                            showConfirmButton: false,
                            timer: 2000,
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
                            title: 'Student lists uploaded successfully',
                            showConfirmButton: false,
                            timer: 2000,
                            background: '#b9f6ca',
                            iconColor: '#2e7d32',
                            color: '#155724',
                            customClass: { popup: 'mt-5' }
                        });
    
                        window.loadStudents();
                        var event = new CustomEvent('updateChart');
                        window.dispatchEvent(event);
                    }
                } catch (e) {
                    console.error('Error parsing response:', e.message);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Invalid response format: ' + e.message,
                        showConfirmButton: false,
                        timer: 2000,
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
                    timer: 2000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: { popup: 'mt-5' }
                });
            },
            complete: function() {
                uploadButton.disabled = false;
                uploadButton.innerHTML = '<i class="fa-solid fa-cloud-arrow-up"></i> Upload Files';
            }
        });
    }
});