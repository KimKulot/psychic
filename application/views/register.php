<?php 
    if($this->session->flashdata('error')) echo '<div class=\'errors\'>'.$this->session->flashdata('error').'</div>';
    if($this->session->flashdata('response')) echo '<div class=\'responses\'>'.$this->session->flashdata('response').'</div>'; 
?>

<style type="text/css">
    .text-danger { 
        color: red;
    }
    .callout {
        background-color: #fa9a9a;
        padding: 10px 10px 10px 50px;
        margin: 0px 30px 0px 30px;
    }
</style>
<div id="pop-up" class="callout callout-warning" hidden="true">
    successfully send
</div>
<section class="works  js-active-line-fourth" id="work">
    <div class="container">
        <h2 class="underline  js-g-line">Register</h2>
        <form name="register" class="register-form">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="first_name">First name  <span class="text-danger"> <span class="text-danger">*</span></span></label>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                </div>
                <div class="col-md-6">
                    <label for="last_name">Last name  <span class="text-danger">*</span></label>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                </div>
            </div>
            <br><br><br>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="username">Username  <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="col-md-6">
                    <label for="email">Email  <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="test@gmail.com" required>
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Password"  id="password" required>
                </div>
                <div class="col-md-6">
                    <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" required>
                </div>
                
            </div>
            <br><br>  
            <div class="form-group">
                <div class="col-md-6">
                    <label for="gender">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-control">
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
                </div>                
                <div class="col-md-6">
                    <label for="country">Country <span class="text-danger">*</span></label>
                    <select name="country" class="form-control" placeholder="Country" required>
                        <option value="us">us</option>
                        <option value="ca">ca</option>
                    </select>
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="mobile_number">Mobile Number <span class="text-danger">*</span></label>
                    <input type="number" name="mobile_number" class="form-control" placeholder="Mobile number" required>
                </div>
                <div class="col-md-6">  
                    <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                    <input type="text" id="datepicker" class="form-control" onclick="date_of_birth()" readonly="readonly" required> 
                </div>
            </div>
            <br><br><br>
            <div class="form-group col-md-12">
                <div class="form-group col-md-2 pull-right">
                    <br>
                    <button type="submit" class="btn btn-default navbar-btn inline-block ">Submit</button>
                </div>
            </div>
            <br><br><br>
            <div id="register-text" hidden="true" class="pull-right" style="margin:14px 12px 0px 0px;"></div>
            <small class="register-text label"></small>
        </form>
    </div>
</section>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<section class="works  js-active-line-fourth" id="work">
    <div class="container">
        
        <h2 class="underline  js-g-line">How does it work?</h2>
        <div class="works__bloks display-flex flex-between">
            <div class="works__block">
                <h5>FIND A RIGHT ADVISOR</h5>
                <p>Our psychic advisors can help provide guidance and clarity in love, relationship, career and more. No
                    matter what's on your mind, you deserve to get the advice.</p>
            </div>
            <div class="works__block">
                <h5>SEND A MESSAGE</h5>
                <p>Type in Physics and then your question.Text it the shortcode in your country. Note: Maximum 150
                    characters per question sent.</p>
            </div>
            <div class="works__block">
                <h5>GET THE ANSWER</h5>
                <p>Your Physic will send the answer that provides insights to help you unlock clarity amid uncertainty
                    within minutes.</p>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var password = document.getElementById("password")
          , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
<script src="/public_html/js/script.js"></script>
<script type="text/javascript">
    $(".register").addClass("hidden");
</script>

<script type="text/javascript" src="/public_html/js/jquery.min.js"></script>
<script src="/public_html/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function date_of_birth(){
        $('#ui-datepicker-div').show();
        $("div.ui-datepicker-header a.ui-datepicker-prev,div.ui-datepicker-header a.ui-datepicker-next").hide();
        $("select.ui-datepicker-year").on('change', function () {
            
            var data = $('#datepicker').val();
            var arr = data.split('/');
            var year = $('.ui-datepicker-year').val();
            $('#datepicker').val(arr[0] + '/' + arr[1] + '/' + year);
            $('#ui-datepicker-div').hide()

        });

        $("select.ui-datepicker-month").on('change', function () {
            var data = $('#datepicker').val();
            var arr = data.split('/');
            var month = parseInt($('.ui-datepicker-month').val()) + parseInt(1);
            $('#datepicker').val(month + '/' + arr[1] + '/' + arr[2]);
            $('#ui-datepicker-div').hide()

        });
    }

</script>

<script>
$( function() {
    $( "#datepicker" ).datepicker({
        changeYear: true, 
        changeMonth: true,
        yearRange: "1920:2000"
    }).datepicker("setDate", "12/31/2000");
} );
</script>
<script type="text/javascript">
    // $("#pop-up").show().addClass('errors').text("Error, this is error");
    // $(".success").show().addClass('errors').text("Registered Successfully, Please Check your email inbox and verify your account!");
</script>
<script type="text/javascript">
    $(document).on('submit', 'form[name="register"]', function (e) {
        e.preventDefault();
        
        var $ele = $(this);
        $ele.find('[type="submit"]').addClass('disabled');
        $("#register-text").show().text("Register ...");
        $.post('//' + window.location.hostname + '/member_api/register', $(this).serialize(), function (response) {
            if (!response.success) {
                for (var key in response.errors) {
                    $ele.find('.signin-text').removeClass('default').addClass('error').html(response.errors[key]);
                }
                $("#register-text").hide();
                $("#pop-up").show().addClass('errors').text("Error, " + response.errors['error']).delay(10000).fadeOut();
            } else {
                $("#register-text").hide();
                // $("#register-modal").modal("hide");
                $(".success").show().addClass('errors').text("Registered Successfully, Please Check your email inbox and verify your account!").delay(20000).fadeOut();
                document.register.reset();
                $("#pop-up").hide();
            }
            $ele.find('[type="submit"]').removeClass('disabled');
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });

    });
</script>

