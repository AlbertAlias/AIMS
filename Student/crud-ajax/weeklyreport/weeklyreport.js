// document.addEventListener('DOMContentLoaded', function() {
//     const weeklyReportForm = document.getElementById('weeklyReportForm');

//     weeklyReportForm.addEventListener('submit', async function(event) {
//         event.preventDefault();

//         const formData = new FormData(weeklyReportForm);

//         try {
//             const response = await fetch('controller/weeklyreport/weeklyreport.php', {
//                 method: 'POST',
//                 body: formData,
//             });

//             const result = await response.json();
//             if (result.success) {
//                 alert('Report submitted successfully!');
//                 weeklyReportForm.reset();
//             } else {
//                 alert('Failed to submit report: ' + result.error);
//             }
//         } catch (error) {
//             alert('An unexpected error occurred: ' + error.message);
//         }
//     });
// });


// document.addEventListener('DOMContentLoaded', function() {
//     const weeklyReportForm = document.getElementById('weeklyReportForm');

//     weeklyReportForm.addEventListener('submit', async function(event) {
//         event.preventDefault();

//         const formData = new FormData(weeklyReportForm);
        
//         console.log([...formData]); // Log the form data to console for debugging

//         try {
//             const response = await fetch('controller/weeklyreport/weeklyreport.php', {
//                 method: 'POST',
//                 body: formData,
//             });

//             const result = await response.json();
//             console.log(result); // Log server response
//             if (result.success) {
//                 alert('Report submitted successfully!');
//                 weeklyReportForm.reset();
//             } else {
//                 alert('Failed to submit report: ' + result.error);
//             }
//         } catch (error) {
//             console.log(error);
//             alert('Unexpected error occurred');
//         }
//     });
// });



// document.addEventListener('DOMContentLoaded', function () {
//     const fileInput = document.getElementById('file');
//     const filePreview = document.getElementById('filePreview');
//     const weeklyReportForm = document.getElementById('weeklyReportForm');

//     fileInput.addEventListener('change', function () {
//         const file = fileInput.files[0];
//         filePreview.innerHTML = ''; // Clear previous preview

//         if (file) {
//             const fileType = file.type;
//             const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
//             const validPDFType = 'application/pdf';
//             const fileURL = URL.createObjectURL(file);

//             if (validImageTypes.includes(fileType)) {
//                 // Display image with click functionality
//                 const imgPreview = document.createElement('img');
//                 imgPreview.src = fileURL;
//                 imgPreview.style.maxWidth = '100%';
//                 imgPreview.style.maxHeight = '300px';
//                 imgPreview.style.cursor = 'pointer';
//                 imgPreview.addEventListener('click', () => {
//                     window.open(fileURL, '_blank');
//                 });
//                 filePreview.appendChild(imgPreview);
//             } else if (fileType === validPDFType) {
//                 // Display PDF with click functionality
//                 const pdfLink = document.createElement('a');
//                 pdfLink.href = fileURL;
//                 pdfLink.target = '_blank';
//                 pdfLink.textContent = 'Click to open the PDF';
//                 pdfLink.style.display = 'block';
//                 pdfLink.style.marginTop = '10px';
//                 filePreview.appendChild(pdfLink);
//             } else {
//                 // Unsupported file type
//                 filePreview.textContent = 'Selected file type is not supported for preview.';
//             }
//         }
//     });

//     weeklyReportForm.addEventListener('submit', async function (event) {
//         event.preventDefault();

//         const formData = new FormData(weeklyReportForm);

//         try {
//             const response = await fetch('controller/weeklyreport/weeklyreport.php', {
//                 method: 'POST',
//                 body: formData,
//             });

//             const result = await response.json();
//             if (result.success) {
//                 alert('Report submitted successfully!');
//                 weeklyReportForm.reset();
//                 filePreview.innerHTML = ''; // Clear preview
//             } else {
//                 alert('Failed to submit report: ' + result.error);
//             }
//         } catch (error) {
//             alert('Unexpected error occurred: ' + error.message);
//         }
//     });
// });



document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('file');
    const filePreview = document.getElementById('filePreview');
    const weeklyReportForm = document.getElementById('weeklyReportForm');

    // File input change handler
    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        filePreview.innerHTML = ''; // Clear previous preview

        if (file) {
            const fileType = file.type;
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            const validPDFType = 'application/pdf';
            const fileURL = URL.createObjectURL(file);

            // Handle image preview
            if (validImageTypes.includes(fileType)) {
                const imgPreview = document.createElement('img');
                imgPreview.src = fileURL;
                imgPreview.style.maxWidth = '100%';
                imgPreview.style.maxHeight = '300px';
                imgPreview.style.cursor = 'pointer';
                imgPreview.alt = 'Preview of selected image';
                imgPreview.title = 'Click to view full size';
                imgPreview.addEventListener('click', () => {
                    openModal(fileURL, 'image');
                });
                filePreview.appendChild(imgPreview);
            }
            // Handle PDF preview
            else if (fileType === validPDFType) {
                const pdfLink = document.createElement('a');
                pdfLink.href = fileURL;
                pdfLink.target = '_blank';
                pdfLink.textContent = 'Click to view the PDF';
                pdfLink.style.display = 'block';
                pdfLink.style.marginTop = '10px';
                pdfLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    openModal(fileURL, 'pdf');
                });
                filePreview.appendChild(pdfLink);
            }
            // Unsupported file type
            else {
                filePreview.textContent = 'Selected file type is not supported for preview.';
            }
        }
    });

    // Form submission handler
    weeklyReportForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(weeklyReportForm);

        try {
            const response = await fetch('controller/weeklyreport/weeklyreport.php', {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();
            if (result.success) {
                alert('Report submitted successfully!');
                weeklyReportForm.reset();
                filePreview.innerHTML = ''; // Clear preview
            } else {
                alert('Failed to submit report: ' + result.error);
            }
        } catch (error) {
            alert('Unexpected error occurred: ' + error.message);
        }
    });

    // Modal for preview
    const openModal = (fileURL, fileType) => {
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.style.display = 'block';
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close">&times;</span>
                ${
                    fileType === 'image'
                        ? `<img src="${fileURL}" style="width: 100%; max-height: 90vh;">`
                        : `<iframe src="${fileURL}" style="width: 100%; height: 90vh;" frameborder="0"></iframe>`
                }
            </div>
        `;

        document.body.appendChild(modal);

        // Close modal logic
        modal.querySelector('.close').addEventListener('click', () => {
            modal.remove();
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) modal.remove();
        });
    };
});
