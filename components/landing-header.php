<nav class="navbar navbar-expand-lg navbar-light fixed-top topbar m-0 p-0 px-2 shadow-sm" aria-label="Main Navigation">
    <div class="container-fluid">
        <!-- Left: Logo -->
        <a class="navbar-brand d-flex align-items-center" href="#" aria-label="Home">
            <img src="assets/img/esyatek-logo.png" alt="Esyatek Logo" width="60" loading="lazy">
        </a>
        
        <!-- Center: Navigation links -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24">
                <path fill="#198754" d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/>
            </svg>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="#home" class="nav-link fs-6 fw-semibold text-dark text-decoration-none">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#department" class="nav-link fs-6 fw-semibold text-dark text-decoration-none">Department</a>
                </li>
                <li class="nav-item">
                    <a href="#company" class="nav-link fs-6 fw-semibold text-dark text-decoration-none">Company</a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="nav-link fs-6 fw-semibold text-dark text-decoration-none">About</a>
                </li>
                <li class="nav-item">
                    <a href="#team" class="nav-link fs-6 fw-semibold text-dark text-decoration-none">Team</a>
                </li>
                <!-- Right: Sign in button inside hamburger -->
                <li class="nav-item">
                    <a href="Login/login.php" class="btn btn-sm btn-success fs-6 fw-semibold text-light me-2 border-1 border-light d-block d-lg-none mt-2 mb-2">Sign in</a>
                </li>
            </ul>
        </div>

        <!-- Right: Sign in button for large screens -->
        <a href="Login/login.php" class="btn btn-sm btn-success fs-6 fw-semibold text-light me-2 border-1 border-light d-none d-lg-inline">Sign in</a>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle active class on nav-links
        function handleNavLinks() {
            var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            // Set the correct nav-link as active based on the URL hash
            var currentHash = window.location.hash;
            var activeSet = false;
            if (currentHash) {
                navLinks.forEach(function(navLink) {
                    if (navLink.getAttribute('href') === currentHash) {
                        navLink.classList.add('active');
                        navLink.setAttribute('aria-current', 'page');
                        activeSet = true;
                    } else {
                        navLink.classList.remove('active');
                        navLink.removeAttribute('aria-current');
                    }
                });
            }
            
            // If no active link was set and no hash is present, default to 'Home'
            if (!activeSet) {
                var homeLink = document.querySelector('.navbar-nav .nav-link[href="#home"]');
                homeLink.classList.add('active');
                homeLink.setAttribute('aria-current', 'page');
            }

            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    // Remove the 'active' class and aria-current attribute from all links
                    navLinks.forEach(function(navLink) {
                        navLink.classList.remove('active');
                        navLink.removeAttribute('aria-current');
                    });

                    // Add the 'active' class and aria-current attribute to the clicked link
                    this.classList.add('active');
                    this.setAttribute('aria-current', 'page');
                });
            });
        }

        // Initial check
        handleNavLinks();

        // Add event listener on window resize
        window.addEventListener('resize', handleNavLinks);
    });
</script>
