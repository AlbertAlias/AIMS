document.addEventListener('DOMContentLoaded', function () {
    const exportButton = document.getElementById('exportCSVBtn');
    const downloadProgress = document.getElementById('downloadProgress');
    const downloadProgressBar = document.getElementById('downloadProgressBar');
    const downloadProgressPercent = document.getElementById('downloadProgressPercent');
    const downloadCompleteIcon = document.getElementById('downloadCompleteIcon'); // Reference to the check icon
    let fileSize = 0; // File size will be fetched from the server
    const downloadSpeed = 3000; // Base speed for KB/s (250ms to complete 1KB)

    // Function to get file size from the server
    function getFileSize(callback) {
        const xhr = new XMLHttpRequest();
        xhr.open('HEAD', 'controller/interns/download-intern-xlsx.php', true); // Head request to get metadata
        xhr.onreadystatechange = function () {
            if (xhr.readyState === xhr.DONE) {
                if (xhr.status === 200) {
                    const fileSize = xhr.getResponseHeader('Content-Length');
                    callback(fileSize);
                } else {
                    console.error('Error fetching file size');
                    callback(null);
                }
            }
        };
        xhr.send();
    }

    // Add click event listener to the export button
    exportButton.addEventListener('click', function () {
        console.log('Export button clicked'); // Log to check if click event is triggered

        // Hide the Export button
        exportButton.style.display = 'none';

        // Show the Download Progress div
        downloadProgress.style.display = 'block';
        downloadProgress.style.backgroundColor = '#679cff83'; // Set background color

        // Get the file size before starting the download progress
        getFileSize(function (size) {
            if (!size) {
                alert('Error retrieving file size');
                return;
            }

            fileSize = parseInt(size, 10); // Convert to integer
            console.log('File size:', fileSize);

            // Determine download speed based on file size
            let downloadIntervalSpeed = 0;

            if (fileSize < 1024) { // File size < 1MB
                downloadIntervalSpeed = 500; // Fast for KB
            } else if (fileSize < 1048576) { // File size < 1GB
                downloadIntervalSpeed = 1000; // Average for MB
            } else { // File size >= 1GB
                downloadIntervalSpeed = 2000; // Slow for GB
            }

            // Simulate download progress based on file size
            let downloaded = 0;
            const downloadInterval = setInterval(function () {
                downloaded += downloadSpeed; // Simulate downloading 250 KB
                let downloadProgressValue = Math.min((downloaded / fileSize) * 100, 100);
                let progressPercent = Math.floor(downloadProgressValue); // Round down to nearest whole number
                downloadProgressBar.style.width = progressPercent + '%';
                downloadProgressBar.setAttribute('aria-valuenow', progressPercent);
                downloadProgressPercent.innerText = progressPercent + '%';

                // If download reaches 100%, complete the progress
                if (downloadProgressValue >= 100) {
                    clearInterval(downloadInterval);

                    // Show the check icon
                    downloadCompleteIcon.style.display = 'inline'; // Show the check icon

                    // **Now trigger the file download after progress reaches 100%**
                    setTimeout(function () {
                        window.location.href = 'controller/interns/download-intern-xlsx.php'; // Adjust the path to the PHP file as necessary

                        // Reset the download progress after the file has been downloaded
                        downloadProgressBar.style.width = '0%'; // Reset the progress bar
                        downloadProgressBar.setAttribute('aria-valuenow', '0'); // Set ARIA value to 0
                        downloadProgressPercent.innerText = '0%'; // Reset the percent text
                        downloadProgress.style.display = 'none'; // Hide the download progress
                        downloadCompleteIcon.style.display = 'none'; // Hide the check icon

                        // Show the Export button again
                        exportButton.style.display = 'inline';
                    }, 2000); // Keep the check icon visible for 2 seconds
                }
            }, downloadIntervalSpeed); // Use the adjusted interval speed
        });
    });
});