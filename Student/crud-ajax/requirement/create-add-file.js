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
        fileIcon.querySelector('i').style.color = '#c7312c'; // Set custom color (red) for the PDF icon
        
        // File Details with name overflow styling
        const fileDetails = document.createElement('div');
        fileDetails.style.flex = '1';
        fileDetails.innerHTML = ` 
            <p class="file-name mb-0" title="${file.name}" style="color: #6c757d;"><strong>${file.name}</strong></p> <!-- Light gray text color -->
            <p class="text-muted small mb-0">${(file.size / 1024).toFixed(2)} KB</p>
        `;
        
        // Add event listener to make file name clickable and open in full-screen view
        const fileNameElement = fileDetails.querySelector('.file-name');
        fileNameElement.addEventListener('click', function() {
            // Create an object URL for the uploaded file to open it
            const fileURL = URL.createObjectURL(file);

            // Create a full-screen view for the PDF directly
            const pdfFullScreen = document.createElement('object');
            pdfFullScreen.data = fileURL;
            pdfFullScreen.type = 'application/pdf';
            pdfFullScreen.style.position = 'fixed';
            pdfFullScreen.style.top = '0';
            pdfFullScreen.style.left = '0';
            pdfFullScreen.style.width = '100vw';  // Full width of the viewport
            pdfFullScreen.style.height = '100vh'; // Full height of the viewport
            pdfFullScreen.style.zIndex = '1050';  // Ensure it's on top
            pdfFullScreen.style.backgroundColor = 'rgba(0, 0, 0, 0.6)'; // Dark background effect

            // Append the PDF to the body to make it visible
            document.body.appendChild(pdfFullScreen);

            // Add event listener to close the PDF when clicking outside of it
            pdfFullScreen.addEventListener('click', function(event) {
                if (event.target === pdfFullScreen) { // Close only if clicked outside the PDF
                    pdfFullScreen.remove();
                }
            });
        });

        // Close Button (X mark)
        const closeButton = document.createElement('button');
        closeButton.className = 'btn btn-sm position-absolute top-5 end-0 p-3'; // Positioned at the top-right of the file card
        closeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        closeButton.style.fontSize = '1.3rem';
        closeButton.style.cursor = 'pointer';
        
        // Add event listener to remove the file card when the close button is clicked
        closeButton.addEventListener('click', function() {
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


// Handle "Turn in" button click to upload the file
document.querySelector('.btn.btn-success').addEventListener('click', function() {
    // Get the file from the file preview (instead of the file input)
    const fileCard = document.querySelector('#fileContainer .d-flex');
    if (!fileCard) {
        alert('No file uploaded! Please upload a file before submitting.');
        return;
    }

    const fileName = fileCard.querySelector('.file-name').textContent; // Get the file name from the preview
    const file = document.getElementById('fileInput').files[0]; // Get the file from the file input

    if (!file) {
        alert('No file selected! Please upload a file before submitting.');
        return;
    }

    const studentId = 1; // Replace this with the dynamic student ID as needed

    const formData = new FormData();
    formData.append('file', file);
    formData.append('student_id', studentId);
    formData.append('document_name', fileName);

    // Send the file to the server via AJAX
    fetch('controller/requirement/create-upload-file.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('File uploaded successfully!');
            
            // Remove the file card (reset the file preview)
            const fileContainer = document.getElementById('fileContainer');
            fileContainer.innerHTML = ''; // Remove all file cards
            
            // Reset the file input
            document.getElementById('fileInput').value = '';
            
            // Disable the "Turn in" button
            document.querySelector('.btn.btn-success').disabled = true;
        } else {
            alert('Error uploading file!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error uploading file!');
    });
});