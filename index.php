<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AIMS</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/style/index/landing-header.css">
    <link rel="stylesheet" href="assets/style/index/home-section.css">
    <link rel="stylesheet" href="assets/style/index/dept-section.css">
    <link rel="stylesheet" href="assets/style/index/comp-section.css">
    <link rel="stylesheet" href="assets/style/index/about-section.css">
    <link rel="stylesheet" href="assets/style/index/team-section.css">

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>

    <!-- INCLUDE LANDING HEADER -->
    <?php include('components/landing-header.php'); ?>

    <!-- HOME SECTION -->
    <section class="home-section" id="home">
        <div class="home-content">
            <h1>Welcome to AIMS</h1>
            <p>Where you Achieve, Inspire, Motivate, & Succeed</p>
            <a href="#department" class="btn btn-sm btn-success">Tell Me More</a>
        </div>
        <img src="assets/img/index/esyatek-bg1-logo.png" alt="Logo" class="home-logo">
    </section>

    <!-- DEPARTMENT SECTION -->
    <section class="dept-section p-0 m-0" id="department">
        <div class="row">
            <div class="card-container col-12">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: skyblue;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/ba-card.jpg');"></div>
                        <div class="card-back" style="background-color: gold;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/hm-card.jpg');"></div>
                        <div class="card-back" style="background-color: lightgray;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/tm-card.jpg');"></div>
                        <div class="card-back" style="background-color: violet;"></div>
                    </div>
                </div>
                <div class="card active">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: pink;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/educ-card.jpg');"></div>
                        <div class="card-back" style="background-color: red;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/hm-card.jpg');"></div>
                        <div class="card-back" style="background-color: orange;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: darkgray;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('assets/img/index/tm-card.jpg');"></div>
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
                <div class="swiper-slide" data-bg="assets/img/index/accenture-bg.jpg">
                    <img src="assets/img/index/accenture-logo.png">
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide" data-bg="assets/img/index/cognizant-bg.jpg">
                    <img src="assets/img/index/cognizant-logo.png">
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide" data-bg="assets/img/index/concentrix-bg.png">
                    <img src="assets/img/index/concentrix-logo.png">
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide" data-bg="assets/img/index/denso-bg.jpg">
                    <img src="assets/img/index/denso-logo.png">
                </div>
                <!-- Slide 5 -->
                <div class="swiper-slide" data-bg="assets/img/index/fujitsu-bg.jpg">
                    <img src="assets/img/index/fujitsu-logo.png">
                </div>
                <!-- Slide 6 -->
                <div class="swiper-slide" data-bg="assets/img/index/ibm-bg.jpg">
                    <img src="assets/img/index/ibm-logo.png">
                </div>
                <!-- Slide 7 -->
                <div class="swiper-slide" data-bg="assets/img/index/imi-bg.jpg">
                    <img src="assets/img/index/imi-logo.png">
                </div>
                <!-- Slide 8 -->
                <div class="swiper-slide" data-bg="assets/img/index/oracle-bg.jpg">
                    <img src="assets/img/index/oracle-logo.png">
                </div>
                <!-- Slide 9 -->
                <div class="swiper-slide" data-bg="assets/img/index/taskus-bg.jpg">
                    <img src="assets/img/index/taskus-logo.png">
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
                <img src="assets/img/index/esyatek-logo.png" class="icon1">
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
            <img src="assets/img/index/esyatek-bg2.jpg" class="icon">
            </div>
        </div>
        <div class="feature feature-left">
            <div class="text-container">
                <h2>ASIATECH Responsibilities</h2>
                <p>Suggests a host company, Secures the approval from the host company, Conducts an OJT program orientation prior to OJT schedule, Designs a standardized training program that suits the needs of the OJT student-trainee, Provides a mechanism for the evaluation of the program for future enhancement, Assigns a qualified OJT coordinator, Monitors the activities of the student-trainee.</p>
            </div>
            <div class="icon-container">
                <img src="assets/img/index/about.jpg" alt="" class="icon">
            </div>
        </div>
        <div class="feature feature-right">
            <div class="icon-container">
            <h2>Student Trainee Responsibilities </h2>
                <p>Observes the rules and regulations of the host company, Makes recommendations/proposals to the supervisor when necessary and upon request, regarding the problems encountered, Applies his/her knowledge and skills aligned with his/her program of studies, Completes all the requirements of the OJT program.</p>
            </div>
            <div class="text-container">
            <img src="assets/img/index/aboutus.jpg" alt="" class="icon">
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
                        <img src="assets/img/index/bry.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>Bryan Custodio</h3>
                        <p class="text-muted">Back End Developer</p>
                        <div class="social-icons">
                            <div class="icon instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                </svg>
                            </div>
                            <div class="icon facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/>
                                </svg>
                            </div>
                            <div class="icon gmail">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="assets/img/index/al.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>Albert Alias</h3>
                        <p class="text-muted">Full Stack Developer</p>
                        <div class="social-icons">
                            <div class="icon instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                </svg>
                            </div>
                            <div class="icon facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/>
                                </svg>
                            </div>
                            <div class="icon gmail">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="assets/img/index/george.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>George Balauag</h3>
                        <p class="text-muted">UI Designer</p>
                        <div class="social-icons">
                            <div class="icon instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                </svg>
                            </div>
                            <div class="icon facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/>
                                </svg>
                            </div>
                            <div class="icon gmail">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="functions/landing-header.js"></script>
    <script src="functions/dept-card.js"></script>
    <script src="functions/comp-card-logo.js"></script>
    <script src="functions/about-carousel-info.js"></script>
</body>
</html>