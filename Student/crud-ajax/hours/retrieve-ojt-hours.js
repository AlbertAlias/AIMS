function fetchUploadedHours() {
    fetch('controller/hours/retrieve-ojt-hours.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('uploadedHoursContainer');
            container.innerHTML = ''; // Clear previous content

            if (data.error) {
                container.innerHTML = `<p class="text-danger">${data.error}</p>`;
                return;
            }

            if (data.success && data.hours.length > 0) {
                // Create the table wrapper for responsiveness
                const tableWrapper = document.createElement('div');
                tableWrapper.className = 'table-wrapper'; // Apply responsive wrapper class
                
                const table = document.createElement('table');
                table.className = 'table';

                // Add table header
                table.innerHTML = `
                    <thead>
                        <tr>
                            <th>Submission Date</th>
                            <th>Morning Start</th>
                            <th>Lunch Start</th>
                            <th>Lunch End</th>
                            <th>Afternoon End</th>
                            <th>Total Hours</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                `;

                // Variable to store the total hours
                let totalHours = 0;

                // Populate table rows
                const tbody = table.querySelector('tbody');
                data.hours.forEach(hour => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${new Date(hour.submission_date).toLocaleString()}</td>
                        <td>${hour.morning_start}</td>
                        <td>${hour.lunch_start}</td>
                        <td>${hour.lunch_end}</td>
                        <td>${hour.afternoon_end}</td>
                        <td>${hour.total_hours}</td>
                        <td>
                            ${hour.file_path ? `<a href="${hour.file_path}" target="_blank" class="btn btn-primary btn-sm">View File</a>` : 'No file uploaded'}
                        </td>
                    `;
                    tbody.appendChild(row);

                    // Calculate total hours (assuming it's in "hour(s) and minute(s)" format)
                    const totalTime = hour.total_hours.match(/(\d+) hour\(s\) and (\d+) minute\(s\)/);
                    if (totalTime) {
                        const hours = parseInt(totalTime[1]);
                        const minutes = parseInt(totalTime[2]);
                        totalHours += (hours * 60 + minutes);  // Add total minutes
                    }
                });

                // Create and append the total row
                const totalRow = document.createElement('tr');
                totalRow.innerHTML = `
                    <td colspan="5" class="text-end"><strong>Total Hours:</strong></td>
                    <td><strong>${Math.floor(totalHours / 60)} hour(s) and ${totalHours % 60} minute(s)</strong></td>
                    <td></td>
                `;
                tbody.appendChild(totalRow);

                // Append the table to the wrapper
                tableWrapper.appendChild(table);

                // Append the wrapper to the container
                container.appendChild(tableWrapper);
            } else {
                container.innerHTML = '<p>No hours submitted yet.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching uploaded hours:', error);
            document.getElementById('uploadedHoursContainer').innerHTML = '<p class="text-danger">Failed to load uploaded hours.</p>';
        });
}

// Fetch submitted hours when the page loads
document.addEventListener('DOMContentLoaded', fetchUploadedHours);
