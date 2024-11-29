document.addEventListener("DOMContentLoaded", () => {
    // Initialize Swiper
    const aboutCarousel = new Swiper('.about-carousel', {
        loop: true, // Infinite loop
        autoplay: {
            delay: 3000, // 3 seconds per slide
            disableOnInteraction: false,
        },
        slidesPerView: 1, // Show one slide at a time
        speed: 800, // Smooth transition speed
        pagination: {
            el: '.swiper-pagination', // Add pagination bullets
            clickable: true,
        },
    });

    // Select the carousel container
    const aboutCarouselElement = document.querySelector('.about-carousel');

    // Pause autoplay on hover
    aboutCarouselElement.addEventListener('mouseenter', () => {
        aboutCarousel.autoplay.stop(); // Stop autoplay
    });

    // Resume autoplay when hover ends
    aboutCarouselElement.addEventListener('mouseleave', () => {
        aboutCarousel.autoplay.start(); // Restart autoplay
    });
});
