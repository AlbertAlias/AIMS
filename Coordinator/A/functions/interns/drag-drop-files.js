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
        // Check if the file is an .xlsx file
        if (file && (file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || 
             file.type === 'application/vnd.ms-excel' || 
             file.name.endsWith('.csv'))) {
            // Display the file name and progress elements
            document.getElementById('uploadProgress').style.display = 'block';
            const fileNameElement = document.getElementById('uploadfileName'); // Correct ID
            
            if (fileNameElement) {
                fileNameElement.innerText = file.name; // Updated line
            }
    
            // Call the upload function and show progress
            uploadFile(file); // Change this line to uploadFile
        } else {
            alert('Please upload a valid Excel (.xlsx, .xls) or CSV file');
        }
    }
});