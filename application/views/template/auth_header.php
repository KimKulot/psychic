<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                <a href="#">
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
                    <a href="#" class="user"><i class="fa fa-user-o" aria-hidden="true"></i></a>

                    <?php  if (isset($user_id)): ?>
                    <a href="/users" class="login"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                    <?php endif; ?>

                </div>
            </div>
            <a href="/#" class="js-show-menu tablet-show"><i class="fa fa-align-justify" aria-hidden="true"></i></a>
        </div>
    </div>
</header>

<div class='errors bg-danger text-danger' hidden="true">&nbsp; </div>
<div class='success bg-success text-success' hidden="true">&nbsp; </div>
