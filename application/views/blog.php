 <div class="banner-blog">
    <div class="container">
        <img src="/public_html/images/banner-blog.jpg" class="img-responsive" alt="">
    </div>
</div>


        <div class="container">

            <div class="row">
                <div class="col-md-8 content-main  blog">
                    <ol class="breadcrumb">
                        <li>
                            <!--<span class="glyphicon glyphicon-menu-right" ></span>-->
                            <a href="#">Blog</a></li>
                        <li class="active"  ><?php echo $blog[0]['title']; ?></li>
                    </ol>
                    <h2 class="title"><?php echo $blog[0]['title']; ?></h2>
                    <p class="author">By: <span class="name">Jayson Lynn</span> / <span class="date"><?php echo $blog[0]['date']; ?></span></p>

                    <!--
                    <section class="post-footer">
                        <div class="social">
                            <div class="wrap">
                                <img src="public_html/images/socials.png" class="img-responsive"  alt="">
                            </div>
                        </div>
                        <div class="count-comments">
                            <div class="wrap">
                                <a href="#">1 Comments</a>
                            </div>
                        </div>
                        <div class="wrap-readmore">
                            <div class="wrap">
                                <a href="#" class="btn btn-primary pull-right">next</a>
                            </div>
                        </div>
                    </section>
                    -->

                    <?php echo $blog[0]['content']; ?>

                    <!--
                    <div class="media media-author">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="public_html/images/img-profile.jpg" alt="...">
                            </a>
                        </div>
                        
                        <div class="media-body">
                            <h4 class="media-heading">About Jayson</h4>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto. Sed ut laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi </p>
                        </div>
                    </div>
                    -->

                    <!--
                    <section class="comment-section">
                        <div class="comment-count">1 comment</div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 14%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                        <img src="public_html/images/toolbar-comment.png" alt="" class="img-responsive">
                        <div class="media media-comment-form">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="public_html/images/comment-ava.png" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <textarea class="form-control" rows="1" placeholder="Join the Discussion..."></textarea>
                            </div>
                        </div>
                        <div class="media media-comment">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="public_html/images/comment-ava.png" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="commenter">Romelmar <span class="tm">1 hour ago</span> </div>
                                <p class="comment-content">Brilliant article. Splendid!</p>
                                <p class="reply-share"><img src="public_html/images/reply-share.png" alt=""></p>
                            </div>
                        </div>
                    </section>
                    -->

                </div>
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

                    <div class="recent-articles">
                        <h4>Recent Articles</h4>

                        <?php foreach($blogs as $blog) { ?>
                        <div class="media">
                            <!--
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="public_html/images/thumb1.jpg" alt="...">
                                </a>
                            </div>
                            -->
                            <div class="media-body">
                                <!--<h4 class="media-heading">Jayson Lynn</h4>-->
                                <p><a href="/blog/<?php echo $blog['id'];?>"><?php echo $blog['title']; ?></a></p>
                            </div>
                        </div>

                        <?php 
                        }
                        ?>
                        
                        
                    </div>
                </div>
            </div>

        </div>