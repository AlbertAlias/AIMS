<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIMS</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/css/landing.css">
    <link rel="stylesheet" href="assets/css/landing-header.css">

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!--START::HEADER -->
    <?php include('components/landing-header.php'); ?>
    <!--END::HEADER-->

    <!--START::HOME HERO SECTION -->
    <section id="home" class="container-fluid p-0 m-0 vh-100 d-flex flex-column justify-content-end align-items-center text-light" 
        style="background-image: url('img/esyatek-bg1-logo.png'); background-size: cover; background-position: center -80px; padding-top: 70px;">
        <div class="container text-center mb-4">
            <div class="row justify-content-center">
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <h1 class="display-6 fw-bold text-black">Welcome To AIMS!</h1>
                    <p class="lead text-black">Where you Achieve, Inspire, Motivate, & Succeed</p>
                    <a href="#department" class="btn btn-success btn-md">Tell Me More</a>
                </div>
            </div>
        </div>
    </section>
    <!--END::HOME HERO SECTION-->

    <!-- DEPARTMENT SECTION -->
    <section id="department" class="p-0 m-0 vh-100 d-flex flex-column justify-content-center align-items-center text-light">
        <div class="container">
            <!-- Row with two columns for department sections -->
            <div class="row p-0 m-0 flex-column flex-md-row align-items-center h-100 mt-4">
                <!-- First container for the first department -->
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                    <div class="container text-center">
                        <!-- Circle Cards Section -->
                        <div class="row justify-content-center mb-4">
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button active" data-card="card-accountancy">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-a-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button" data-card="card-business-administration">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-ba-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button" data-card="card-computer-engineering">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-cpe-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Additional rows for circle cards -->
                        <div class="row justify-content-center mb-4">
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button" data-card="card-criminology">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-crim-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button" data-card="card-computer-science">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-cs-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button" data-card="card-education">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-educ-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Final row -->
                        <div class="row justify-content-center">
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button" data-card="card-hospitality-management">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-hm-logo.jpg" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-4 mb-3">
                                <button class="circle-button" data-card="card-information-technology">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-it-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-4">
                                <button class="circle-button" data-card="card-tourism-management">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-tm-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second container for the second department -->
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center ">
                    <div class="container text-center position-relative overflow-hidden" id="card-container">
                        <!-- Card A -->
                        <div class="card-content active" id="card-accountancy">
                            <img src="img/a-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-business-administration">
                            <img src="img/ba-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-computer-engineering">
                            <img src="img/a-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-criminology">
                            <img src="img/ba-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-computer-science">
                            <img src="img/a-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-education">
                            <img src="img/educ-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-hospitality-management">
                            <img src="img/hm-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-information-technology">
                            <img src="img/educ-card.jpg" alt="">
                        </div>
                        <div class="card-content" id="card-tourism-management">
                            <img src="img/tm-card.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>

    <!--START::LOGIN FUNCTION-->
    <script src="crud-ajax/login-users.js"></script>
    <!--END::LOGIN FUNCTION-->
    <script src="functions/landing.js" ></script>

    <script>
        window.onload = function() {
            const img1 = new Image();
            img1.src = 'img/esyatek-bg1.jpeg';
            const img2 = new Image();
            img2.src = 'img/esyatek-bg2.jpg';
            const img3 = new Image();
            img3.src = 'img/esyatek-bg4.jpg';
            
            // Add loaded class for smooth transitions
            document.querySelectorAll('section').forEach(section => {
                section.classList.add('loaded');
            });
        };
    </script>
</body>
</html>