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


document.addEventListener('DOMContentLoaded', function() {
    const weeklyReportForm = document.getElementById('weeklyReportForm');

    weeklyReportForm.addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(weeklyReportForm);
        
        console.log([...formData]); // Log the form data to console for debugging

        try {
            const response = await fetch('controller/weeklyreport/weeklyreport.php', {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();
            console.log(result); // Log server response
            if (result.success) {
                alert('Report submitted successfully!');
                weeklyReportForm.reset();
            } else {
                alert('Failed to submit report: ' + result.error);
            }
        } catch (error) {
            console.log(error);
            alert('Unexpected error occurred');
        }
    });
});
