document.getElementById('fileInput').addEventListener('change', function() {
    const fileContainer = document.getElementById('fileContainer');
    const file = this.files[0]; // Get the selected file
    const submitButton = document.querySelector('.btn.btn-success'); // "Turn in" button

    if (file) {
        // Check if the file is a PDF
        if (file.type !== 'application/pdf') {
            alert('Only PDF files are allowed!');
            this.value = ''; // Clear the file input
            return;
        }

        // Ensure only one file is added
        if (fileContainer.children.length > 0) {
            alert('You can only upload one file.');
            this.value = ''; // Clear the file input
            return;
        }

        // Create a new container for the file
        const fileCard = document.createElement('div');
        fileCard.className = 'd-flex align-items-center border p-1 rounded mb-2 position-relative';  // Added position-relative for positioning the close button
        
        // File Icon
        const fileIcon = document.createElement('div');
        fileIcon.innerHTML = '<i class="fa-solid fa-file-pdf icon mx-3"></i>';
        fileIcon.style.fontSize = '1.5rem';
        fileIcon.querySelector('i').style.color = '#d32923'; // Set custom color (red) for the PDF icon
        
        // File Details with name overflow styling
        const fileDetails = document.createElement('div');
        fileDetails.style.flex = '1';
        fileDetails.innerHTML = `        
            <p class="file-name mb-0" title="${file.name}" style="color: #6c757d;"><strong>${file.name}</strong></p> <!-- Light gray text color -->
            <p class="text-muted small mb-0">${(file.size / 1024).toFixed(2)} KB</p>
        `;
        
        // Close Button (X mark)
        const closeButton = document.createElement('button');
        closeButton.className = 'btn btn-sm position-absolute top-5 end-0 p-3'; // Positioned at the top-right of the file card
        closeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        closeButton.style.fontSize = '1.3rem';
        closeButton.style.cursor = 'pointer';
        
        // Add event listener to remove the file card when the close button is clicked
        closeButton.addEventListener('click', function(event) {
            event.stopPropagation();  // Prevent triggering the modal open behavior
            fileCard.remove(); // Remove the file card from the container
            document.getElementById('fileInput').value = ''; // Reset the file input field if the file is removed
            submitButton.disabled = true; // Disable the "Turn in" button if no file is selected
        });

        // Append icon, details, and close button to the file card
        fileCard.appendChild(fileIcon);
        fileCard.appendChild(fileDetails);
        fileCard.appendChild(closeButton);
        
        // Append the file card to the container
        fileContainer.insertBefore(fileCard, fileContainer.firstChild);

        // Enable the "Turn in" button after a file is uploaded
        submitButton.disabled = false;
    }
});

// Add event listener to preview file in a modal
document.getElementById('fileContainer').addEventListener('click', function (event) {
    const fileCard = event.target.closest('.d-flex'); // Get the clicked file card
    if (fileCard && !event.target.closest('.btn')) { // Ensure the click wasn't on the close button
        const fileName = fileCard.querySelector('.file-name').textContent.trim();
        // Set the PDF viewer source (correct the URL to point to the public folder)
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = `controller/requirement/uploads/${fileName}#toolbar=0`; // Updated path
        // Show the modal
        const modal = document.getElementById('pdfModal');
        modal.style.display = 'flex';
    }
});

// Close the modal when the close button is clicked
document.getElementById('closeModal').addEventListener('click', function () {
    const modal = document.getElementById('pdfModal');
    modal.style.display = 'none';
    // Clear the PDF viewer source
    document.getElementById('pdfViewer').src = '';
});

// Close the modal when clicking outside of the modal content
window.addEventListener('click', function (event) {
    const modal = document.getElementById('pdfModal');
    if (event.target === modal) {
        modal.style.display = 'none';
        // Clear the PDF viewer source
        document.getElementById('pdfViewer').src = '';
    }
});


document.querySelector('.btn.btn-success').addEventListener('click', function() {
    const fileCard = document.querySelector('#fileContainer .d-flex');
    const fileInput = document.getElementById('fileInput');
    const submitButton = document.querySelector('.btn.btn-success');
    const taskCardContainer = document.getElementById('taskCardContainer');

    if (!fileCard) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'No file uploaded! Please upload a file before submitting.',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
        return;
    }

    // Uploading the file as usual
    const fileName = fileCard.querySelector('.file-name').textContent; // Get the file name from the preview
    const file = fileInput.files[0]; // Get the file from the file input

    if (!file) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'No file selected! Please upload a file before submitting.',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
        return;
    }

    const studentId = 1;
    const requirementId = 1;

    const formData = new FormData();
    formData.append('file', file);
    formData.append('student_id', studentId);
    formData.append('requirement_id', requirementId);
    formData.append('document_name', fileName);

    fetch('controller/requirement/create-upload-file.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Ensure response is parsed as JSON
    .then(data => {
        if (data.success) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'success',
                title: 'File uploaded successfully!',
                showConfirmButton: false,
                timer: 3000,
                background: '#b9f6ca',
                iconColor: '#2e7d32',
                color: '#155724',
                customClass: {
                    popup: 'mt-5'
                }
            });
            // Reset file preview and form after upload
            const fileContainer = document.getElementById('fileContainer');
            fileContainer.innerHTML = ''; // Remove all file cards
            fileInput.value = ''; // Reset file input field
            submitButton.disabled = true; // Disable the "Turn in" button
    
            // Show the task card container below the "Turn in" button
            taskCardContainer.style.display = 'block'; // Make the task card container visible

            // Dynamically retrieve the uploaded file
            window.loadStudentFiles(); // Call the function to load the student's files
        } else {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Error uploading file: ' + data.message,
                showConfirmButton: false,
                timer: 3000,
                background: '#f8d7da',
                iconColor: '#721c24',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'There was an error with the AJAX request.',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8bbd0',
            iconColor: '#c62828',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
    });
});