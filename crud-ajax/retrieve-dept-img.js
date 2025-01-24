// $(document).ready(function () {
//     function loadDepartments() {
//         $.ajax({
//             url: 'controller/retrieve-dept-img.php',
//             type: 'GET',
//             dataType: 'json',
//             success: function (response) {
//                 console.log(response); // Debug response
//                 if (response.success) {
//                     let cardsHtml = '';
//                     response.data.forEach(function (department) {
//                         // Create the card using the department image and name
//                         cardsHtml += `
//                             <div class="card">
//                                 <div class="card-inner">
//                                     <div class="card-front" style="background-image: url('${department.department_image}');">
//                                     </div>
//                                 </div>
//                             </div>
//                         `;
//                     });
//                     $('#department-cards').html(cardsHtml);
//                     console.log($('#department-cards'));

//                     // Now update the cards since they are dynamically added
//                     cards = document.querySelectorAll('.card');  // Reinitialize the cards after they are loaded
//                     updateCards();  // Call the updateCards function to display the initial card state
//                 } else {
//                     alert('Failed to load departments');
//                 }
//             },
//             error: function (xhr, status, error) {
//                 console.error("Error: " + error); // Log AJAX errors
//             }
//         });
//     }

//     loadDepartments();
// });


$(document).ready(function () {
    function loadDepartments() {
        $.ajax({
            url: 'controller/retrieve-dept-img.php',
            type: 'GET',
            dataType: 'json',
            // success: function (response) {
            //     console.log(response); // Debug response
            //     if (response.success) {
            //         let cardsHtml = '';
            //         response.data.forEach(function (department) {
            //             cardsHtml += `
            //                 <div class="card">
            //                     <div class="card-inner">
            //                         <div class="card-front" style="background-image: url('${department.department_image}');">
            //                         </div>
            //                     </div>
            //                 </div>
            //             `;
            //         });

            //         // Clear and update the card container
            //         const cardContainer = $('#department-cards');
            //         cardContainer.empty(); // Clear previous cards
            //         cardContainer.html(cardsHtml);

            //         // Reinitialize cards and carousel
            //         cards = document.querySelectorAll('.card');
            //         activeIndex = 1; // Reset active index
            //         updateCards(); // Call the updateCards function
            //     } else {
            //         alert('Failed to load departments');
            //     }
            // },

            // success: function (response) {
            //     console.log(response); // Debug response
            //     if (response.success) {
            //         let cardsHtml = '';
            //         response.data.forEach(function (department) {
            //             cardsHtml += `
            //                 <div class="card">
            //                     <div class="card-inner">
            //                         <div class="card-front" style="background-image: url('${department.department_image}');">
            //                         </div>
            //                     </div>
            //                 </div>
            //             `;
            //         });
            
            //         const cardContainer = $('#department-cards');
            //         cardContainer.empty(); // Clear previous cards
            //         cardContainer.html(cardsHtml); // Add new cards
            
            //         // Reinitialize the carousel
            //         loadCards(); // Call the loadCards() function to set up the carousel
            //         startCarousel(); // Restart auto-scroll
            //     } else {
            //         alert('Failed to load departments');
            //     }
            // },

            success: function (response) {
                console.log(response); // Debug response
                if (response.success && response.data.length > 0) {
                    let cardsHtml = '';
                    response.data.forEach(function (department) {
                        cardsHtml += `
                            <div class="card">
                                <div class="card-inner">
                                    <div class="card-front" style="background-image: url('${department.department_image}');">
                                    </div>
                                </div>
                            </div>
                        `;
                    });
            
                    const cardContainer = $('#department-cards');
                    cardContainer.empty(); // Clear previous cards
                    cardContainer.html(cardsHtml); // Add new cards
            
                    // Reinitialize the carousel
                    loadCards(); // Call the loadCards() function to set up the carousel
                    startCarousel(); // Restart auto-scroll
                } else {
                    // No data received, clear the container and stop the carousel
                    $('#department-cards').empty(); // Clear any existing cards
                    clearInterval(interval); // Stop the carousel auto-scroll
                    console.log('No departments retrieved. Carousel disabled.');
                }
            },
            
            
            error: function (xhr, status, error) {
                console.error("Error: " + error); // Log AJAX errors
            }
        });
    }

    loadDepartments();
});
