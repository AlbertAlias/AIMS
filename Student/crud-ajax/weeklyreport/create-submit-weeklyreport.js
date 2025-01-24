document.addEventListener('DOMContentLoaded', function () {
    const fileContainer = document.getElementById('reportContainer');
    const fileInput = document.getElementById('reportInput');
    const submitButton = document.getElementById('turnInReportButton');
    const reportViewer = document.getElementById('reportViewer');
    const reportModal = document.getElementById('reportModal');
    const closeModal = document.getElementById('report-closeModal');
    const weeklyReportForm = document.getElementById('weeklyReportForm');

    fileContainer.addEventListener('click', function (event) {
        const fileCard = event.target.closest('.d-flex');
        if (fileCard && !event.target.closest('.btn')) {
            const fileIndex = fileCard.getAttribute('data-file-index');
            const file = fileInput.files[fileIndex];
            if (file) {
                const fileURL = URL.createObjectURL(file);

                if (file.type === 'application/pdf') {
                    reportViewer.src = `${fileURL}#toolbar=0`;
                    reportViewer.style.display = 'block';
                    imageViewer.style.display = 'none';
                } 
                else if (['image/jpeg', 'image/png'].includes(file.type)) {
                    imageViewer.src = fileURL;
                    imageViewer.style.display = 'block';
                    reportViewer.style.display = 'none';
                }

                reportModal.style.display = 'flex';
            }
        }
    });

    closeModal.addEventListener('click', function () {
        reportModal.style.display = 'none';
        URL.revokeObjectURL(reportViewer.src);
        URL.revokeObjectURL(imageViewer.src);
        reportViewer.src = '';
        imageViewer.src = '';
    });

    window.addEventListener('click', function (event) {
        if (event.target === reportModal) {
            reportModal.style.display = 'none';
            URL.revokeObjectURL(reportViewer.src);
            URL.revokeObjectURL(imageViewer.src);
            reportViewer.src = '';
            imageViewer.src = '';
        }
    });

    fileInput.addEventListener('change', function () {
        fileInput.disabled = true;
        fileInput.closest('label').style.pointerEvents = 'none';
        fileContainer.innerHTML = '';

        const files = this.files;
        Array.from(files).forEach((file, index) => {
            if (file.type !== 'application/pdf' && !['image/jpeg', 'image/png'].includes(file.type)) {
                alert('Only PDF, JPG, and PNG files are allowed!');
                this.value = '';
                fileInput.disabled = false;
                fileInput.closest('label').style.pointerEvents = 'auto';
                return;
            }

            const fileCard = document.createElement('div');
            fileCard.className = 'd-flex align-items-center border p-1 rounded mb-2 position-relative';
            fileCard.setAttribute('data-file-index', index);

            const loadingElement = document.createElement('div');
            loadingElement.classList.add('loading-indicator');
            loadingElement.style.height = '3px';
            loadingElement.style.backgroundColor = '#198754';
            loadingElement.style.position = 'absolute';
            loadingElement.style.bottom = '0';
            loadingElement.style.left = '0';
            loadingElement.style.width = '0';
            loadingElement.style.transition = 'width 2s ease-out';
            fileCard.appendChild(loadingElement);
            fileContainer.appendChild(fileCard);

            const fileIcon = document.createElement('div');
            if (file.type === 'application/pdf') {
                fileIcon.innerHTML = `        
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 2.3rem; height: 2.3rem; padding: 1px; margin-left: 3px; margin-right: 3px;">
                        <path fill="#d32923" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/>
                    </svg>
                `;
            } else if (['image/jpeg', 'image/png'].includes(file.type)) {
                fileIcon.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 2.3rem; height: 2.3rem; padding: 1px; margin-left: 3px; margin-right: 3px;">
                        <path fill="#d32923" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM64 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm152 32c5.3 0 10.2 2.6 13.2 6.9l88 128c3.4 4.9 3.7 11.3 1 16.5s-8.2 8.6-14.2 8.6l-88 0-40 0-48 0-48 0c-5.8 0-11.1-3.1-13.9-8.1s-2.8-11.2 .2-16.1l48-80c2.9-4.8 8.1-7.8 13.7-7.8s10.8 2.9 13.7 7.8l12.8 21.4 48.3-70.2c3-4.3 7.9-6.9 13.2-6.9z"/>
                    </svg>
                `;
            }

            const fileDetails = document.createElement('div');
            fileDetails.innerHTML = ` 
                <p class="file-name mb-0" title="${file.name}"><strong>${file.name}</strong></p>
                <p class="file-size text-muted small mb-0">${(file.size / 1024).toFixed(2)} KB</p>
            `;

            const closeButton = document.createElement('button');
            closeButton.className = 'btn btn-sm position-absolute end-0 p-3';
            closeButton.innerHTML = `        
                <svg class="file-delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 1.3rem; height: 1.3rem; margin-bottom: 3px;">
                    <path fill="#dc3545" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" fill="#6c757d"/>
                </svg>
            `;
            closeButton.style.fontSize = '1.3rem';
            closeButton.style.cursor = 'pointer';
            closeButton.addEventListener('click', function (event) {
                event.stopPropagation();
                closeButton.disabled = true;
                fileCard.style.pointerEvents = 'none';
                closeButton.blur();

                setTimeout(() => {
                    fileCard.remove();
                    fileInput.value = '';
                    submitButton.disabled = false;

                    fileInput.disabled = false;
                    fileInput.closest('label').style.pointerEvents = 'auto';
                }, 2000);
            });

            fileCard.appendChild(fileIcon);
            fileCard.appendChild(fileDetails);
            fileCard.appendChild(closeButton);

            setTimeout(() => {
                loadingElement.style.width = '100%';
            }, 100);

            setTimeout(() => {
                fileIcon.style.display = 'block';
                fileDetails.style.display = 'block';
                closeButton.style.display = 'block';
                loadingElement.remove();
                fileCard.style.pointerEvents = 'auto';
                submitButton.disabled = false;
            }, 2500);
        });

        setTimeout(function () {
            Array.from(fileContainer.children).forEach(function (fileCard) {
                const loadingElement = fileCard.querySelector('.loading-indicator');
                if (loadingElement) {
                    loadingElement.style.width = '100%';
                }
            });
        }, 1000);
    });

    submitButton.addEventListener('click', function (event) {
        event.preventDefault();
        const formData = new FormData(weeklyReportForm);
        const fileCard = document.querySelector('#reportContainer .d-flex');
        const studentIdInput = document.querySelector('.student-id');
        const studentId = studentIdInput.value;
        const title = document.getElementById('title').value.trim();
        const weekStart = document.getElementById('week_start').value.trim();
        const weekEnd = document.getElementById('week_end').value.trim();

        if (!title || !weekStart || !weekEnd) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'success',
                title: 'Please fill in all required fields!',
                showConfirmButton: false,
                timer: 2000,
                background: '#f8d7da',
                iconColor: '#721c24',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }

        const file = fileInput.files[0];
        formData.append('file', file);
        formData.append('student_id', studentId);

        fetch('controller/weeklyreport/create-upload-weeklyreport.php', {
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
                    title: 'Report submitted successfully!',
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#b9f6ca',
                    iconColor: '#2e7d32',
                    color: '#155724',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
                document.getElementById('title').value = '';
                document.getElementById('week_start').value = '';
                document.getElementById('week_end').value = '';
                fileContainer.innerHTML = '';
                fileInput.value = '';
                submitButton.disabled = true;
                fileInput.disabled = false;
                fileInput.closest('label').style.pointerEvents = 'auto';
                window.fetchWeeklyReports();
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: `Error: ${data.message}`,
                    showConfirmButton: false,
                    timer: 2000,
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
                timer: 2000,
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