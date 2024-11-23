<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AIMS</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/css/landing.css">
    <link rel="stylesheet" href="assets/css/landing-dept.css">
    <link rel="stylesheet" href="assets/css/landing-header.css">

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!-- INCLUDE LANDING HEADER -->
    <?php include('components/landing-header.php'); ?>

    <!-- HOME SECTION -->
    <section id="home" class="p-0 m-0 vh-100 d-flex flex-column justify-content-center align-items-center text-light"
        style="background-image: url('img/esyatek-bg1.png'); background-size: cover; background-position: center -80px; padding-top: 70px;">
        <div class="container text-center mb-5 pb-5">
            <img src="img/esyatek-bg1-logo.png" alt="Logo" class="img-fluid custom-logo"
                style="margin-top: 10%; object-fit: contain;" tabindex="-1" contenteditable="false">

            <h1 class="display-6 fw-bold text-black mt-4">Welcome To AIMS!</h1>
            <p class="lead text-black">Where you Achieve, Inspire, Motivate, & Succeed</p>
            <a href="#department" class="btn btn-success btn-md">Tell Me More</a>
        </div>
    </section>

    <!-- DEPARTMENT SECTION -->
    <section id="department" class="p-0 m-0 vh-100 d-flex flex-column justify-content-center align-items-center text-light">
        <div class="container">
            <!-- Row with two columns for department sections -->
            <div class="row p-0 m-0 flex-column flex-md-row align-items-center h-100 mt-4">
                <!-- First container for the first department -->
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center ">
                    <div class="container text-center">
                        <!-- Row for the circle card containers -->
                        <div class="row justify-content-center mb-4">
                            <!-- Circle Card 1 -->
                            <div class="col-4 mb-3">
                                <button class="circle-button active" data-card="card-accountancy">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-a-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <!-- Circle Card 2 -->
                            <div class="col-4 mb-3">
                                <button class="circle-button" data-card="card-business-administration">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-ba-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <!-- Circle Card 3 -->
                            <div class="col-4">
                                <button class="circle-button" data-card="card-computer-engineering">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-cpe-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-4">
                            <!-- Circle Card 4 -->
                            <div class="col-4 mb-3">
                                <button class="circle-button" data-card="card-criminology">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-crim-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <!-- Circle Card 5 -->
                            <div class="col-4 mb-3">
                                <button class="circle-button" data-card="card-computer-science">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-cs-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <!-- Circle Card 6 -->
                            <div class="col-4">
                                <button class="circle-button" data-card="card-education">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-educ-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <!-- Circle Card 7 -->
                            <div class="col-4 mb-3">
                                <button class="circle-button" data-card="card-hospitality-management">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-hm-logo.jpg" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <!-- Circle Card 8 -->
                            <div class="col-4 mb-3">
                                <button class="circle-button" data-card="card-information-technology">
                                    <div class="circle-card d-flex justify-content-center align-items-center">
                                        <img src="img/esyatek-it-logo.png" alt="" class="circle-img">
                                    </div>
                                </button>
                            </div>
                            <!-- Circle Card 9 -->
                            <div class="col-4">
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
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card B -->
                        <div class="card-content" id="card-business-administration">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card C -->
                        <div class="card-content" id="card-computer-engineering">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card D -->
                        <div class="card-content" id="card-criminology">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card E -->
                        <div class="card-content" id="card-computer-science">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card F -->
                        <div class="card-content" id="card-education">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card G -->
                        <div class="card-content" id="card-hospitality-management">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card H -->
                        <div class="card-content" id="card-information-technology">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                        <!-- Card I -->
                        <div class="card-content" id="card-tourism-management">
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COMPANY SECTION -->
    <section id="company" class="p-0 m-0 vh-100 d-flex flex-column justify-content-center align-items-center text-light">
        
    </section>

    <!-- ABOUT SECTION -->
    <section id="about">
        <div class="container text-center">
            <h2>About Us</h2>
            <p>Discover our mission, vision, and values that drive our organization forward.</p>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact">
        <div class="container text-center">
            <h2>Contact Us</h2>
            <p>We’d love to hear from you! Reach out to us through our contact information or form.</p>
        </div>
    </section>

    <!-- JS SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>

    <!--START::LOGIN FUNCTION-->
    <script src="crud-ajax/login-users.js"></script>
    <!--END::LOGIN FUNCTION-->
    <script src="functions/landing-header.js"></script>
    <script src="functions/department.js"></script>

    <script src="crud-ajax/retrieve-depts-card.js"></script>

</body>
</html>