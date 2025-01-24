document.addEventListener("DOMContentLoaded", () => {
    const swiperWrapper = document.querySelector('.swiper-wrapper');
    const compSection = document.querySelector('.comp-section');

    $.ajax({
        url: 'controller/retrieve-comp-img.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.success && Array.isArray(response.data) && response.data.length > 0) {
                swiperWrapper.innerHTML = ''; // Reset the swiperWrapper content

                let hasValidData = false;

                response.data.forEach(company => {
                    const slide = document.createElement('div');
                    slide.classList.add('swiper-slide');
                    slide.setAttribute('data-bg', company.company_image);

                    // Create image element for company logo
                    const img = document.createElement('img');
                    img.src = company.company_logo;
                    img.alt = 'Company Logo';
                    img.classList.add('company-logo'); // Adding a class for custom styling

                    slide.appendChild(img);
                    swiperWrapper.appendChild(slide);

                    // If we have a valid logo (not a default placeholder), set flag
                    if (company.company_logo !== '/AIMS/assets/uploads/comp-img/asiatech-logo.png') {
                        hasValidData = true;
                    }
                });

                if (hasValidData) {
                    // Initialize Swiper only if we have actual data (not just placeholders)
                    initializeSwiper();
                } else {
                    // If only placeholders are present, keep the section static
                    compSection.style.backgroundImage = `url(${response.data[0].company_image})`; // Set the background image
                }
            } else {
                console.error("No valid data found.");
            }
        },
        error: function (err) {
            console.error('Error fetching company data:', err);
        }
    });

    function initializeSwiper() {
        const swiper = new Swiper('.company-carousel', {
            slidesPerView: 1, // Show one slide at a time
            spaceBetween: 0,  // No space between slides
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 5000,
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
                320: { slidesPerView: 1 },
                480: { slidesPerView: 1 },
                768: { slidesPerView: 1 },
                1024: { slidesPerView: 1 },
            },
        });

        function updateBackground() {
            const activeSlide = document.querySelector('.swiper-slide.swiper-slide-active');
            const newBg = activeSlide.getAttribute('data-bg');
            if (newBg) {
                document.querySelector('.comp-section').style.backgroundImage = `url(${newBg})`;
            }
        }

        updateBackground();
    }
});