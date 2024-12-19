document.addEventListener('DOMContentLoaded', function () {
    // Get references to elements after the DOM has loaded
    const fileContainer = document.getElementById('fileContainer');
    const fileInput = document.getElementById('fileInput');
    const submitButton = document.getElementById('turnInButton');
    const pdfViewer = document.getElementById('pdfViewer');
    const modal = document.getElementById('pdfModal');
    const closeModal = document.getElementById('closeModal');

    // Add click event listener to fileContainer for file preview
    fileContainer.addEventListener('click', function (event) {
        const fileCard = event.target.closest('.d-flex'); // Get the clicked file card
        if (fileCard && !event.target.closest('.btn')) { // Ensure the click wasn't on the close button
            const fileName = fileCard.querySelector('.file-name').textContent.trim();
            // Set the PDF viewer source (correct the URL to point to the public folder)
            pdfViewer.src = `controller/requirement/uploads/${fileName}#toolbar=0`; // Updated path
            // Show the modal
            modal.style.display = 'flex';
        }
    });

    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
        pdfViewer.src = ''; // Clear the iframe source
    });

    // Close the modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            pdfViewer.src = ''; // Clear the iframe source
        }
    });

    // Handle file input change
    fileInput.addEventListener('change', function () {
        // Clear existing content in the fileContainer
        fileContainer.innerHTML = '';

        const file = this.files[0]; // Get the selected file

        // Check if the file is a PDF
        if (file && file.type !== 'application/pdf') {
            alert('Only PDF files are allowed!');
            this.value = ''; // Clear the file input
            return;
        }

        if (file) {
            // Create a new container for the file
            const fileCard = document.createElement('div');
            fileCard.className = 'd-flex align-items-center border p-1 rounded mb-2 position-relative';
            fileCard.style.cursor = 'pointer'; // Make it clickable
            fileCard.title = 'Click to view the file'; // Tooltip for user feedback

            // File Icon
            const fileIcon = document.createElement('div');
            fileIcon.innerHTML = '<i class="fa-solid fa-file-pdf icon mx-3"></i>';
            fileIcon.style.fontSize = '1.5rem';
            fileIcon.querySelector('i').style.color = '#d32923';

            // File Details with name overflow styling
            const fileDetails = document.createElement('div');
            fileDetails.style.flex = '1';
            fileDetails.innerHTML = `        
                <p class="file-name mb-0" title="${file.name}" style="color: #6c757d;"><strong>${file.name}</strong></p>
                <p class="text-muted small mb-0">${(file.size / 1024).toFixed(2)} KB</p>
            `;

            // Close Button
            const closeButton = document.createElement('button');
            closeButton.className = 'btn btn-sm position-absolute top-5 end-0 p-3';
            closeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            closeButton.style.fontSize = '1.3rem';
            closeButton.style.cursor = 'pointer';
            closeButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent triggering the view event
                fileCard.remove();
                fileInput.value = '';
                submitButton.disabled = true;
            });

            // Append icon, details, and close button to the file card
            fileCard.appendChild(fileIcon);
            fileCard.appendChild(fileDetails);
            fileCard.appendChild(closeButton);

            // Add click event to open the modal and preview the file
            fileCard.addEventListener('click', function () {
                const fileURL = URL.createObjectURL(file); // Create a blob URL for the file
                pdfViewer.src = `${fileURL}#toolbar=0`; // Update the viewer's source
                modal.style.display = 'flex'; // Show the modal
            });

            // Append the file card to the container
            fileContainer.appendChild(fileCard);

            // Enable the "Turn in" button after a file is uploaded
            submitButton.disabled = false;
        }
    });

    // Handle the "Turn in" button click
    submitButton.addEventListener('click', function () {
        const fileCard = document.querySelector('#fileContainer .d-flex');
        const studentIdInput = document.querySelector('.student-id'); // Hidden input with student ID
        const requirementIdInput = document.querySelector('.requirement-id'); // Hidden input with requirement ID
        const taskCardContainer = document.getElementById('taskCardContainer');
        const requirementTitleElement = document.querySelector('.card-title.mt-2.mb-3');
        const requirementId = requirementIdInput.value; // Fetch the requirement ID
        const studentId = studentIdInput.value; // Fetch the student ID

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

        const fileName = fileCard.querySelector('.file-name').textContent; // Get the file name
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

        const formData = new FormData();
        formData.append('file', file);
        formData.append('student_id', studentId); // Include student ID
        formData.append('requirement_id', requirementId); // Include requirement_id
        formData.append('document_name', fileName);

        fetch('controller/requirement/create-upload-file.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
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

                // Clear file input and preview
                fileContainer.innerHTML = ''; // Clear file preview
                fileInput.value = ''; // Reset file input
                submitButton.disabled = true; // Disable button

                // Reset the requirement title and show "Upload requirement" card again
                requirementTitleElement.textContent = 'Upload requirement';
                
                // Display the "Upload requirement" section again
                const uploadRequirementCard = document.querySelector('.card-title.mt-2.mb-3');
                uploadRequirementCard.style.display = 'block'; // Make the "Upload requirement" title visible

                // Disable the file input and button again
                fileInput.disabled = true;
                submitButton.disabled = true;

                // Hide the "fileContainer" until a requirement is selected again
                fileContainer.style.display = 'none';

                // Show uploaded tasks
                taskCardContainer.style.display = 'block'; // Show uploaded tasks
                
                if (typeof loadStudentFiles === 'function') {
                    loadStudentFiles(); // Refresh submitted files
                }

                // Call the function to refresh the requirements
                if (typeof loadCoordinatorRequirements === 'function') {
                    loadCoordinatorRequirements(); // Refresh requirements list
                }
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: `Error: ${data.message}`,
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
                background: '#f8d7da',
                iconColor: '#721c24',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
        });
    });
});