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
            const fileIndex = fileCard.getAttribute('data-file-index'); // Get file index from data attribute
            const file = fileInput.files[fileIndex]; // Get the file from the input based on the index
    
            if (file) {
                // Create a temporary Blob URL for the file
                const fileURL = URL.createObjectURL(file);
    
                // Set the PDF viewer's source
                pdfViewer.src = `${fileURL}#toolbar=0`;
    
                // Show the modal
                modal.style.display = 'flex';
            }
        }
    });

    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
        URL.revokeObjectURL(pdfViewer.src); // Free up memory
        pdfViewer.src = ''; // Clear the iframe source
    });

    // Close the modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            URL.revokeObjectURL(pdfViewer.src); // Free up memory
            pdfViewer.src = ''; // Clear the iframe source
        }
    });

    // Handle file input change
    fileInput.addEventListener('change', function () {
        // Disable the file input and button during file upload
        fileInput.disabled = true;
        fileInput.closest('label').style.pointerEvents = 'none'; // Disable the label (button)
    
        // Clear existing content in the fileContainer
        fileContainer.innerHTML = '';
    
        const files = this.files; // Get the selected files
    
        // Iterate over the selected files
        Array.from(files).forEach((file, index) => {
            // Check if the file is a PDF
            if (file.type !== 'application/pdf') {
                alert('Only PDF files are allowed!');
                this.value = ''; // Clear the file input
                fileInput.disabled = false; // Re-enable the file input
                fileInput.closest('label').style.pointerEvents = 'auto'; // Re-enable the label button
                return;
            }
    
            // Create a new container for the file
            const fileCard = document.createElement('div');
            fileCard.className = 'd-flex align-items-center border p-1 rounded mb-2 position-relative';
            fileCard.style.pointerEvents = 'none'; // Make it non-clickable during loading
            fileCard.setAttribute('data-file-index', index); // Store the file index for later reference
    
            // Set height and width for the container (compact version)
            fileCard.style.height = '60px';
            fileCard.style.width = '100%';
    
            // Create the loading indicator and append it to the file card
            const loadingElement = document.createElement('div');
            loadingElement.classList.add('loading-indicator');
            loadingElement.style.height = '3px'; // Thin loading bar
            loadingElement.style.backgroundColor = '#198754'; // Green color
    
            // Position and animation styles for the loading indicator
            loadingElement.style.position = 'absolute';
            loadingElement.style.bottom = '0'; // Place it at the bottom of the file card
            loadingElement.style.left = '0';
            loadingElement.style.width = '0'; // Initially, the bar will be 0 width
            loadingElement.style.transition = 'width 2s ease-out'; // Smooth transition for width change
    
            // Append the loading bar to the file card
            fileCard.appendChild(loadingElement);
    
            // Append the file card to the container (only the loading bar will be visible initially)
            fileContainer.appendChild(fileCard);
    
            // Create the file icon, details, and close button but keep them hidden initially
            const fileIcon = document.createElement('div');
            fileIcon.innerHTML = `        
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 2.3rem; height: 2.3rem; padding: 1px; margin-left: 3px; margin-right: 3px;">
                    <path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z" fill="#d32923"/>
                </svg>
            `;
    
            // File Details with name overflow styling
            const fileDetails = document.createElement('div');
            fileDetails.style.flex = '1';
            fileDetails.innerHTML = `        
                <p class="file-name mb-0" title="${file.name}" style="color: #6c757d;"><strong>${file.name}</strong></p>
                <p class="text-muted small mb-0">${(file.size / 1024).toFixed(2)} KB</p>
            `;
    
            // Close Button
            const closeButton = document.createElement('button');
            closeButton.className = 'btn btn-sm position-absolute end-0 p-3';
            closeButton.innerHTML = `        
                <svg class="file-delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 1.3rem; height: 1.3rem; margin-bottom: 3px;">
                    <path fill="#dc3545"d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" fill="#6c757d"/>
                </svg>
            `;
            closeButton.style.fontSize = '1.3rem';
            closeButton.style.cursor = 'pointer';
    
            // Close button click handler
            closeButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent triggering the view event
            
                // Disable the close button and make fileCard unclickable
                closeButton.disabled = true;
                fileCard.style.pointerEvents = 'none'; // Disable click events on the file container
            
                // Blur the button to prevent any focus outline
                closeButton.blur();
            
                // Delay before removing the file container
                setTimeout(() => {
                    fileCard.remove(); // Remove the file card after delay
                    fileInput.value = ''; // Clear the file input
                    submitButton.disabled = true; // Disable the submit button again
            
                    // Re-enable the file input and label after the file is removed
                    fileInput.disabled = false; // Enable the file input
                    fileInput.closest('label').style.pointerEvents = 'auto'; // Enable the label button
            
                    // Reset activeRequirement
                    activeRequirement = null; // Reset active requirement flag
                }, 2000); // Adjust the delay as needed (2 seconds here)
            });
    
            // Initially hide the file icon, details, and close button
            fileIcon.style.display = 'none';
            fileDetails.style.display = 'none';
            closeButton.style.display = 'none';
    
            // Append the icon, details, and close button to the file card
            fileCard.appendChild(fileIcon);
            fileCard.appendChild(fileDetails);
            fileCard.appendChild(closeButton);
    
            // Simulate a file upload by gradually expanding the loading bar
            setTimeout(() => {
                loadingElement.style.width = '100%'; // Make it move from left to right
            }, 10);
    
            // After the loading is complete, show the file icon, details, and close button
            setTimeout(() => {
                fileIcon.style.display = 'block'; // Show the file icon
                fileDetails.style.display = 'block'; // Show file details
                closeButton.style.display = 'block'; // Show close button
                loadingElement.remove(); // Remove the loading element after completion
                fileCard.style.pointerEvents = 'auto'; // Enable clicking again after loading
                fileCard.style.cursor = 'pointer'; // Make it appear clickable (hand cursor)
                submitButton.disabled = false;
            }, 2500); // Time to match the animation duration (2s + buffer)
    
            // Enable the "Turn in" button after a file is uploaded
        });
    });
    

    // Handle the "Turn in" button click
    submitButton.addEventListener('click', function () {
        const fileCard = document.querySelector('#fileContainer .d-flex');
        const studentIdInput = document.querySelector('.student-id'); // Hidden input with student ID
        const requirementIdInput = document.querySelector('.requirement-id'); // Hidden input with requirement ID
        const taskCardContainer = document.getElementById('taskCardContainer');
        const requirementTitleElement = document.querySelector('.card-title');
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
                const uploadRequirementCard = document.querySelector('.card-title');
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