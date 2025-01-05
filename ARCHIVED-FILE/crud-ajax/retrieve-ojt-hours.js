// function fetchUploadedHours() {
//     fetch('controller/hours/retrieve-ojt-hours.php')
//         .then(response => response.json())
//         .then(data => {
//             const container = document.getElementById('uploadedHoursContainer');
//             container.innerHTML = ''; // Clear previous content

//             if (data.error) {
//                 container.innerHTML = `<p class="text-danger">${data.error}</p>`;
//                 return;
//             }

//             if (data.success && data.hours.length > 0) {
//                 // Create the table wrapper for responsiveness
//                 const tableWrapper = document.createElement('div');
//                 tableWrapper.className = 'table-wrapper'; // Apply responsive wrapper class
                
//                 const table = document.createElement('table');
//                 table.className = 'table';

//                 // Add table header
//                 table.innerHTML = `
//                     <thead>
//                         <tr>
//                             <th>Submission Date</th>
//                             <th>Morning Start</th>
//                             <th>Lunch Start</th>
//                             <th>Lunch End</th>
//                             <th>Afternoon End</th>
//                             <th>Total Hours</th>
//                             <th>File</th>
//                         </tr>
//                     </thead>
//                     <tbody>
//                     </tbody>
//                 `;

//                 // Variable to store the total hours
//                 let totalHours = 0;

//                 // Populate table rows
//                 const tbody = table.querySelector('tbody');
//                 data.hours.forEach(hour => {
//                     const row = document.createElement('tr');
//                     row.innerHTML = `
//                         <td>${new Date(hour.submission_date).toLocaleString()}</td>
//                         <td>${hour.morning_start}</td>
//                         <td>${hour.lunch_start}</td>
//                         <td>${hour.lunch_end}</td>
//                         <td>${hour.afternoon_end}</td>
//                         <td>${hour.total_hours}</td>
//                         <td>
//                             ${hour.file_path ? `<a href="${hour.file_path}" target="_blank" class="btn btn-primary btn-sm">View File</a>` : 'No file uploaded'}
//                         </td>
//                     `;
//                     tbody.appendChild(row);

//                     // Calculate total hours (assuming it's in "hour(s) and minute(s)" format)
//                     const totalTime = hour.total_hours.match(/(\d+) hour\(s\) and (\d+) minute\(s\)/);
//                     if (totalTime) {
//                         const hours = parseInt(totalTime[1]);
//                         const minutes = parseInt(totalTime[2]);
//                         totalHours += (hours * 60 + minutes);  // Add total minutes
//                     }
//                 });

//                 // Create and append the total row
//                 const totalRow = document.createElement('tr');
//                 totalRow.innerHTML = `
//                     <td colspan="5" class="text-end"><strong>Total Hours:</strong></td>
//                     <td><strong>${Math.floor(totalHours / 60)} hour(s) and ${totalHours % 60} minute(s)</strong></td>
//                     <td></td>
//                 `;
//                 tbody.appendChild(totalRow);

//                 // Append the table to the wrapper
//                 tableWrapper.appendChild(table);

//                 // Append the wrapper to the container
//                 container.appendChild(tableWrapper);
//             } else {
//                 container.innerHTML = '<p>No hours submitted yet.</p>';
//             }
//         })
//         .catch(error => {
//             console.error('Error fetching uploaded hours:', error);
//             document.getElementById('uploadedHoursContainer').innerHTML = '<p class="text-danger">Failed to load uploaded hours.</p>';
//         });
// }

// // Fetch submitted hours when the page loads
// document.addEventListener('DOMContentLoaded', fetchUploadedHours);

function convertTo12HourFormat(time) {
    if (!time) return 'N/A'; // Return N/A if time is null or empty

    const [hour, minute] = time.split(':').map(Number);
    const period = hour >= 12 ? 'PM' : 'AM';
    let adjustedHour = hour % 12 || 12; // Convert hour to 12-hour format (0 becomes 12)

    // Return formatted time
    return minute === 0
        ? `${adjustedHour} ${period}` // No ":00" for whole hours
        : `${adjustedHour}:${minute.toString().padStart(2, '0')} ${period}`;
}

