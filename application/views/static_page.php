<div class="banner-blog">
    <div class="container">
        <img src="/public_html/images/banner-blog.jpg" class="img-responsive" alt="">
    </div>
</div>
<div >
    <div class="container">
        <div class="row">
            <!-- start article -->
            <div class="col-md-8 content-main">
                <!--<h1>Latest Articles</h1>-->
                <ol class="breadcrumb">
                    <li>
                        <!--<span class="glyphicon glyphicon-menu-right" ></span>-->
                        <a href="/about-us"><?php echo $content['title']; ?></a></li>
                    
                </ol>
                <p></p>
                <?php echo $content['content']; ?>

                <?php if (isset($packages) != null): ?>
                    <div class="wrap" >
                        <section class="container price-item">
                            <div class="row">
                                <?php foreach ($packages as $key => $value): ?>         
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="panel panel-default hover-2">
                                            <div class="panel-heading">
                                                <br><br>
                                                <center>
                                                    <h4 style="color: #1cad8d; font-size: 15px; margin-top: 15px;"><?= $value['title'];?></h4>
                                                </center> 
                                                <div class="price-value">
                                                    <p>
                                                        <span><?= round($value['value']);?></span>
                                                    </p><br>
                                                
                                                </div>
                                                <div class="price-period">
                                                    <p>
                                                        <span>sms</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <h3>$<?= $value['price'];?></h3>             
                                            </div>
                                            <div class="panel-footer">
                                                <!-- http://dev.txtapsy.com/members/price_menu -->
                                                <div>
                                                    <?php if (isset($_SESSION['member_is_logged'])): ?>
                                                        <a href="/members/price_menu">
                                                            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal Logo" title="Pay using Paypal">
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="#" data-target="#register-modal" data-toggle="modal">
                                                            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal Logo" title="Pay using Paypal">
                                                        </a>
                                                     <?php endif ?>
                                                </div>
                                                <hr>
                                                <div>
                                                    <?php if (isset($_SESSION['member_is_logged'])): ?>
                                                        <a href="/members/price_menu">
                                                            <img src="/public_html/images/authnet-logo" alt="Authorize.net Logo" width="100px" title="Pay using Authorize.net">
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="#" data-target="#register-modal" data-toggle="modal">
                                                            <img src="/public_html/images/authnet-logo" alt="Authorize.net Logo" width="100px" title="Pay using Authorize.net">
                                                        </a>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </section>
                    </div>
                <?php endif ?>
                
                
                
            </div>
            <!-- end article -->
            <div class="col-md-4 sidebar">
                <div class="hotline-wrap">
                    <p class="hotline">Text <span class="txt-yellow">"Psychics"</span> <span class="plus">+</span> Your Questions to:  <span class="txt-yellow number">68899</span></p>
                    <p><img src="public_html/images/price.png" alt=""></p>
                    <p>SMS cost £1.50 each to receive, <br> maximum 1 text message <br> per reply.</p>

                    <p>+18y.o Entertainment Purposes Only.</p>
                    <p>To opt out of marketing messages: <br>
                        Text '<span class="prox_bold">Stop</span>' to: <span class="prox_bold">68899</span></p>
                    <span class="bg-tnc">Terms & conditions</span>
                </div>
                <div class="locations-wrap">
                    <h1>No matter where you are or what you are doing, whether you are <br>  on the go or multitasking you can get a Psychic Reading! </h1>
                    <hr>
                    <h2>Our Psychics, Astrologers, Clairvoyants, Tarot Readers and Spiritual Advisors are waiting for your <br> text.</h2>
                    <br>
                    <p>Text-a-Psychic Services are Available in these locations.</p>
                    
                    <div class="row">
                        <div class="col-md-6 col-sm-3 col-xs-3">
                            <img src="/public_html/images/map-uk.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-6 col-sm-3 col-xs-3">
                            <img src="/public_html/images/map-us.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-6 col-sm-3 col-xs-3 hidden-md hidden-lg">
                            <img src="/public_html/images/map-ca.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-6 col-sm-3 col-xs-3 hidden-md hidden-lg">
                            <img src="/public_html/images/map-au.png" class="img-responsive" alt="">
                        </div>
                    </div>

                    <div class="row visible-md visible-lg">
                        <br>
                        <div class="col-md-6">
                            <img src="/public_html/images/map-ca.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-6">
                            <img src="/public_html/images/map-au.png" class="img-responsive" alt="">
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

</div>