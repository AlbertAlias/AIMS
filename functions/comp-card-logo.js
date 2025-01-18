document.addEventListener("DOMContentLoaded", () => {
    const swiperWrapper = document.querySelector('.swiper-wrapper');

    $.ajax({
        url: 'controller/retrieve-comp-img.php',
        method: 'GET',
        dataType: 'json',
        success: function (companies) {
            swiperWrapper.innerHTML = '';

            companies.forEach(company => {
                const slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                slide.setAttribute('data-bg', company.background);

                const img = document.createElement('img');
                img.src = company.logo;
                img.alt = 'Company Logo';

                slide.appendChild(img);
                swiperWrapper.appendChild(slide);
            });

            initializeSwiper();
        },
        error: function (err) {
            console.error('Error fetching company data:', err);
        }
    });

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
