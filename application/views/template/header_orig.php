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
    <meta name="description" content="Text a Psychic UK. Have a quick question? Love, relationships, money, career, predictions. Our Psychics, Astrologers, Clairvoyants, Tarot Readers and Spiritual Advisors are waiting for your text!">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Text a Psychic UK | <?= isset($title)? $title : '';?></title>
    <!-- Bootstrap core CSS -->
    <link href="/public_html/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/public_html/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/public_html/css/pricing-menu.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/public_html/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <script type="text/javascript">
         var BASE_URL = '<?php echo base_url(); ?>';
    </script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="/public_html/css/mislider.css" rel="stylesheet">
    <link href="/public_html/css/mislider-skin-cameo.css" rel="stylesheet">
    <script src="/public_html/js/mislider.js"></script>
    <script>
        jQuery(function ($) {
            var slider = $('.mis-stage').miSlider({
                //  The speed of the slide transition  
                //  in milliseconds. Options: positive integer.
                speed: 900,
                //  The height of the stage in px. Options: false or positive integer. false = height is calculated using maximum slide heights. Default: false
                stageHeight: 360,
                //  Number of slides visible at one time. Options: false or positive integer. false = Fit as many as possible.  Default: 1
                slidesOnStage: false,
                //  The location of the current slide on the stage. Options: 'left', 'right', 'center'. Defualt: 'left'
                slidePosition: 'center',
                //  The slide to start on. Options: 'beg', 'mid', 'end' or slide number starting at 1 - '1','2','3', etc. Defualt: 'beg'
                slideStart: 'mid',
                //  The relative percentage scaling factor of the current slide - other slides are scaled down. Options: positive number 100 or higher. 100 = No scaling. Defualt: 100
                slideScaling: 150,
                //  The vertical offset of the slide center as a percentage of slide height. Options:  positive or negative number. Neg value = up. Pos value = down. 0 = No offset. Default: 0
                offsetV: -5,
                //  Center slide contents vertically - Boolean. Default: false
                centerV: true,
                //  Opacity of the prev and next button navigation when not transitioning. Options: Number between 0 and 1. 0 (transparent) - 1 (opaque). Default: .5
                navButtonsOpacity: 1
            });
        });
    </script>
    <style>
        figure {
            margin: 0;
            padding: 0;
            line-height: 1.4;
            font-family: 'Roboto', sans-serif;

        }

        #wrapper > figure > figcaption {
            margin: 1em;
        }
        .mis-slider li figcaption {
            font-weight: 500;
            letter-spacing: .5px;
        }

        @media screen and (min-width: 1200px) {
            .main {
                width: 50%;
            }
        }

        .cse .gsc-control-cse,
        .gsc-control-cse {
                padding: 0px !important;
        }

        .gsc-clear-button {
          display: none !important;
        }

    </style>

  </head>

  <body>
	
     <div class='errors bg-danger text-danger' hidden="true">&nbsp; </div>
     <div class='success bg-success text-success' hidden="true">&nbsp; </div>
     <?php  
        if(isset($is_activated_false)) echo '<div class=\'errors bg-danger text-danger\'>'. $is_activated_false .'</div>';
        if(isset($is_activated_success)) echo '<div class=\'success bg-success text-success\'>'. $is_activated_success .'</div>';
     ?>
     <?php
        if (!isset($user_id)) {
            foreach($this->system_vars->get_pages('banner') as $p){
             
               if($p['url'] == 'banner') {
                   echo html_entity_decode($p['content']);
               }
            }   
        } else {
        ?>
       <div class="container-fluid bb-topbar ">
            <nav class="navbar navbar-default ">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>

                    <a class="navbar-brand" href="/bulletin_board""><img src="/public_html/images/logo.png" alt="">

                    </a>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right  navbar-nav-bb ">
                    <p class="navbar-text welcome-text">Welcome <?php echo $user['username'] ?></p> 
                    <li class="dropdown">                        
                        
                      <a href="#" class="dropdown-toggle text-white " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#" data-target="#profile-modal" data-toggle="modal" data-id="<?php echo $user_id;?>" onclick="showProfile('<?php echo $user_id;?>')">Profile Update</a></li>
                        <li><a href="#" data-target="#change-password-modal" data-toggle="modal" >Change Password</a></li>
                        <li><a href="#" data-target="#payout-modal" data-toggle="modal">Payout</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="signin" href="#">Logout</a></li>
                      </ul>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->

            </nav>
            </div>
        
        <?php  }   ?>


    
        <!-- Static navbar -->
    <?php  if (!isset($user_id)): ?>
   
   <div class="container">
    <nav class="navbar navbar-default nav-main">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/public_html/images/logo.png" alt=""></a>
            </div>


            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">

                    <!--
                        add check authentication if logged in. 
                        don't display top nav if logged in.
                        change get_pages('footer')
                        to get top_nav/get_menu
                    -->
                    <?php
                          foreach($this->system_vars->get_pages('footer') as $p){
                            echo "<li><a href=\"/{$p['url']}\">{$p['title']}</a></li>";
                          } 

                    ?>
                    
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>    
    </div>
    <?php endif; ?>


</div>
<!-- User Register form -->
    <div id="register-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><b>Register</b></h4>
                    <div id="pop-up" hidden="true" style="color: red;"></div>
                </div>
                <div class="modal-body">
                    <form name="register" class="register-form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="test@gmail.com" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password"  id="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" required>
                            </div>
                            
                        </div>
                        <br><br>  
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">- Select -</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="number" name="mobile_number" class="form-control" placeholder="Mobile number" required>
                            </div>
                            <div class="col-md-6">  
                                <label for="country">Country</label>
                                <select name="country" class="form-control" placeholder="Country" required>
                                    <option value="us">us</option>
                                </select>   
                            </div>
                        </div>
                        <br><br>
                    
                </div><br><br><br>
                <div class="modal-footer">
                    &nbsp;
                    <button type="submit" class="btn btn-default navbar-btn inline-block pull-right">Submit</button>
                    <div id="register-text" hidden="true" class="pull-right" style="margin:14px 12px 0px 0px;"></div>
                    <small class="register-text label"></small>
                    </form>
                </div>
            </div>
        </div>            
    </div>

