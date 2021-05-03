<?php
require('top.inc.php');
$msg=''; 
$admin_id= $_SESSION['ADMIN_ID'];
	$select="select * from admin_users where id='$admin_id'";
	$run_query=mysqli_query($con,$select);
	$row=mysqli_fetch_array($run_query);
	$name=$row['name'];
	$email=$row['username'];
	$password=$row['password'];
if (isset($_POST['update'])) {
	$name=$_POST['name'];
	$email=mysqli_real_escape_string($con,$_POST['username']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$update_admin="update admin_users set name='$name',username='$email',password='$password' where id='$admin_id'";
	$run_query=mysqli_query($con,$update_admin);
	if ($run_query) {
		header('location:admin_profile.php');die();
	}else{
		$msg='Please Correct Details';
	}
}
?>

  <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Profile Update</strong><small> Form</small></div>
                        <div class="card-body card-block">
                          <form method="POST" action="">
                          	 <div class="form-group">
                           	<label for="name" class=" form-control-label">Admin Name</label>
                           	<input type="text" name="name" value="<?php echo $name?>" placeholder="Enter name" class="form-control">
                           </div>
                            <div class="form-group">
                           	<label for="email" class=" form-control-label">Admin Email</label>
                           	<input type="email" name="username" value="<?php echo $email?>" placeholder="Enter Email" class="form-control">
                           </div>
                            <div class="form-group">
                           	<label for="password" class=" form-control-label">Admin Password</label>
                           	<input type="text" name="password" value="<?php echo $password?>" placeholder="Enter Password" class="form-control">
                           </div>

                           <button id="payment-button" type="submit" name="update" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Update Profile</span>
                           </button>
                           <div class="field_error"><?php echo $msg;?></div>
                        </div>
                          </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

 <?php

 require('footer.inc.php');

      ?>
