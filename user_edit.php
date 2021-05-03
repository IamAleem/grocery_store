<?php
require 'top.php';
if (isset($_POST['update'])) {
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $added_on=date('y-m-d h:i:s');
  
$uid=$_SESSION['USER_ID'];
      $update_user="update users set name='$name',mobile='$mobile',email='$email',added_on='$added_on' where id='$uid'";
   $query_run=mysqli_query($con,$update_user);
  
if ($query_run) {
      
        echo "<script>alert('Thanks for Update Profile!')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }else{
        echo "<script>alert('Something wrong please')</script>";

    }

}
?>
  
     <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner5.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" style="color:#fff" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right" style="color:orange"></i></span>
                                  <span class="breadcrumb-item active" style="color:orange">Profile Update</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
					<div class="row">
				
					<div class="col-lg-6 ">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Update Profile</h2>
								</div>
							</div>
							<?php
                            $_uid=$_SESSION['USER_ID'];
                            $user="select * from users where id='$uid'";
                            $run_user=mysqli_query($con,$user);
                            $row=mysqli_fetch_array($run_user);
                            $name=$row['name'];
                            $mobile=$row['mobile'];
                            $email=$row['email'];                   
                              ?>
							<div class="col-xs-12">
								<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" value="<?php echo $name?>" placeholder="Your Name*" style="width:100%">
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="email" value="<?php echo $email?>"  placeholder="Your Email*" style="width:100%">
										</div>
									</div>
                                    <br>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="mobile" value="<?php echo $mobile?>" placeholder="Your Mobile*" style="width:100%">
										</div>
									</div>
									
								<div class="contact-btn">
										<button type="submit" name="update"  class="fv-btn">Update Profile</button>
									</div>
								</form>
								
							</div>
						</div> 
                </div>
                    <div class="col-lg-6 ">
                        <div class="contact-form-wrap mt--60">
                            <div class="col-xs-12">
                                <div class="contact-title">
                                    <h2 class="title__line--6">Change Password</h2>
                                </div>
                            </div>
                          
        <div class="col-xs-12">
            
            <span class="text-warning" id="password_success"></span>
        
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="password" name="current_password" id="current_password" value="" placeholder="Old password*" style="width:100%">
                                        </div>
                             <span class="failed_error text-danger" id="current_password_error"></span>               
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="password" name="new_password" id="new_password" value=""  placeholder="New Password*" style="width:100%">
                                        </div>
                                        <span class="failed_error text-danger" id="new_password_error"></span>
                                    </div>
                                    <br>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="password" name="confirm_new_password" id="confirm_new_password" value="" placeholder="Confirm New Password*" style="width:100%">
                                        </div>
                                        <span class="failed_error text-danger" id="confirm_new_password_error"></span>
                                    </div>
                                    
                                <div class="contact-btn">
                                        <button type="button" class="fv-btn" onclick="update_password()">Update Password</button>
                                    </div>
                                    
                                </form>
                                
                            </div>
                        </div> 
                </div>
									
            </div>
        </section>
        <!-- End Contact Area -->
        <!-- End Banner Area -->

        <?php
		require 'footer.php';
		?>
	  <script>
            function update_password(){
               jQuery('.failed_error').html('');
        
               var current_password=jQuery('#current_password').val();
               var new_password=jQuery('#new_password').val();
               var confirm_new_password=jQuery('#confirm_new_password').val();

                var is_error='';
                if (current_password=='') {
                    jQuery('#current_password_error').html('Please enter Current Password');
                    is_error='yes';
                }
                if (new_password=='') {
                    jQuery('#new_password_error').html('Please Enter New Password');
                    is_error='yes';
                }
                if (confirm_new_password=='') {
                    jQuery('#confirm_new_password_error').html('Please Enter Confirm Password');
                    is_error='yes';
                }
                if (new_password!='' && confirm_new_password!='' && new_password!=confirm_new_password) {
                     jQuery('#confirm_new_password_error').html('Please Enter Same Password');
                    is_error='yes';
                }
                if (is_error=='') {
                    jQuery.ajax({
                        url:'update_password.php',
                        type:'post',
                        data:'current_password='+current_password+'&new_password='+new_password,
                        success:function(result){
                            jQuery('#password_success').html(result);
                        }
                    })
                }
            }
        </script>