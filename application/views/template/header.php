<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  
if($this->session->flashdata('error')) echo '<div class=\'errors\'>'.$this->session->flashdata('error').'</div>';
if($this->session->flashdata('response')) echo '<div class=\'responses\'>'.$this->session->flashdata('response').'</div>';

if($this->session->flashdata('error')) echo '<div class=\'callout callout-warning errors\'>'.$this->session->flashdata('error').'</div>';
if($this->session->flashdata('response')) echo '<div class=\'callout callout-success responses\'>'.$this->session->flashdata('response').'</div>';
?>
<!DOCTYPE html>
<html lang="en-GB" ng-app="txtapsy">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Text a Psychic US. Have a quick question? Love, relationships, money, career, predictions. Our Psychics, Astrologers, Clairvoyants, Tarot Readers and Spiritual Advisors are waiting for your text!">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Text a Psychic USA | <?= isset($title)? $title : '';?></title>

    <link rel="stylesheet" id="carousel-style-css" href="/public_html/theme/styles/flex-carousel.css" type="text/css" media="all">
    <link rel="stylesheet" id="font-awesome-css" href="/public_html/theme/styles/font-awesome.css" type="text/css" media="all">
    <link rel="stylesheet" id="normalize-css" href="/public_html/theme/styles/normalize.css" type="text/css" media="all">
    <link rel="stylesheet" id="theme-main-style-css" href="/public_html/theme/styles/main.css" type="text/css" media="all">
    <link rel="stylesheet" id="theme-custom-style-css" href="/public_html/theme/styles/custom.css" type="text/css" media="all">
    <script type="text/javascript" src="/public_html/theme/scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
         var BASE_URL = '<?php echo base_url(); ?>';
    </script>

  </head>

  <body class="home page-template page-template-template-home page-template-template-home-php page page-id-2 page-body">

<header class="page-header">
    <div class="header-top">
        <div class="container display-flex flex-between">
            <div class="logo wrap-img">
                <a href="/">
                    <img src="/public_html/theme/images/logo.png" alt="">
                </a>
            </div>

            <div class="menu">
                <ul id="menu-menu" class="display-flex flex-between js-scroll">
                    <li id="menu-item-15"
                        class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-15">
                        <a href="/#work">How does it work?</a></li>
                    <li id="menu-item-16"
                        class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-16">
                        <a href="/#advisor">Advisors</a></li>
                    <li id="menu-item-17"
                        class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-17">
                        <a href="/#faq">FAQ</a></li>
                    <li id="menu-item-12" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12">
                        <a href="/contact-us.html">Contact Us</a>
                    </li>
                    <li id="menu-item-60" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-60">
                        <a href="/terms-and-conditionals.html">Terms and Conditionals</a></li>
                </ul>
            </div>
            <div class="auth">
                <div class="execphpwidget">
                    <a href="/users" class="user"><i class="fa fa-user-o" aria-hidden="true"></i></a>

                    <?php  if (isset($user_id)): ?>
                    <a href="/users" class="login"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <a href="/#" class="js-show-menu tablet-show"><i class="fa fa-align-justify" aria-hidden="true"></i></a>
        </div>
    </div>
</header>


<section class="banner desktop"
         style="background: url(/public_html//theme/images/banner-head.jpg) no-repeat;background-position: 55% top;">
    <div class="container">
        <div class="banner__text">
            <h1>Get the most accurate psychic advice!</h1>
            <p>
                Our Psychics, Astrologers, Clairvoyants, Tarot Readers and Spiritual Advisors are waiting for your
                text! </p>
        </div>
    </div>
</section>

<section class="banner mobile"
         style="background: url(/public_html/theme/images/mobile-bg.jpg) top center no-repeat;">
    <div class="container">
        <div class="banner__text">
            <h1>Get the most accurate psychic advice!</h1>
            <p>
                Our Psychics, Astrologers, Clairvoyants, Tarot Readers and Spiritual Advisors are waiting for your
                text! </p>
        </div>
    </div>
</section>


<section class="works  js-active-line-fourth" id="work">
    <div class="container">
        <h2 class="underline  js-g-line">How does it works?</h2>
        <div class="works__bloks display-flex flex-between">
            <div class="works__block">
                <h5>FIND A RIGHT ADVISOR</h5>
                <p>Our psychic advisors can help provide guidance and clarity in love, relationship, career and more. No
                    matter what's on your mind, you deserve to get the advice.</p>
            </div>
            <div class="works__block">
                <h5>SEND A MESSAGE</h5>
                <p>Type in Physics and then your question.Text it the shortcode in your country. Note: Maximum 150
                    characters per question sent.</p>
            </div>
            <div class="works__block">
                <h5>GET THE ANSWER</h5>
                <p>Your Physic will send the answer that provides insights to help you unlock clarity amid uncertainty
                    within minutes.</p>
            </div>
        </div>
    </div>
