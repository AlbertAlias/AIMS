<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AIMS</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/css/landing-page/landing-header.css">
    <link rel="stylesheet" href="assets/css/landing-page/home-section.css">
    <link rel="stylesheet" href="assets/css/landing-page/dept-section.css">
    <link rel="stylesheet" href="assets/css/landing-page/comp-section.css">
    <link rel="stylesheet" href="assets/css/landing-page/about-section.css">
    <link rel="stylesheet" href="assets/css/landing-page/team-section.css">

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>

    <!-- INCLUDE LANDING HEADER -->
    <?php include('components/landing-header.php'); ?>

    <!-- HOME SECTION -->
    <section class="home-section" id="home">
        <div class="home-content">
            <h1 class="display-6 fw-bold">Welcome To AIMS!</h1>
            <p class="lead">Where you Achieve, Inspire, Motivate, & Succeed</p>
            <a href="#department" class="btn btn-success btn-sm">Tell Me More</a>
        </div>
        <img src="img/esyatek-bg1-logo.png" alt="Logo" class="home-logo">
    </section>

    <!-- DEPARTMENT SECTION -->
    <section class="dept-section p-0 m-0" id="department">
        <div class="row">
            <div class="card-container col-12">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: skyblue;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/ba-card.jpg');"></div>
                        <div class="card-back" style="background-color: gold;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/hm-card.jpg');"></div>
                        <div class="card-back" style="background-color: lightgray;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/tm-card.jpg');"></div>
                        <div class="card-back" style="background-color: violet;"></div>
                    </div>
                </div>
                <div class="card active">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: pink;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/educ-card.jpg');"></div>
                        <div class="card-back" style="background-color: red;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/hm-card.jpg');"></div>
                        <div class="card-back" style="background-color: orange;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: darkgray;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/tm-card.jpg');"></div>
                        <div class="card-back" style="background-color: maroon;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="comp-section p-0 m-0" id="company">
        <div class="swiper company-carousel">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide" data-bg="img/accenture-bg.jpg">
                    <img src="img/accenture-logo.png">
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide" data-bg="img/cognizant-bg.jpg">
                    <img src="img/cognizant-logo.png">
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide" data-bg="img/concentrix-bg.png">
                    <img src="img/concentrix-logo.png">
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide" data-bg="img/denso-bg.jpg">
                    <img src="img/denso-logo.png">
                </div>
                <!-- Slide 5 -->
                <div class="swiper-slide" data-bg="img/fujitsu-bg.jpg">
                    <img src="img/fujitsu-logo.png">
                </div>
                <!-- Slide 6 -->
                <div class="swiper-slide" data-bg="img/ibm-bg.jpg">
                    <img src="img/ibm-logo.png">
                </div>
                <!-- Slide 7 -->
                <div class="swiper-slide" data-bg="img/imi-bg.jpg">
                    <img src="img/imi-logo.png">
                </div>
                <!-- Slide 8 -->
                <div class="swiper-slide" data-bg="img/oracle-bg.jpg">
                    <img src="img/oracle-logo.png">
                </div>
                <!-- Slide 9 -->
                <div class="swiper-slide" data-bg="img/taskus-bg.jpg">
                    <img src="img/taskus-logo.png">
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about-section p-0 m-0" id="about">
        <div class="feature feature-left">
            <div class="text-container">
                <h2>Introduction</h2>
                <p>
                On-the-Job Training (OJT) is a training program for College of Engineering and 
                Information Technology Education students designed to apply their knowledge and
                skills in a real-world work environment. This helps in identifying relevant skills 
                for curriculum updates and future employment opportunities.
                </p>
            </div>
            <div class="icon-container">
                <img src="img/ASIATECH 2024 -.png" class="icon1">
            </div>
        </div>
        <div class="feature feature-right">
            <div class="icon-container">
            <h2>Vision</h2>
                <p>To be the Center of Development in Engineering and Information Technology Education by 2030</p>
            <h2>Mission</h2>
                <p>The College is committed to developing assertive, competitive, and innovative professionals imbued with Asiatechian values.</p>
            <h2>Core Values</h2>
                <p>Accountable, Service-Oriented, Innovative, Adaptive, Team-Oriented, Efficient, Committed, Honest, Industrious, Articulate, Noble</p>
            </div>
            <div class="text-container">
            <img src="img/esyatek-bg2.jpg" class="icon">
            </div>
        </div>
        <div class="feature feature-left">
            <div class="text-container">
                <h2>ASIATECH Responsibilities</h2>
                <p>Suggests a host company, Secures the approval from the host company, Conducts an OJT program orientation prior to OJT schedule, Designs a standardized training program that suits the needs of the OJT student-trainee, Provides a mechanism for the evaluation of the program for future enhancement, Assigns a qualified OJT coordinator, Monitors the activities of the student-trainee.</p>
            </div>
            <div class="icon-container">
                <img src="img/about.jpg" alt="" class="icon">
            </div>
        </div>
        <div class="feature feature-right">
            <div class="icon-container">
            <h2>Student Trainee Responsibilities </h2>
                <p>Observes the rules and regulations of the host company, Makes recommendations/proposals to the supervisor when necessary and upon request, regarding the problems encountered, Applies his/her knowledge and skills aligned with his/her program of studies, Completes all the requirements of the OJT program.</p>
            </div>
            <div class="text-container">
            <img src="img/aboutus.jpg" alt="" class="icon">
            </div>
        </div>
    </section>
    
    <!-- TEAM SECTION -->
    <section class="team-section p-0 m-0" id="team">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Team Member 1 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="img/bry.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>Bryan Custodio</h3>
                        <p class="text-muted">Back End Developer</p>
                        <div class="social-icons">
                            <a href="#" class="icon instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="icon gmail"><i class="fa-regular fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="img/al.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>Albert Alias</h3>
                        <p class="text-muted">Full Stack Developer</p>
                        <div class="social-icons">
                            <a href="#" class="icon instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="icon gmail"><i class="fa-regular fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="img/george.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>George Balauag</h3>
                        <p class="text-muted">UI Designer</p>
                        <div class="social-icons">
                            <div class="icon instagram"><i class="fa-brands fa-instagram"></i></div>
                            <div class="icon facebook"><i class="fa-brands fa-facebook-f"></i></div>
                            <div class="icon gmail"><i class="fa-regular fa-envelope"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!--START::LOGIN FUNCTION-->
    <script src="crud-ajax/login-users.js"></script>
    <!--END::LOGIN FUNCTION-->
    <script src="functions/landing-header.js"></script>
    <script src="functions/dept-card.js"></script>
    <script src="functions/comp-card-logo.js"></script>
    <script src="functions/about-carousel-info.js"></script>
</body>
</html>