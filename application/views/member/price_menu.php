<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    SMS Pricing
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> SMS Pricing</a></li>
  </ol>
</section>
<!-- Main content -->

<section class="content">
    <div class="box">
    	<br><br>	
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
				                <div>
					                <a href="/members/fund_account/<?= $value['id'];?>">
					                	<img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal Logo" title="Pay using Paypal">
					                </a>
				                </div>
				                <hr>
				                <div>
					                <a href="/members/add_authorize_details/<?= $value['id'];?>">
					                	<img src="../public_html/images/authnet-logo.png" alt="Authorize.net Logo" width="100px" title="Pay using Authorize.net">
					                </a>
					            </div>
				            </div>
			            </div>
			        </div>
		        <?php endforeach ?>
	        </div>
	    </section>
 	</div>  
</section>