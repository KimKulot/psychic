<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Modify Account
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Modify Account</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">

			<form id="edit_member_form" class="edit_form" action="/members/update" method="POST" enctype="multipart/form-data" style="margin:0;padding:0;">     
				<div class="col-md-6">      
			        <div class="form-group">
			        	<label for="id">#</label>
					 	<input type="hidden" class="form-control" name="id" value="<?= $member_data['0']['id']; ?>" class="tb"><?= $member_data['0']['id']; ?></td>
					</div> 

					<div class="form-group">
			        	<label for="first_name">First name</label>
						<input type="text" class="form-control" name="first_name" value="<?= $member_data['0']['first_name'];?>" class="tb" size="50" required>
					</div>

					<div class="form-group">
			        	<label for="last_name">Last Name</label>
						<input type="text" class="form-control" name="last_name" value="<?= $member_data['0']['last_name'];?>" class="tb" size="50" required>
					</div>		

					<div class="form-group">
			        	<label for="username">Username</label>
						<input type="text" class="form-control" name="username" value="<?= $member_data['0']['username'];?>" class="tb" size="50" required>
					</div>

					<div class="form-group">
			        	<label for="password">Password</label>
			        	<input type="password" class="form-control" name="password" class="tb" size="50">
					</div>

					<div class="form-group">
			        	<label for="confirm_password">Confirm Password</label>
			        	<input type="password" class="form-control" name="password" class="tb" size="50">
					</div>					
				</div>
				<div class="col-md-6">
					<br><br>	
					<div class="form-group">
			        	<label for="mobile_number">Mobile Number</label>
			        	<input type="number" class="form-control" name="mobile_number" value="<?= $member_data['0']['mobile_number'];?>" class="tb" size="50" required>
					</div>

					<div class="form-group">
			        	<label for="email">Email</label>
			        	<input type="email" class="form-control" name="email" value="<?= $member_data['0']['email'];?>" class="tb" size="50" required>
			       	</div>

			       	<div class="form-group">
						<label for="gender">Gender</label>
						<select name="gender" class="form-control" class="tb">
		                    <option>Male</option>
		                    <option>Female</option>
		                </select>
			        </div>
							
					<div class="form-group">
			        	<label for="dob">Date of Birth</label>
			        	<input type="date" class="form-control" name="dob" value="<?= $member_data['0']['dob'];?>" class="tb" size="50" required>
					</div>

					<div class="form-group country_select">
			        	<label for="country">Country</label>
			        	<label for="country">Country <span class="text-danger">*</span></label>
	                    <select name="country" class="form-control" placeholder="Country" required>
	                        <option value="us">us</option>
	                        <option value="ca">ca</option>
	                    </select>
					</div>
				</div>			
			</form>
		</div>
		<div class="box-footer">
			<input type="submit" value="Save" form="edit_member_form" class="btn btn-info pull-right">
		</div>
	</div>
</section>

<script type="text/javascript">
	var country = "<?= $member_data['0']['country'];?>";
	$("div.country_select select").val(country);
</script>
