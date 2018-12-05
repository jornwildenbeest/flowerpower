<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FlowerPower</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Highlight-Phone.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container">
                <a class="navbar-brand" href="index.php">Flower power</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav mr-auto"></ul>
                    <span class="navbar-text actions">
                        <?php
                            if($_SESSION["logged_in"] == 0){
                                echo '<a href="login.php" class="login">Log In</a>';
                                echo ' <a class="btn btn-primary action-button register_button" role="button" href="register.php">Registreren</a>';
                            } else {
                                echo '<a href="assets/logout.php" class="login">Log Out</a>';
                            }
                            ?>
                        
                       
                        <a href="cart.php"><i class="fa fa-shopping-cart shopping_cart_icon"></i></a>
                    </span>
                </div>
            </div>
        </nav>
    </div>
    <div class="simple-slider" style="height:200px;">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image:url(https://www.jorn-wildenbeest.gcmediavormgeving.nl/flowerpower/slider_img/flowerslide1.jpg);height:200px;"></div>
                <div class="swiper-slide" style="background-image:url(https://www.jorn-wildenbeest.gcmediavormgeving.nl/flowerpower/slider_img/flowerslide4.jpg);height:200px;"></div>
                <div class="swiper-slide" style="background-image:url(https://www.jorn-wildenbeest.gcmediavormgeving.nl/flowerpower/slider_img/flowerslide3.jpg);height:200px;"></div>
                <!-- https://placeholdit.imgix.net/~text?txtsize=68&amp;txt=Slideshow+Image&amp;w=1920&amp;h=500 -->
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container">
                <a class="navbar-brand d-none" href="#"></a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Webshop</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Over ons</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>