function formatTotalHours(totalHours) {
    const totalTimeMatch = totalHours.match(/(\d+) hour\(s\) and (\d+) minute\(s\)/);
    if (!totalTimeMatch) return totalHours; // Return as-is if the format doesn't match

    const hours = parseInt(totalTimeMatch[1]);
    const minutes = parseInt(totalTimeMatch[2]);

    if (hours === 0 && minutes === 0) {
        return 'N/A'; // Return N/A if both hours and minutes are zero
    }

    return minutes === 0
        ? `${hours} hours` // If no minutes, return only hours
        : `${hours} hours and ${minutes} minutes`; // Return both hours and minutes
}

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
                tableWrapper.className = 'table-responsive'; // Bootstrap responsive table wrapper

                const table = document.createElement('table');
                table.className = 'table'; // Basic Bootstrap table class (no striped or bordered)

                // Add table header with smaller text
                table.innerHTML = `
                    <thead>
                        <tr>
                            <th class="text-sm">Submission Date</th>
                            <th class="text-sm">Morning Start</th>
                            <th class="text-sm">Lunch Start</th>
                            <th class="text-sm">Lunch End</th>
                            <th class="text-sm">Afternoon End</th>
                            <th class="text-sm">Total Hours</th>
                            <th class="text-sm">File</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                `;

                // Variable to store the total rendered hours
                let totalRenderedMinutes = 0;

                // Populate table rows
                const tbody = table.querySelector('tbody');
                data.hours.forEach(hour => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${new Date(hour.submission_date).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                        }) || 'N/A'}</td>
                        <td>${convertTo12HourFormat(hour.morning_start)}</td>
                        <td>${convertTo12HourFormat(hour.lunch_start)}</td>
                        <td>${convertTo12HourFormat(hour.lunch_end)}</td>
                        <td>${convertTo12HourFormat(hour.afternoon_end)}</td>
                        <td>${formatTotalHours(hour.total_hours)}</td>
                        <td>
                            ${hour.file_path ? `<a href="${hour.file_path}" target="_blank" class="btn btn-sm btn-outline-primary">View File</a>` : '<span class="text-muted">No file uploaded</span>'}
                        </td>
                    `;
                    tbody.appendChild(row);

                    // Calculate total rendered minutes (assuming "hour(s) and minute(s)" format)
                    const totalTimeMatch = hour.total_hours.match(/(\d+) hour\(s\) and (\d+) minute\(s\)/);
                    if (totalTimeMatch) {
                        const hours = parseInt(totalTimeMatch[1]);
                        const minutes = parseInt(totalTimeMatch[2]);
                        totalRenderedMinutes += hours * 60 + minutes; // Add to total rendered minutes
                    }
                });

                // Calculate total rendered hours and minutes
                const totalRenderedHours = Math.floor(totalRenderedMinutes / 60);
                const remainingMinutes = totalRenderedMinutes % 60;

                // Create and append the total row
                const totalRow = document.createElement('tr');
                totalRow.className = 'fw-bold'; // Highlight total row
                totalRow.innerHTML = `
                    <td colspan="5" class="text-end">Rendered:</td>
                    <td>${totalRenderedHours} hours and ${remainingMinutes} minutes</td>
                    <td></td>
                `;
                tbody.appendChild(totalRow);

                // Append the table to the wrapper
                tableWrapper.appendChild(table);

                // Append the wrapper to the container
                container.appendChild(tableWrapper);
            } else {
                container.innerHTML = '<p class="text-muted">No hours submitted yet.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching uploaded hours:', error);
            document.getElementById('uploadedHoursContainer').innerHTML = '<p class="text-danger">Failed to load uploaded hours.</p>';
        });
}

// Fetch submitted hours when the page loads
document.addEventListener('DOMContentLoaded', fetchUploadedHours);