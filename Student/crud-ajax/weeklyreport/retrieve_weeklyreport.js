// document.addEventListener('DOMContentLoaded', function () {
//     async function fetchWeeklyReports() {
//       try {
//         const response = await fetch('controller/weeklyreport/retrieve_weeklyreport.php');
//         const result = await response.json();
  
//         if (result.success) {
//           renderReports(result.data);
//         } else {
//           alert('Failed to load reports: ' + result.error);
//         }
//       } catch (error) {
//         console.error('Unexpected error:', error);
//         alert('An unexpected error occurred');
//       }
//     }
  
//     function renderReports(data) {
//       const container = document.getElementById('weeklypostedRequirementsContainer');
//       container.innerHTML = ''; // Clear existing data
  
//       if (data.length === 0) {
//         container.innerHTML = '<div class="col-12">No weekly reports available.</div>';
//         return;
//       }
  
//       data.forEach(report => {
//         const reportCard = `
//           <div class="col-12 col-md-6 mb-3">
//             <div class="card shadow-sm">
//               <div class="card-body">
//                 <h5 class="card-title">Student ID: ${report.student_id}</h5>
//                 <p class="card-text">Week Start: ${report.week_start}</p>
//                 <p class="card-text">Week End: ${report.week_end}</p>
//                 ${report.file_path ? `<a href="${report.file_path}" class="btn btn-info btn-sm" target="_blank">View Report</a>` : ''}
//               </div>
//             </div>
//           </div>
//         `;
//         container.insertAdjacentHTML('beforeend', reportCard);
//       });
//     }
  
//     fetchWeeklyReports();
//   });
  
// eto yung nagana
document.addEventListener('DOMContentLoaded', function () {
    async function fetchWeeklyReports() {
      try {
        const response = await fetch('controller/weeklyreport/retrieve_weeklyreport.php');
        const result = await response.json();
  
        if (result.success) {
          renderReports(result.data);
        } else {
          alert('Failed to load reports: ' + result.error);
        }
      } catch (error) {
        console.error('Unexpected error:', error);
        alert('An unexpected error occurred');
      }
    }
  
    function renderReports(data) {
      const container = document.getElementById('weeklypostedRequirementsContainer');
      container.innerHTML = ''; // Clear existing data
  
      if (data.length === 0) {
        container.innerHTML = '<div class="col-12">No weekly reports available.</div>';
        return;
      }
  
      data.forEach(report => {
        const reportCard = `
          <div class="col-12 col-md-6 mb-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="card-title">${report.title}</h5>
                <p class="card-text">Week Start: ${report.week_start}</p>
                <p class="card-text">Week End: ${report.week_end}</p>
                ${report.file_path ? `<a href="${report.file_path}" class="btn btn-info btn-sm" target="_blank">View Report</a>` : ''}
              </div>
            </div>
          </div>
        `;
        container.insertAdjacentHTML('beforeend', reportCard);
      });
    }
  
    fetchWeeklyReports();
});


// document.addEventListener('DOMContentLoaded', function () {
//     async function fetchWeeklyReports() {
//         try {
//             const response = await fetch('controller/weeklyreport/retrieve_weeklyreport.php');
//             const result = await response.json();

//             if (result.success) {
//                 renderReports(result.data);
//             } else {
//                 alert('Failed to load reports: ' + result.error);
//             }
//         } catch (error) {
//             console.error('Unexpected error:', error);
//             alert('An unexpected error occurred');
//         }
//     }

//     function renderReports(data) {
//         const container = document.getElementById('weeklypostedRequirementsContainer');
//         container.innerHTML = ''; // Clear existing data

//         if (data.length === 0) {
//             container.innerHTML = '<div class="col-12">No weekly reports available.</div>';
//             return;
//         }

//         data.forEach(report => {
//             const reportCard = `
//                 <div class="col-12 col-md-6 mb-3">
//                     <div class="card shadow-sm">
//                         <div class="card-body">
//                             <h5 class="card-title">${report.title}</h5>
//                             <p class="card-text">Week Start: ${report.week_start}</p>
//                             <p class="card-text">Week End: ${report.week_end}</p>
//                             ${report.file_path ? `<a href="${report.file_path}" class="btn btn-info btn-sm view-report-link" target="_blank">View Report</a>` : ''}
//                         </div>
//                     </div>
//                 </div>
//             `;
//             container.insertAdjacentHTML('beforeend', reportCard);
//         });

//         // Add click event for report links to open in modal
//         container.querySelectorAll('.view-report-link').forEach(link => {
//             link.addEventListener('click', function (event) {
//                 event.preventDefault();
//                 const filePath = link.href; // Get the file path from the link
//                 const pdfViewer = document.getElementById('pdfViewer'); // Assuming you have an iframe with id="pdfViewer" in the modal
//                 pdfViewer.src = filePath; // Set the file path as the source of the iframe
//                 $('#pdfModal').modal('show'); // Show the modal
//             });
//         });
//     }

//     fetchWeeklyReports();
// });