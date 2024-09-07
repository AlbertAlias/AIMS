<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIMS</title>

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/css/landing.css">

    <style>
        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc800;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-black: #000;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #ffc800;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc800;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-primary-rgb: 255, 200, 0;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 25, 135, 84;
            --bs-info-rgb: 13, 202, 240;
            --bs-warning-rgb: 255, 200, 0;
            --bs-danger-rgb: 220, 53, 69;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-body-color-rgb: 33, 37, 41;
            --bs-body-bg-rgb: 255, 255, 255;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: Roboto Slab, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-body-color: #212529;
            --bs-body-bg: #fff;
            --bs-border-width: 1px;
            --bs-border-style: solid;
            --bs-border-color: #dee2e6;
            --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
            --bs-border-radius: 0.375rem;
            --bs-border-radius-sm: 0.25rem;
            --bs-border-radius-lg: 0.5rem;
            --bs-border-radius-xl: 1rem;
            --bs-border-radius-2xl: 2rem;
            --bs-border-radius-pill: 50rem;
            --bs-link-color: #ffc800;
            --bs-link-hover-color: #cca000;
            --bs-code-color: #d63384;
            --bs-highlight-bg: #fff4cc;
            }

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
    <?php include('components/landing-header.php'); ?>
    <!--END::HEADER-->

    <!--START::HOME HERO SECTION -->
    <section id="home" class="container-fluid p-0 m-0 vh-100 d-flex align-items-center justify-content-center text-light" style="background-image: url('img/esyatek-bg1.jpeg'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="display-6 fw-bold text-black d-none d-md-block">Welcome To AIMS!</h1> <!-- Hidden on screens smaller than md -->
                    <p class="lead text-black d-none d-md-block">Where you Achieve, Inspire, Motivate, & Succeed</p> <!-- Hidden on screens smaller than md -->
                    <a href="#department" class="btn btn-success btn-md d-none d-md-block">Tell Me More</a> <!-- Hidden on screens smaller than md -->
                </div>
            </div>
        </div>
    </section>
    <!--END::HOME HERO SECTION-->


    <!--START::DEPT HERO SECTION -->
    <section id="department" class="container-fluid p-0 m-0 vh-100 text-light">
        <div class="container-fluid" style="height: 85vh; background-image: url('img/esyatek-bg2.jpg'); background-size: cover; background-position: center;">
            
        </div>

        <div class="container-fluid d-flex justify-content-center align-items-center p-0 m-0" style="height: 15vh;">
            <div class="logos">
                <div class="logos-slide">
                    <img src="./img/esyatek-logo.png" />
                    <img src="./img/esyatek-logo.png" />
                    <img src="./img/esyatek-logo.png" />
                    <img src="./img/bshm-logo.png" />
                    <img src="./img/bsit-logo.png" />
                    <img src="./img/bstm-logo.png" />
                    <img src="./img/bsa-logo.png" />
                    <img src="./img/esyatek-logo.png" />
                    <img src="./img/esyatek-logo.png" />
                </div>
            </div>
        </div>
    </section>
    <!--END::DEPT HERO SECTION-->

                    <!-- <img src="./img/buzzfeed.svg" />
                    <img src="./img/budweiser.svg" />
                    <img src="./img/barstool-store.svg" />
                    <img src="./img/forbes.svg" />
                    <img src="./img/macys.svg" />
                    <img src="./img/menshealth.svg" />
                    <img src="./img/mrbeast.svg" /> -->

    <!--START::COMP HERO SECTION -->
    <section id="company" class="container-fluid p-0 m-0 vh-100 text-light" style="background-color: #edeeee;">
        <div class="container-fluid" style="height: 40vh; background-image: url('img/esyatek-bg4.jpg'); background-size: cover; background-position: center;">
            <!-- Content for the top 30vh -->
        </div>
        <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 60vh;">
            <div id="carouselExampleDark" class="carousel slide w-100" data-bs-ride="carousel" style="max-width: 90%; height: 70%;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active bg-success" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" class="bg-success" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" class="bg-success" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="10000">
                        <div class="row">
                        <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="10000">
                        <div class="row">
                        <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center" style="background-color: #b5bab6;">
                                    <div class="card-img-container">
                                        <img src="img/esyatek-logo.png" class="card-img-top mt-3 px-2" style="width: 75%;" alt="Company Logo 1">
                                    </div>                                    
                                    <div class="card-body">
                                        <button class="btn btn-primary">ASIATECH</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" style="left: -80px; top: -45px;" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" style="right: -80px; top: -45px;" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <!--END::COMP HERO SECTION-->

    <!--START::ABO HERO SECTION -->
    <section id="about" class="container-fluid p-0 m-0 vh-100 text-light">
        <div class="container-fluid d-flex align-items-center justify-content-around" style="height: 20vh; background-color: #68d9b7;">
            <button type="button" class="btn btn-lg btn-light mx-2 mt-5">Mission and Vision</button>
            <button type="button" class="btn btn-lg btn-light mx-2 mt-5">Asiatech Hymnn</button>
            <button type="button" class="btn btn-lg btn-light mx-2 mt-5">Administration & Staff</button>
            <button type="button" class="btn btn-lg btn-light mx-2 mt-5">Faculty</button>
        </div>
        <div class="container-fluid" style="height: 80vh; background-color: #edeeee;">
            <div id="content-mission-vision" class="" style="display: none;">
                <h2>Mission and Vision</h2>
                <p>Your content for Mission and Vision goes here.</p>
            </div>
            <div id="content-hymnn" class="" style="display: none;">
                <h2>Asiatech Hymnn</h2>
                <p>Your content for Asiatech Hymnn goes here.</p>
            </div>
            <div id="content-admin-staff" class="" style="display: none;">
                <h2>Administration & Staff</h2>
                <p>Your content for Administration & Staff goes here.</p>
            </div>
            <div id="content-faculty" class="" style="display: none;">
                <h2>Faculty</h2>
                <p>Your content for Faculty goes here.</p>
            </div>
        </div>
    </section>
    <!--END::ABO HERO SECTION-->
    

    <!-- jQuery CDN Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- BOOTSTRAP CDN LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <!--START::ADD USER MODAL FUNCTION-->
    <script src="crud-ajax/manage-users/login-users.js"></script>
    <!--END::ADD USER MODAL FUNCTION-->
    </script>
</body>
</html>