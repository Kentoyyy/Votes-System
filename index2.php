<?php
session_start(); // Start the session at the beginning of the script

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["email"])) {
    header("Location: login.html");
    exit();
}

// Retrieve the email from the session
$email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--========== CSS ==========-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Votes</title>
</head>

<body>

    <!--========== SCROLL TOP ==========-->
    <a href="#" class="scrolltop" id="scroll-top">
        <i class='bx bx-chevron-up scrolltop__icon'></i>
    </a>

    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="#" class="nav__logo">Votes</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link active-link">Home</a></li>
                    <li class="nav__item"><a href="#about" class="nav__link">FAQs & Help</a></li>
                    <li class="nav__item"><a href="#services" class="nav__link">Candidates</a></li>
                    <li class="nav__item"><a href="votes.php" class="nav__link">Vote</a></li>
                    <?php
        // Check if the user is logged in
        if (!isset($_SESSION["email"])) {
            // User is not logged in, show login link
            echo '<li class="nav__item"><a href="login.html" class="nav__link">Login</a></li>';
        } else {
            // User is logged in, show logout button
            echo '<li class="nav__item">
                    <form action="logout.php" method="post">
                        <button type="submit" class="nav__link" style="border: none; background: none; cursor: pointer;">Logout</button>
                    </form>
                </li>';
        }
        ?>

                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </nav>
    </header>

    <main class="l-main">
        <!--========== HOME ==========-->
        <section class="home" id="home">
            <div class="home__container bd-container bd-grid">
                <div class="home__data">
                    <h1 class="home__title">Choose<br>Candidates</h1>
                    <h2 class="home__subtitle">"Welcome! where your voice matters.
                        Explore our diverse array of candidates committed to shaping a better future for our school."</h2>
                    <a href="#" class="button">Learn more</a>
                </div>

                <img src="assets/img/homepic.png" alt="" class="home__img">
            </div>
        </section>

        <!--========== ABOUT ==========-->
        <section class="about section bd-container" id="about">
            <dib class="bg-frame" style="width: 100px; height: 100px; color: #289965;">

            </dib>
            <div class="about__container  bd-grid">
                <div class="about__data">
                    <div class="bg_frame"
                        style="background-color: #289965; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; width: 140%; margin-left: -150px; height: 170px; border-radius: 10px; position: absolute;">
                        <span class="section-subtitle about__initial"
                            style="font-size: 40px; font-weight: 500; color: #fff; position: absolute; margin-left: 500px; margin-top: 15px;">VOTING
                            FAQs</span>
                        <div class="small_frame"
                            style="width: 800px; height: 35px; border-radius: 7px;  margin-top: 100px; border-style: solid; color: #fff; position: relative; margin-left: 250px;">
                            <h2 class="section-title about__initial" style="position: relative; margin-top: 3px;">
                                Register to Vote | Voting Early/Absentee | Voting
                                on Election Day | Voter Cards</h2>
                        </div>

                    </div>
                    <div class="content-about">
                        <h2
                            style="font-size: 26px; font-weight: 600; position: relative;  margin-left: 330px; margin-top: 230px;">
                            Registering to Vote FAQ's</h2>
                        <div class="bg_frame1">
                            <h2>is It too late to Register to Vote?</h2>
                            <p>Voter registration deadlines vary by state Election School Center information for the
                                voter registration<br>deadlines
                                in your School.</p>
                        </div>
                        <div class="bg_frame2">
                            <h2>On Election Day, if I think my rights have been violated, what should I do?</h2>
                            <p>Call (Officers) OUR-VOTE if you feel your rights have been violated. There will be
                                lawyers on hand to answer Election Day questions and concerns about voting procedures.
                            </p>
                        </div>
                        <div class="bg_frame3">
                            <h2>On Election Day, if I think my rights have been violated, what should I do?</h2>
                            <p>Call (Officers) OUR-VOTE if you feel your rights have been violated. There will be
                                lawyers on hand to answer Election Day questions and concerns about voting procedures.
                            </p>
                        </div>

                        <h2
                            style="font-size: 26px; font-weight: 600; position: relative;  margin-left: 330px; margin-top: 50px;">
                            Voting Early/Absentee</h2>
                        <div class="bg_frame4">
                            <h2>On Election Day, if I think my rights have been violated, what should I do?</h2>
                            <p>Call (Officers) OUR-VOTE if you feel your rights have been violated. There will be
                                lawyers on hand to answer Election Day questions and concerns about voting procedures.
                            </p>
                        </div>

                    </div>

                    <a href="#" class="button" style="position: absolute; margin-left: 420px; margin-top: 20px;">More
                        FAQ's </a>
                </div>


            </div>
        </section>

        <!--========== Candidats ==========-->
        <section class="services section bd-container" id="services">
            <div class="services__content">
                <div class="left-container">
                    <h2>List of Candidates</h2>
                    <p>Get to know your candidates stances, issues and platform. </p>
                    <div class="BG-Pres">
                        <h2>For President</h2>
                    </div>
                    <div class="users-candidates">
                        <i class="fa-solid fa-user" id="user-face" style="color: #707070;"></i>
                        <h3>ABALOS Nathaniel (AKS)</h3>
                    </div>


                    <div class="popup" id="popup-1">
                        <div class="overlay"></div>
                        <div class="content">
                            <div class="close-btn" onclick="togglePopup()">&times;</div>
                            <h1>Nathaniel Abalos</h1>
                            <p>Running for president of a school society allows me to contribute positively to the
                                school community.<br><br>Enhanced Communication:

                                Student Feedback Portal: Establish an online platform or app where students can submit
                                suggestions, feedback, and ideas anonymously.<br>
                                <br>Academic Support and Growth - Peer Tutoring Network: Establish a structured peer
                                tutoring program where students can seek academic help from their peers.
                            </p>

                        </div>

                    </div>

                    <button onclick="togglePopup()" id="btn-info" style="background: #289965; position: absolute; margin-left: -180px; height: 35px; width: 120px; color: #fff; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 12px;">More info</button>
                        
                    <div class="BG-VPres">
                        <h2>For Vice President</h2>
                    </div>
                    <div class="users-partylist">
                        <i class="fa-solid fa-user" id="user-face" style="color: #707070;"></i>
                        <h3>ALCANTARA Ken (YFP)</h3>

                        <div class="popup" id="popup-2">
                            <div class="overlay"></div>
                            <div class="content">
                                <div class="close-btn" onclick="togglePopup2()">&times;</div>
                                <h1>Ken Alcantara</h1>
                                <p>I am honored to stand before you today as a candidate for Vice President of our
                                    esteemed school society. My name is [Your Name], and I am deeply committed to
                                    serving and representing the interests of each and every one of you.
                                    <br><br> Enhanced Communication:

                                    Instance: Implementing a "Suggestion Box" accessible both physically and online,
                                    ensuring your voices are heard and valued.
                                    Instance: Introducing monthly forums where we gather to discuss society matters,
                                    allowing open dialogue and transparency in decision-making.
                                </p>
    
                            </div>
    
                        </div>
                        <button onclick="togglePopup2()" id="togglePopup2" style="background: #289965; position: absolute; margin-left: 80px; height: 35px; width: 120px; color: #fff; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 12px;">More info</button>

                    </div>
                    

                </div>


                <div class="right-container">
                    <h2>List of PARTYLIST</h2>
                    <p>Get to know your candidates stances, issues and platform. </p>
                    <div class="BG-PARTLIST">
                        <h2>PARTYLIST GROUP</h2>
                    </div>

                    <div class="bg-user">
                        <i class="fa-solid fa-user" id="user-face" style="color: #cecece;"></i>
                    </div>
                    <div class="partylist-aksyon">
                        <h2>AKS</h2>
                        <p>Aksyon Party</p>
                    </div>

                    <div class="bg-user1">
                        <i class="fa-solid fa-user" id="user-face" style="color: #cecece;"></i>
                    </div>
                    <div class="partylist-aksyon1">
                        <h2>FSP</h2>
                        <p>Fresh Start Party</p>
                    </div>

                    <div class="bg-user2">
                        <i class="fa-solid fa-user" id="user-face" style="color: #cecece;"></i>
                    </div>
                    <div class="partylist-aksyon2">
                        <h2>YFP</h2>
                        <p>Youth for Progress</p>
                    </div>


                </div>


            </div>
            </div>
        </section>

        <!--========== VOTERS ==========-->
        <section class="menu section bd-container" id="menu">
            <span class="section-subtitle">Voters</span>
            <h2 class="section-title">DASHBOARD</h2>

            <div class="menu__container bd-grid">
                <div class="menu__content">

                </div>
        </section>


        <!--========== CONTACT US ==========-->
        <section class="contact section bd-container" id="contact">
            <div class="contact__container bd-grid">
                <div class="contact__data">

                </div>
        </section>
    </main>

    <!--========== FOOTER ==========-->
    <footer class="footer section bd-container">
        <div class="footer__container bd-grid">
            <div class="footer__content">


                <div class="footer__content">

                </div>


            </div>

            <p class="footer__copy">&Voters TEAM. All right reserved</p>
    </footer>

    <!--========== SCROLL REVEAL ==========-->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!--========== MAIN JS ==========-->
    <script src="assets/js/main.js"></script>
</body>

</html>