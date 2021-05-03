<?php
require('connection.inc.php');
$current_password=$_POST['current_password'];
$new_password=$_POST['new_password'];
   
  
      $uid=$_SESSION['USER_ID'];
$row=mysqli_fetch_assoc(mysqli_query($con,"select password from users where id='$uid'"));
if ($row['password']!=$current_password) {
   echo "please Enter valid Current Password";
}else{
     $update_pass="update users set password='$new_password' where id='$uid'";
   $query_run=mysqli_query($con,$update_pass);
     echo "Your Password Has been Updated!";
}

?>