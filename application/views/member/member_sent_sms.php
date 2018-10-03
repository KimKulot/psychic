<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sent SMS
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Sent SMS</a></li>
  </ol>
</section>
<!-- Main content -->

<section class="content">
	<div class="box">
		<div style="background:#EFECE5;padding:5px 5px 5px 15px;border-bottom:solid 1px #BBB;"><?= count($sms_sents);?> Record(s) Found</div>

		<div class="box-body table-responsive no-padding">
            <table class="table table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Message</th>
						<th>Psychic name</th>
						<th>Psychic pin</th>
						<th>Date sent</th>
					</tr>
				</thead>
				<tbody>
					<?php $id_count = 1; ?>
					<?php foreach ($sms_sents as $sms_sent): ?>
						<tr>
							<td><?= $id_count++;?></td>
							<td><?= $sms_sent['message'];?></td>
							<td><?= isset($sms_sent['fname'])? $sms_sent['fname'] : '' ?> <?=isset($sms_sent['mname'])? $sms_sent['mname'] : ''?> <?= isset($sms_sent['lname'])? $sms_sent['lname'] : '';?></td>
							<td><?= isset($sms_sent['pin'])? $sms_sent['pin']: '';?></td>
							<td><?= $sms_sent['sent_at']? $sms_sent['sent_at'] : '';?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div> 	
</section>