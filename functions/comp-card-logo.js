// document.addEventListener("DOMContentLoaded", () => {
//     const compSection = document.querySelector('.comp-section'); // Section to update background

//     const swiper = new Swiper('.company-carousel', {
//         slidesPerView: 5,
//         spaceBetween: 20,
//         loop: true,
//         centeredSlides: true, // Ensures the active slide is always centered
//         autoplay: {
//             delay: 500, // Initial delay before movement
//             disableOnInteraction: false,
//         },
//         on: {
//             slideChangeTransitionEnd: function () {
//                 // Pause autoplay when the slide is centered
//                 swiper.autoplay.stop();

//                 // Update the background
//                 updateBackground();

//                 // Keep the background for 3 seconds, then resume autoplay
//                 setTimeout(() => {
//                     swiper.autoplay.start(); // Resume autoplay
//                 }, 3000); // 3-second delay
//             },
//         },
//         breakpoints: {
//             320: {
//                 slidesPerView: 2,
//                 spaceBetween: 10,
//             },
//             480: {
//                 slidesPerView: 2,
//                 spaceBetween: 15,
//             },
//             768: {
//                 slidesPerView: 3,
//                 spaceBetween: 20,
//             },
//             1024: {
//                 slidesPerView: 5,
//                 spaceBetween: 20,
//             },
//         },
//     });

//     function updateBackground() {
//         // Get the currently active slide
//         const activeSlide = document.querySelector('.swiper-slide.swiper-slide-active');

//         // Get the data-bg attribute from the active slide
//         const newBg = activeSlide.getAttribute('data-bg');

//         // Update the comp-section's background if a new background is defined
//         if (newBg) {
//             compSection.style.backgroundImage = `url(${newBg})`;
//         }
//     }

//     // Initialize the background when the page loads
//     updateBackground();
// });

document.addEventListener("DOMContentLoaded", () => {
    const swiperWrapper = document.querySelector('.swiper-wrapper'); // Swiper wrapper element

    // Fetch company data via AJAX
    $.ajax({
        url: 'controller/retrieve-comp-img.php', // Backend script URL
        method: 'GET',
        dataType: 'json',
        success: function (companies) {
            // Clear existing slides
            swiperWrapper.innerHTML = '';

            // Populate slides dynamically
            companies.forEach(company => {
                const slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                slide.setAttribute('data-bg', company.background); // Set background image

                const img = document.createElement('img');
                img.src = company.logo; // Set logo image
                img.alt = 'Company Logo'; // Add alt attribute for accessibility

                slide.appendChild(img);
                swiperWrapper.appendChild(slide);
            });

            // Reinitialize Swiper after adding slides
            initializeSwiper();
        },
        error: function (err) {
            console.error('Error fetching company data:', err); // Log error
        }
    });

    // Initialize Swiper function
    function initializeSwiper() {
        const swiper = new Swiper('.company-carousel', {
            slidesPerView: 5,
            spaceBetween: 20,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 500,
                disableOnInteraction: false,
            },
            on: {
                slideChangeTransitionEnd: function () {
                    swiper.autoplay.stop();
                    updateBackground();
                    setTimeout(() => {
                        swiper.autoplay.start();
                    }, 3000);
                },
            },
            breakpoints: {
                320: { slidesPerView: 2, spaceBetween: 10 },
                480: { slidesPerView: 2, spaceBetween: 15 },
                768: { slidesPerView: 3, spaceBetween: 20 },
                1024: { slidesPerView: 5, spaceBetween: 20 },
            },
        });

        // Update the background image for the section dynamically
        function updateBackground() {
            const activeSlide = document.querySelector('.swiper-slide.swiper-slide-active');
            const newBg = activeSlide.getAttribute('data-bg');
            if (newBg) {
                document.querySelector('.comp-section').style.backgroundImage = `url(${newBg})`;
            }
        }

        // Initialize background on load
        updateBackground();
    }
});
