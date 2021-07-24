<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HOUSEMAID</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url();?>assets/backend/dist/img/HousemaidLogo.png">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/gijgo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/slicknav.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="<?php echo base_url();?>">
                                    <img src="<?php echo base_url();?>assets/frontend/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="main-menu  d-none d-lg-block text-center">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="<?php echo base_url('index.php/Front');?>">home</a></li>
                                        <li><a href="<?php echo base_url('index.php/Front/karir');?>">Karir</a></li>
                                        <li><a href="<?php echo base_url('index.php/Front/berita');?>">Berita</a></li>
                                        <li><a href="<?php echo base_url('index.php/Front/pengumuman');?>">Pengumuman</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-2 d-none d-lg-block">
                            <div class="log_chat_area d-flex align-items-end">
                                <?php if(!isset($_SESSION['logged_in']['username'])){ ?>
                                    <a href="<?php echo base_url('index.php/Login');?>" class="say_hi">LOGIN</a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('index.php/Main');?>" class="say_hi"><?php echo $_SESSION['logged_in']['nama']?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->