<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>@yield('title', 'TNELB - Home')</title>

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/color-2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/page_top.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&family=Merriweather:ital@0;1&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body class="theme-color-two">


    <div class="page-wrapper">
        <div class="content ">

            <!-- Main Header -->
            <header class="main-header header-style-two ">

                <!-- Header Top two -->
                <div class="header-top-two bg-gray">
                    <div class="auto-container">
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <ul class="top-info text-center text-md-left">
                                    <li>
                                        <!-- <i class="fas fa-map-marker-alt"></i> -->
                                        <p class="info-text color-dark">Government of TamilNadu | TamilNadu Electricity
                                            Licencing Board</p>
                                    </li>
                                </ul>
                            </div>
                            <!--/ Top info end -->

                            <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
                                <ul class="list-unstyled">
                                    <li><a rel="noopener" href="#mainsection" title="Skip to main content"> <i
                                                class="fa fa-share-square"></i></a></li>
                                    <li><span class="toolbarline"></span></li>
                                    <li><a href="#" class="searchBox">
                                            <input class="searchInput" type="text" name="" placeholder="Search"
                                                id="txt_search" required="">
                                            <button class="searchButton" onclick="google_search();" href="#">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li><span class="toolbarline"></span></li>
                                    <li><a rel="noopener" href="sitemap.php"><i class="fa fa-sitemap"></i></a></li>
                                    <li><span class="toolbarline"></span></li>
                                    <li class="dropdown-submenu">
                                        <a href="#" class="subhover" tabindex="-1"> <i class=" fa fa-wheelchair"></i></a>

                                    </li>
                                    <li><span class="toolbarline"></span></li>
                                    <li><a rel="noopener" href="screenreader.php" title="Screen Reader Access"> <i
                                                class="fa fa-volume-up"></i></a></li>

                                    <li><span class="toolbarline"></span></li>
                                    <li class="dropdown-submenu">
                                        <a href="#" class="subhover" tabindex="-1"> <i class="fa fa-globe"></i></a>

                                    </li>
                                    <li><span class="toolbarline"></span></li>
                                    <li><a rel="noopener" href="#" title="Google translator"><i
                                                class="fa fa-language"></i></a></li>
                                </ul>
                            </div>
                            <!--/ Top social end -->
                        </div>


                    </div>
                </div>

                <div class="logo-fun">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="flex-shrink-0 mr-3 mr-xl-8 mr-xlwd-16 d-none d-md-block">
                                    <a href="/">
                                        <img src="{{ asset('assets/images/logo/logo.png') }}" class="img-fluid" alt="tnelb" />
                                    </a>
                                </div>

                                <div class="flex-shrink-0 mr-3 mr-xl-8 mr-xlwd-16 d-block d-lg-none">
                                    <a href="/">
                                        <img src="{{ asset('assets/images/logo/logo_mobile.png') }}" class="img-fluid" alt="tnelb" />
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 text-center">
                                <ul class="top-info-box">
                                    @if(Auth::check())
                                    <li class="header-get-a-quote" >
                                        <div class="profile">
                                            <div class="user">
                                            <a class="btn btn-success text-white text-capitalize" ><i class="fa fa-user-circle-o"></i>&nbsp; {{ Auth::user()->name }}</a>
                                            </div>
                                            
                                        </div>
                                        <div class="menu">
                                            <ul>
                                                <!-- <li><a href="#"><i class="ph-bold ph-user"></i>&nbsp;Profile</a></li>
                                                <li><a href="#"><i class="ph-bold ph-envelope-simple"></i>&nbsp;Inbox</a></li>
                                                <li><a href="#"><i class="ph-bold ph-gear-six"></i>&nbsp;Settings</a></li>
                                                <li><a href="#"><i class="ph-bold ph-question"></i>&nbsp;Help</a></li> -->
                                                <li><a href="{{ route ('logout')}}"><i class="fa fa-sign-out"></i>&nbsp;Log Out</a></li>
                                            </ul>
                                        </div>
                                    </li>
