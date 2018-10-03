<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Received SMS
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Received SMS</a></li>
  </ol>
</section>
<!-- Main content -->

<section class="content">
	<div class="box">
		<div style="background:#EFECE5;padding:5px 5px 5px 15px;border-bottom:solid 1px #BBB;"><?= count($sms_receiveds);?> Record(s) Found</div>

		<div class="box-body table-responsive no-padding">
            <table class="table table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Your Message</th>
						<th>Respond Message</th>
						<th>Psychic name</th>
						<th>Psychic pin</th>
						<th>Date sent</th>
					</tr>
				</thead>
				<tbody>
					<?php $id_count = 1; ?>
					<?php foreach ($sms_receiveds as $sms_received): ?>
						<tr>
							<td><?= $id_count++;?></td>
							<td><?= $sms_received['message_inbound'];?></td>
							<td><?= $sms_received['message'];?></td>
							<td><?= isset($sms_received['fname'])? $sms_received['fname'] : '' ?> <?=isset($sms_received['mname'])? $sms_received['mname'] : ''?> <?= isset($sms_received['lname'])? $sms_received['lname'] : '';?></td>
							<td><?= isset($sms_received['pin'])? $sms_received['pin']: '';?></td>
							<td><?= $sms_received['sent_at']? $sms_received['sent_at'] : '';?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div> 	
</section>