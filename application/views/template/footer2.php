<?php if (!isset($user_id)) {?>
<div class="articles">

        <div class="container">
            
        </div>
    </div>
    
    <div class="cert">
        <div class="container text-center">
            <img src="/public_html/images/cert.png" alt="">
        </div>
    </div>

   <footer class="footer">
        <!--
        <div class="footer-nav">
            <div class="container">
                <div class="indenter">
                
                    <ul class="nav navbar-nav">
                        <?php
                          foreach($this->system_vars->get_pages('footer') as $p){
                            echo "<li><a href=\"/{$p['url']}\"  class=\"bottom_nav\">{$p['title']}</a></li>";
                          }   
                        ?>
                    </ul>

                    <div class="wrap-social">
                        <a href="#"><img src="public_html/images/social-fb.png" alt=""></a>
                        <a href="#"><img src="public_html/images/social-twitter.png" alt=""></a>
                        <a href="#"><img src="public_html/images/social-insta.png" alt=""></a>
                        <a href="#"><img src="public_html/images/social-ln.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        -->

      <?php
        
            foreach($this->system_vars->get_pages('sub-footer') as $p){
             
               if($p['url'] == 'sub-footer') {
                   echo html_entity_decode($p['content']);
               }
            }   
        
      ?>      
    </footer>

    <div id="signin-form">
        <form name="signin">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username/Email">
             </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
             </div>
                                 


            <button type="submit" class="btn btn-default navbar-btn inline-block">Sign in</button>
            <small class="signin-text label"></small>
        </form>
    </div>
    <?php 
    }
    ?>



	<script type="text/javascript" src="/public_html/js/jquery.min.js"></script>
    <!-- Bootstrap core JavaScript
   ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/public_html/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for   /desktop Windows 8 bug -->
    <script src="/public_html/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
        var $carousel = $('#myCarousel');
        var $carouselCaptions = $carousel.find('.item .carousel-caption');
        var $carouselImages = $carousel.find('.item img');
        var carouselTimeout;

        $carousel.on('slid', function () {
            var $item = $carousel.find('.item.active');
            carouselTimeout = setTimeout(function() { // start the delay
                carouselTimeout = false;
                $item.find('.carousel-caption').animate({'opacity': 1}, 500);
//                $item.find('img').animate({'opacity': 0.2}, 500);
            }, 2000);
        }).on('slide', function () {
                    if(carouselTimeout) { // Carousel is sliding, stop pending animation if any
                        clearTimeout(carouselTimeout);
                        carouselTimeout = false;
                    }
                    // Reset styles
                    $carouselCaptions.animate({'opacity': 0}, 500);
                    $carouselImages.animate({'opacity': 1}, 500);
                });;

        $carousel.carousel({
            interval: 1200000,
            cycle: true
        }).trigger('slid'); // Make the carousel believe that it has just been slid so that the first item gets the animation
    </script>
    
    <script src="/public_html/js/script.js"></script>
    <script src="/public_html/js/angular.js"></script>
    <script src="https://unpkg.com/angular-toastr/dist/angular-toastr.tpls.js"></script>
    <script src="/public_html/js/app/app.js"></script>
    <script src="/public_html/js/app/constant.js"></script>
    <script src="/public_html/js/app/controllers/bulletin_ctrl.js"></script>
 <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109820713-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
    
          gtag('config', 'UA-109820713-1');
        </script>

  </body>
</html>
