document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.querySelector('#uploadArea');
    const fileInput = document.querySelector('#fileInput');

    if (uploadArea && fileInput) {
        // Click event to open file dialog
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                console.log('File selected:', file.name);
                handleFile(file);
            }
        });

        // Handle drag over
        uploadArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadArea.classList.add('drag-over');
        });

        // Handle drag leave
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('drag-over');
        });

        // Handle drop
        uploadArea.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadArea.classList.remove('drag-over');

            const file = event.dataTransfer.files[0];
            if (file) {
                console.log('File dropped:', file.name);
                handleFile(file);
            }
        });
    } else {
        console.error('Required elements are missing in the DOM.');
    }

    function handleFile(file) {
        // Separate the AJAX upload function
        uploadFile(file);
    }
});