</section>



<section class="advisors js-active-line-first" id="advisor">
    <div class="full-container v-line">
        <div class="container">
            <h2 class="underline  js-g-line">Advisors</h2>
            <div class="advisors__text">
                <p>Our Psychics, Astrologers, Clairvoyants, Tarot Readers and Spiritual Advisors are waiting for your text!</p>
            </div>
            <div class="carousel">
                <div class="portfolio-carousel">
                    <?php foreach($readers as $reader): ?>
                    <div class="item">
                        <div class="media-holder"
                             style="background-image: url(/public_html/images/readers/slider/<?php echo $reader['profile_img']; ?>)">
                        </div>
                        <div class="detail-container">
                            <h4 class="underline"><a href="#"><?php echo $reader['username']; ?></a></h4>
                            <p>
                                <span><?php echo $reader['area']; ?></span>                               
                                <strong>Pin <?php echo $reader['pin']; ?></strong>
                            </p>
                        </div>
                    </div>

                    <?php endforeach; ?>


                   

                </div>
            </div>
        </div>
</section>



<section class="faq  js-active-line-second" id="faq">
    <div class="container">
        <h2 class="underline  js-g-line">FAQ</h2>
        <ul class="list-questions">
            <li>
                <h4>How Do I Ask A Question? <a href="#" class="js-hide"><i
                        class="fa fa-minus" aria-hidden="true"></i></a>

                </h4>
                <p>Simply select the “Psychics” tab, choose your psychic advisor, and send your question. It’s as easy
                    as sending a text!</p>
            </li>
            <li>
                <h4>Can I Trust To This Psychic Reading? <a href="#" class="js-hide"><i
                        class="fa fa-minus" aria-hidden="true"></i></a>

                </h4>
                <p>Simply select the “Psychics” tab, choose your psychic advisor, and send your question. It’s as easy
                    as sending a text!</p>
            </li>
            <li>
                <h4>Are they Real? <a href="#" class="js-hide"><i class="fa fa-minus"
                                                                  aria-hidden="true"></i></a>
                </h4>
                <p>Simply select the “Psychics” tab, choose your psychic advisor, and send your question. It’s as easy
                    as sending a text!</p>
            </li>
            <li>
                <h4>How does it work? <a href="#" class="js-hide"><i class="fa fa-minus"
                                                                     aria-hidden="true"></i></a>
                </h4>
                <p>Simply select the “Psychics” tab, choose your psychic advisor, and send your question. It’s as easy
                    as sending a text!</p>
            </li>
            <li>
                <h4>How I will pay? <a href="#" class="js-hide"><i class="fa fa-minus"
                                                                   aria-hidden="true"></i></a>
                </h4>
                <p>Simply select the “Psychics” tab, choose your psychic advisor, and send your question. It’s as easy
                    as sending a text!</p>
            </li>
        </ul>
    </div>
</section>

<section class="banner-bottom js-active-line-third">
    <div class="full-container  v-line desktop"
         style="background: url(/public_html/theme/images/banner-bottom.jpg) center top/cover;">
        <div class="container">
            <div class="banner-bottom__text-block">
                <h3>No matter where you are or what you are doing, whether you are on the go or multitasking you can get
                    a Psychic Reading!</h3>
                <p>To get the best response from our Psychics, just Text a specific question!<br>
                    <strong>TEXT “PSYCHICS” + YOUR QUESTIONS TO: 12399003577</strong></p>
            </div>
        </div>
    </div>
    <div class="full-container  v-line mobile"
         style="background: #e4e9ec url(/public_html/theme/images/banner-bottom-mob.png) center top/cover;">
        <div class="container">
            <div class="banner-bottom__text-block">
                <h3>No matter where you are or what you are doing, whether you are on the go or multitasking you can get
                    a Psychic Reading!</h3>
                <p>To get the best response from our Psychics, just Text a specific question!<br>
                    <strong>TEXT “PSYCHICS” + YOUR QUESTIONS TO: 12399003577</strong></p>
            </div>
        </div>
    </div>
</section>
