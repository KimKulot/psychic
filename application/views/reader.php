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
                        <a href="/readers">Readers </a></li>
                    <li class="active"  ><?php echo $reader->username; ?></li>
                </ol>

                <h2 class="title">More info about <?php echo $reader->username; ?></h2>
                <div class="col-sm-4">
                        <p><img class="img-circle" src="/public_html/images/readers/slider/<?php echo strtolower($reader->username); ?>.png" class="img-responsive" alt=""></p>
                </div>
                <div class="col-sm-8" style="padding-left: 20px;">
                    <br/>
                    <p class="author"><span class="name">PIN: <?php echo $reader->pin; ?><br/><?php echo $reader->area; ?></span></p>
                </div>
                <p>&nbsp;</p>
                <div class="col-sm-12">
                    <?php echo str_replace('\r\n', "", $reader->profile); ?>
                </div>

                <div class="col-sm-12">
                    <section class="post-footer">
                        <div class="wrap-readmore">
                            <div class="wrap">
                                <a href="/readers" class="btn btn-primary pull-right">Back to Readers' Page</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- end article -->
            <div class="col-md-4 sidebar">
                <div class="hotline-wrap">
                    <p class="hotline">Text <span class="txt-yellow">"Psychics"</span> <span class="plus">+</span> Your Questions to:  <span class="txt-yellow number">68899</span></p>
                    <p><img src="/public_html/images/price.png" alt=""></p>
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

