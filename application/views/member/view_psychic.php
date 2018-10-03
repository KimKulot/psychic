<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Online Reader
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Online Reader</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-block btn-primary pull-right col-xs-2" href="#" data-target="#send-sms-modal" data-toggle="modal"><i class="fa fa-fw fa-commenting"></i> &nbsp;Send SMS</a>
        </div>
        <div class="box-body">
        	<div class="container">
        		<div class="row">
                    <div class="content-main">

                        <h2 class="title">More info about <?php echo $psychic[0]['username']; ?></h2>
                        <div class="col-sm-8" style="padding-left: 20px; float: right;">
                            <br/>
                            <p class="author"><span class="name">PIN: <?php echo $psychic[0]['pin']; ?><br/><?php echo $psychic[0]['area']; ?></span></p>
                        </div>
                        <div class="col-sm-4">
                            <p><img class="img-circle" src="/public_html/images/readers/slider/<?php echo strtolower($psychic[0]['username']); ?>.png" class="img-responsive" alt="" height="15%" width="30%"></p>
                        </div>
                        
                        <p>&nbsp;</p>
                        <div class="col-sm-12">
                            <?php echo str_replace('\r\n', "", $psychic[0]['profile']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <section class="post-footer">
                        <div class="wrap-readmore">
                            <div class="wrap">
                                <a href="/members/psychics" class="btn btn-block btn-primary pull-right"><i class="fa fa-fw fa-arrow-circle-left"></i>&nbsp;Back to Pychic's Page</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <br><br>	
        </div>
    </div>  
</section>
<div id="send-sms-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4>Send SMS</h4>
            </div>
            <div id="pop-up" class="callout callout-warning" hidden="true">
                successfully send
            </div>
            <div class="modal-body">
                <ul>
                    <li>TYPE "PSYCHICS RANDOM < question >"</li>
                    <li>TYPE "PSYCHICS < pin > < question >"</li>
                    <li>TYPE "PSYCHICS < question >"</li>
                </ul>
                <form name="sendsms" id="send_sms_form">
                    <input type="" name="id" hidden="true" value="<?= $member['id'];?>">
                    <input type="" name="sender_mobile_num" hidden="true" value="<?= $member['mobile_number'];?>">
                    <input type="" name="mobile_number" hidden="true" value="<?= $psychic[0]['mobile_num'];?>">
                    <input type="" name="psychic_id" hidden="true" value="<?= $psychic[0]['id'];?>">
                    <input type="" name="random" hidden="true" value="0">
                    <div class="form-group">
                        <label for="mesage">Message</label>
                        <textarea name="message" class="form-control" placeholder="PSYCHICS Am I going to be lucky today?" value="PSYCHICS" style="min-height: 154px; min-width: 491px;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default navbar-btn inline-block" form="send_sms_form">Send</button>
                <small class="signin-text label"></small>
            </div>
        </div>
    </div>
</div> 