<!-- 
                                    <li class="header-get-a-quote">
                                        <a class="btn btn-primary text-white" href="{{ route ('logout')}}"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>
                                    </li> -->

                                    @else
                                    <li class="header-get-a-quote">
                                        <a class="btn btn-primary" href="/login">Applicant Sign In/ Sign Up</a>
                                    </li>

                                    @endif
                                    <!-- <li class="header-get-a-quote">
                                    <a class="btn btn-primary" href="register.php">Applicant Sign Up</a>
                                </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Header Upper -->
                <div class="header-upper">
                    <div class="auto-container">
                        <div class="inner-container">

                            <!--Nav Box-->
                            <div class="nav-outer">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler"><img src="{{ asset('assets/images/icons/icon-bar-2.png') }}" alt=""></div>
                                <div class="search-form-two text-md-right display_desk">
                                    <form>
                                        <input type="search" placeholder="Search ...">
                                        <button type="submit"><i class="icon-search"></i></button>
                                    </form>
                                </div>
                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        <ul class="navigation">
                                            <li class="dropdown"><a href="/">Home</a>

                                            </li>

                                            <li class="dropdown"><a href="#">About</a>
                                                <ul>
                                                    <!-- dropdown -->
                                                    <li class=""><a href="/about">About </a>
                                                        <!-- <ul>
                                                        <li><a href="/about">About</a></li>
                                                        <li><a href="about_tamil.php">About Tamil</a></li>
                                                        <li><a href="#">Vision</a></li>
                                                        <li><a href="#">Mission</a></li>
                                                    </ul> -->
                                                    </li>
                                                    <li><a href="/vision">Vision</a></li>
                                                    <li><a href="/mission">Mission</a></li>
                                                    <li><a href="/future-scenario">Future Scenario</a></li>

                                                </ul>
                                            </li>
                                            <li><a href="/members">Members</a></li>
                                            <li><a href="/rules">Rules</a></li>
                                            <li><a href="/services-and-standards">Services & Standards</a></li>
                                            <li><a href="/complaints">Complaints</a></li>

                                            <li class="dropdown"><a href="#">Forms</a>
                                                <ul>
                                                    <li><a href="/login">Form WH</a></li>
                                                    <li> <a href="/login">Form W</a></li>
                                                    <li> <a href="/login">Form S</a></li>

                                                    <li>
                                                        <a href="/login">Form P</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login">Form H TO B</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login"> Form EB</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login">Form SB</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login">Form A</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login"> Form SA</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login"> Fees Structure</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login"> Renewal Particulars (English)</a>

                                                    </li>

                                                    <li>
                                                        <a href="/login"> Renewal Particulars (Tamil)</a>

                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="/contact">Contact</a></li>
                                            <!-- <li class=""><a href="/login" class="btn btn-info">Applicants  Portal</a></li> -->

                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="navbar-right">
                                <div class="search-form-two">
                                    <form>
                                        <input type="search" placeholder="Search ...">
                                        <button type="submit"><i class="icon-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Header Upper-->


                <!-- Sticky Header  -->
                <div class="sticky-header">
                    <div class="header-upper">
                        <div class="auto-container">
                            <div class="inner-container">

                                <div class="nav-outer">
                                    <!--Mobile Navigation Toggler-->
                                    <div class="mobile-nav-toggler">
                                        <img src="{{ asset('assets/images/icons/icon-bar-2.png') }}" alt="">
                                    </div>
                                    <!-- Main Menu -->
                                    <nav class="main-menu navbar-expand-md navbar-light">
                                    </nav>
                                </div>
                                <div class="navbar-right">
                                    <div class="search-form-two">
                                        <form>
                                            <input type="search" placeholder="Search ...">
                                            <button type="submit"><i class="icon-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sticky Menu -->

                <!-- Mobile Menu  -->
                <div class="mobile-menu">
                    <div class="menu-backdrop"></div>
                    <div class="close-btn"><span class="icon far fa-times-circle"></span></div>

                    <nav class="menu-box">

                        <div class="menu-outer">
                            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                        </div>
                        <!--Social Links-->
                        <!-- <div class="social-links">
                        <ul class="clearfix">
                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                            <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                            <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                            <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                        </ul>
                    </div> -->
                    </nav>
                </div><!-- End Mobile Menu -->

                <div class="nav-overlay">
                    <div class="cursor"></div>
                    <div class="cursor-follower"></div>
                </div>
            </header>
            <!-- End Main Header -->

            <!--Search Popup-->
            <div id="search-popup" class="search-popup">
                <div class="close-search theme-btn"><span class="far fa-times-circle"></span></div>
                <div class="popup-inner">
                    <div class="overlay-layer"></div>
                    <div class="search-form">
                        <form method="post" action="#">
                            <div class="form-group">
                                <fieldset>
                                    <input type="search" class="form-control" name="search-input" value=""
                                        placeholder="Search Here" required>
                                    <input type="submit" value="Search Now!" class="theme-btn">
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            