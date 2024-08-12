<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIMS</title>

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- STYLES -->
    <link rel="stylesheet" href="">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            scroll-behavior: smooth;
        }

        .header {
            background-color: transparent; /* Light gray background */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5); /* Shadow at the bottom */
            backdrop-filter: blur(5px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0;
        }
  </style>
</head>
<body>

    <!--START::HEADER -->
    <header class="header sticky-top py-1">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center py-1">
                <!-- Logo -->
                <a href="#" class="navbar-brand ms-3">
                    <img src="img/esyatek-logo.png" alt="Logo" width="50">
                </a>
                
                <!-- Navigation Links -->
                <nav class="d-flex gap-3">
                    <a href="#home" class="fs-6 fw-semibold text-dark text-decoration-none">Home</a>
                    <a href="#department" class="fs-6 fw-semibold  text-dark text-decoration-none ms-4">Department</a>
                    <a href="#company" class="fs-6 fw-semibold text-dark text-decoration-none mx-4">Company</a>
                    <a href="#about" class="fs-6 fw-semibold text-dark text-decoration-none me-4">About</a>
                    <a href="#contact" class="fs-6 fw-semibold text-dark text-decoration-none">Contact</a>
                </nav>

                <!-- Button -->
                <a href="#" class="btn btn-outline-success fs-6 fw-semibold text-dark me-3">Sign in</a>
            </div>
        </div>
    </header>
    <!--END::HEADER-->

    <!--START::HOME HERO SECTION -->
    <section id="home" class="container-fluid p-0 m-0 vh-100 d-flex align-items-center justify-content-center text-light" style="background-image: url('img/esyatek-bg1.jpeg'); background-size: cover; background-position: center;">
    </section>
    <!--END::HOME HERO SECTION-->

    <!--START::DEPT HERO SECTION -->
    <section id="department" class="container-fluid p-0 m-0 vh-100 d-flex align-items-center text-center text-light" style="background-image: url('img/esyatek-bg2.jpg'); background-size: cover; background-position: center;">
        <div class="container d-flex justify-content-end pe-5">
            <button class="btn btn-lg btn-outline-success fs-6 fw-semibold text-dark" style="position: relative; top: 180px;">Explore Department</button>
        </div>
    </section>
    <!--END::DEPT HERO SECTION-->

    <!--START::COMP HERO SECTION -->
    <section id="company" class="container-fluid p-0 m-0 vh-100 d-flex align-items-center text-center text-light" style="background-image: url('img/esyatek-bg3.jpg'); background-size: cover; background-position: center;">
    </section>
    <!--END::COMP HERO SECTION-->

    <!--START::ABO HERO SECTION -->
    <section id="about" class="container-fluid p-0 m-0 vh-100 text-light" style="background-color: #edeeee; color:#767676;">
        <div class="container-fluid" style="height: 20vh;">

        </div>
        <div class="container-fluid" style="height: 80vh;">

        </div>
    </section>
    <!--END::ABO HERO SECTION-->


    <!-- BOOTSTRAP CDN LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>