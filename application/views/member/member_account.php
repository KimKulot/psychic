<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Account
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Account</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box">
        <div class="box-header with-border">
		    <a class="btn btn-block btn-primary pull-right col-xs-2" href="/members/price_menu"><i class="fa fa-fw fa-credit-card"></i> &nbsp;Fund Account</a>
        </div><br>
        <div class="box-body">
	        <div class="container">
				<div class="row">
		            <div class="col-md-8 content-main">
						    <div class="col-md-6 col-sm-6 col-xs-12">
						        <div class="info-box">
						            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

						            <div class="info-box-content">
						              <span class="info-box-text">REMAINING CREDITS</span>
						              <span class="info-box-number"><?= isset($member_balance[0]['credit'])? $member_balance[0]['credit'] : '0';?></span>
						            </div>
						            <!-- /.info-box-content -->
						        </div>
						        <!-- /.info-box -->
					        </div>
					        <div class="col-md-6 col-sm-6 col-xs-12">
						        <div class="info-box">
						            <span class="info-box-icon bg-red"><i class="fa fa-industry"></i></span>

						            <div class="info-box-content">
						              <span class="info-box-text">USED CREDITS</span>
						              <span class="info-box-number"><?= isset($member_balance[0]['used'])? round($member_balance[0]['used']) : '0';?></span>
						            </div>
						            <!-- /.info-box-content -->
						        </div>
						        <!-- /.info-box -->
					        </div>
		            </div>
		        </div>
		    </div>
        </div>
    </div>
	<!-- modal for funding account -->
	<div id="fund-account-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	    <div class="modal-dialog modal-md">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4>Fund Account</h4>
	            </div>
	            <div class="modal-body">
	                <form action="/members/fund_account" method="POST" id="fund_account_form" class="col-md-12">
	                	<label for="value">Packages</label>
	                    <select name="id">
	                    	<?php foreach ($packages as $key => $value): ?>
	                    		<option value="<?= $value['id'];?>"><?= $value['title'];?></option>
	                    	<?php endforeach ?>
	                    </select>
	                </form>
	            </div>
	            <div class="modal-footer">
	                <input type="submit" class="btn btn-default navbar-btn inline-block" form="fund_account_form" value="Pay">
	                <small class="signin-text label"></small>
	            </div>
	        </div>
	    </div>
	</div> 
</section>

