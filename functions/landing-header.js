document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.querySelector(".navbar");
    const sections = document.querySelectorAll("section");

    const handleScroll = () => {
        const scrollY = window.scrollY;

        // Loop through sections to find the current one
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute("id");

            if (scrollY >= sectionTop - 70 && scrollY < sectionTop + sectionHeight - 70) {
                if (sectionId === "home") {
                    navbar.classList.add("navbar-transparent");
                    navbar.classList.remove("navbar-white");
                } else {
                    navbar.classList.add("navbar-white");
                    navbar.classList.remove("navbar-transparent");
                }
            }
        });
    };

    // Initial check and on scroll
    handleScroll();
    window.addEventListener("scroll", handleScroll);
});
