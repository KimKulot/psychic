<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Authorize.net Payment
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Authorize.net Payment</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-body">
      <form method="post" action="/members/push_payment" id="authorize_form">
        <div class="col-md-6">
          <h3>Customer Information</h3>
          <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" required>
          </div>    
          <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
          </div>
          <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
          </div>

          <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" required>
          </div>

          <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" required>
          </div>

          <div class="form-group">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter zip code" required>
          </div>

          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
          </div>
        </div>
        <div class="col-md-6"> 
          <h3>Credit Card Information</h3>  
          <div class="form-group">
            <label for="cnumber">Card Number</label>
            <input type="text" class="form-control" id="cnumber" name="cnumber" placeholder="Enter Card Number" required>
          </div>
          <div class="form-group">
            <label for="cexpdate">Expiration Date</label>
            <input type="text" class="form-control" id="cexpdate" name="cexpdate" placeholder="Enter Expiration Date" required>
          </div>
          <div class="form-group">
            <label for="ccode">Card Code</label>
            <input type="text" class="form-control" id="ccode" name="ccode" placeholder="Enter Card Code" required>
          </div>
          <div class="form-group">
            <label for="cdesc">Description</label>
            <input type="text" class="form-control" id="cdesc" name="cdesc" placeholder="Enter Description" required>
          </div>
          <!-- <div class="form-group">
            <label for="value">Packages</label> -->
          <input type="hidden" name="id" value="<?= $package_id;?>">
          <!-- </div> -->
        </div>
        <br>  
      </form>
    </div>
    <div class="box-footer">
      <input type="submit" value="Submit" form="authorize_form" class="btn btn-info pull-right">
    </div>
  </div> 
</section>
