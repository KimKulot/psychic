<style type="text/css">
    .bg-success {
        background-color: #dff0d8;
        margin: 0px 30px 0px 30px;
        padding: 10px;
    }
</style>
<?php 
    if($this->session->flashdata('error')) echo '<div class=\'errors text-danger\' style=\'background-color: #fa9a9a; margin: 0px 30px 0px 30px; padding: 10px;\'>'.$this->session->flashdata('error').'</div>';
    if($this->session->flashdata('response')) echo '<div class=\'responses text-success bg-sucess\' style=\'background-color: #dff0d8; margin: 0px 30px 0px 30px; padding: 10px;\'>'.$this->session->flashdata('response').'</div>';
?>
<section class="works  js-active-line-fourth" id="work">
    <div class="container">
        <h2 class="underline  js-g-line">Sign-in</h2>

                            <div class="sign-in">

                                <form name="signin">
                                    <div class="form-group col-md-12">
                                        <div class="col-md-6 col-md-offset-3">
                                            <label for="username">Username/Email</label>
                                            <input id="username" type="text" name="username" placeholder="Username/Email">
                                        </div>
                                     </div>
                                     <br><br><br>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" name="password" placeholder="Password">
                                        </div>
                                     </div>
                                    <br><br><br>                     
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-default navbar-btn inline-block">Sign in</button>
                                        </div>
                                    </div>
                                    <br><br><br>
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            <small class="signin-text label"></small>
                                        </div>
                                    </div>
                                    <br><br><br>
                                    
                                </form>

                            </div>
                            <h2 class="underline  js-g-line"><a href="<?php echo base_url(); ?>users/register" class="create">Create an account</a></h2>
                            <!-- User Register form -->
                    
                    


<!-- 
                    <div class="register">
                    <form name="register" class="register-form horizontal"> 
                        <h2 class="underline  js-g-line">Create an account</h2>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="first_name">First name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Last name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="test@gmail.com" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"  id="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="">- Select -</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" placeholder="dd/mm/yyyy" required>
                                </div>
                            </div>

                            <br><br>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="number" name="mobile_number" class="form-control" placeholder="Mobile number" required>
                                </div>
                                <div class="col-md-6">  
                                    <label for="country">Country</label>
                                    <select name="country" class="form-control" placeholder="Country" required>
                                        <option value="US">United States of America</option>
                                        <option value="CA">Canada</option>
                                    </select>   
                                </div>
                            </div>
                        
                        <button type="submit" class="btn btn-default navbar-btn inline-block pull-right">Submit</button>
                        </form>
                    </div> -->


    </div>
</section>

<section class="works  js-active-line-fourth" id="work">
    <div class="container">
        <br><br><br>
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
<script src="/public_html/js/script.js"></script>
<script type="text/javascript">
    $(".register").addClass("hidden");
</script>

    <script type="text/javascript" src="/public_html/js/jquery.min.js"></script>
    <script src="/public_html/js/bootstrap.min.js"></script>
    
    