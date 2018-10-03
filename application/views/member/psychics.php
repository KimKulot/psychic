<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Meet our Professional Readers!
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Online Readers</a></li>
  </ol>
</section>
<!-- Main content -->

<section class="content">
	<div class="box">
		<div style="background:#EFECE5;padding:5px 5px 5px 15px;border-bottom:solid 1px #BBB;"><?= count($psychics);?> Record(s) Found</div>

		<div class="box-body table-responsive no-padding">
            
					<?php foreach ($psychics as $psychic): ?>
						<?php 
							$area = strlen($psychic['area']) > 50 ? substr($psychic['area'],0,50)." ..." : $psychic['area'];
						 ?>
						<div class="col-md-4">
							<br>
						 	<div class="info-box">
					            <span class="info-box-icon" style="background:#ffffff !important;"><?php echo $psychic['profile_img'] != ''?  '<img class=\'img-rounded\' src=\'/public_html/images/readers/slider/' . $psychic['profile_img'] . '\'class=\'img-responsive\'height=\'100px\'>' : '<i class=\'fa fa-user\'></i>' ?>
					            </span>

					            <div class="info-box-content">
					              <span class="info-box-text"><?= $psychic['fname'] . ' ' . $psychic['mname'] . ' ' . $psychic['mname'];?></span>
					              <span class="info-box-number" style="min-height: 52px;"><?= $area;?></span>
					              <span class="info-box-number"><a href="/members/view_psychic/<?= $psychic['id']; ?>" class="btn btn-default btn-xs">Read Biography</a></span>
					            </div>
					            <div >
					            	<!-- <a href="/members/view_psychic/<?= $psychic['id']; ?>" class="btn btn-default btn-xs">OFFLINE <i class="fa fa-envelope-o"></i> -->
					            	<?php echo $psychic['status'] == 1?  '<a href=\'/members/view_psychic/' . $psychic['id'] . '\' class=\'btn btn-success btn-xs\' style=\'margin: 5px;\'>AVAILABLE FOR CHAT</i></a>' : '<a href=\'/members/view_psychic/' . $psychic['id'] . '\' class=\'btn btn-default btn-xs\' style=\'margin: 5px;\'>OFFLINE <i class="fa fa-envelope-o"></i></a>' ?>
					            </div>
					            <!-- /.info-box-content -->
					        </div>
					    </div>
					<?php endforeach ?>
		</div>
	</div> 	
</section>