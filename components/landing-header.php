<header class="header sticky-top py-1">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center py-1">
            <!-- Logo -->
            <a href="#" class="navbar-brand ms-3">
                <img src="img/esyatek-logo.png" alt="Logo" width="50">
            </a>

            <!-- Centered Navigation Links (visible on larger screens) -->
            <nav class="d-none d-md-flex mx-auto gap-3">
                <a href="#home" class="nav-link ms-2 fs-6 fw-semibold text-dark text-decoration-none">Home</a>
                <a href="#department" class="nav-link ms-2 fs-6 fw-semibold text-dark text-decoration-none">Department</a>
                <a href="#company" class="nav-link mx-2 fs-6 fw-semibold text-dark text-decoration-none">Company</a>
                <a href="#about" class="nav-link me-2 fs-6 fw-semibold text-dark text-decoration-none">About</a>
                <a href="#contact" class="nav-link me-2 fs-6 fw-semibold text-dark text-decoration-none">Contact</a>
            </nav>

            <!-- Right-Aligned: Sign In Button and Hamburger Menu Toggle -->
            <div class="d-flex align-items-center">
                <!-- Sign In Button (visible on larger screens) -->
                <a href="pages/login.php" class="btn btn-success fs-6 fw-semibold text-dark me-2 border-1 border-black d-none d-md-inline">Sign in</a>

                <!-- Hamburger Menu Toggle Button (visible on smaller screens) -->
                <button class="navbar-toggler d-md-none me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <!-- Collapsible Navigation Links and Sign In Button (visible on smaller screens) -->
        <div class="collapse navbar-collapse d-md-none" id="navbarNav">
            <nav class="d-flex flex-column align-items-center gap-3 py-3">
                <a href="#home" class="nav-link ms-2 fs-6 fw-semibold text-dark text-decoration-none">Home</a>
                <a href="#department" class="nav-link ms-2 fs-6 fw-semibold text-dark text-decoration-none">Department</a>
                <a href="#company" class="nav-link mx-2 fs-6 fw-semibold text-dark text-decoration-none">Company</a>
                <a href="#about" class="nav-link me-2 fs-6 fw-semibold text-dark text-decoration-none">About</a>
                <a href="#contact" class="nav-link me-2 fs-6 fw-semibold text-dark text-decoration-none">Contact</a>
                <!-- Sign In Button (visible on smaller screens) -->
                <a href="pages/login.php" class="btn btn-success fs-6 fw-semibold text-dark border-1 border-black mt-2">Sign in</a>
            </nav>
        </div>
    </div>
</header>