<?php 
   require('top.php');
  if(empty($_SESSION['cart'])){
echo "<script>
   window.location.href='index.php';
   </script>";
  }


   $cart_total=0;
   $cart_total_price=0;
$cart_total_final=0;
   if(isset($_POST['submit'])){
   	$address=get_safe_value($con,$_POST['address']);
   	$city=get_safe_value($con,$_POST['city']);
   	$pincode=get_safe_value($con,$_POST['pincode']);
   	$payment_type=get_safe_value($con,$_POST['payment_type']);
   	$user_id=$_SESSION['USER_ID'];
   	foreach($_SESSION['cart'] as $key=>$val){
   		$productArr=get_product($con,'','',$key);
   		$price=$productArr[0]['price'];
          $mrp=$productArr[0]['mrp'];
         $gift_offer=$productArr[0]['gift_offer'];
   		$qty=$val['qty'];
   		//$cart_total=$cart_total+($price*$qty);
          if ($gift_offer==0) {
  
$cart_total_price=$cart_total_price+($price*$qty);
        }else if($gift_offer>1){
        $per_price=ceil($mrp*$gift_offer/100);
        $final_price=$mrp-$per_price;

         $cart_total_final=$cart_total_final+($final_price*$qty);
     }
     $cart_total_pre= $cart_total_price+$cart_total_final;
     $cart_total=$cart_total_pre;

}
   	$total_price=$cart_total;
   	$payment_status='pending';
   	if($payment_type=='COD'){
   		$payment_status='success';
   	}
   	$order_status='1';
   	$added_on=date('Y-m-d h:i:s');
      if (isset($_SESSION['COUPON_ID'])) {
         $coupon_id=$_SESSION['COUPON_ID'];
         $coupon_value=$_SESSION['COUPON_VALUE'];
         $total_price=$total_price-$coupon_value;
         $coupon_code=$_SESSION['COUPON_CODE'];
         // unset($_SESSION['COUPON_ID']);
         // unset($_SESSION['COUPON_VALUE']);
         // unset($_SESSION['COUPON_CODE']);
      }else{
         $coupon_id='';
         $coupon_value='';
         $coupon_code='';
      }
      
   		
   	
   mysqli_query($con,"insert into order_product(user_id,address,city,pincode,payment_type,payment_status,order_status,coupon_id,coupon_value,coupon_code,added_on,total_price) values('$user_id','$address','$city','$pincode','$payment_type','$payment_status','$order_status','$coupon_id','$coupon_value','$coupon_code','$added_on','$total_price')");

   	$order_id=mysqli_insert_id($con);
   	$cart_item=$_SESSION['cart'];
   	foreach($cart_item as $key=>$val){
   		$productArr=get_product($con,'','',$key);
   		$price=$productArr[0]['price'];
   		$qty=$val['qty'];
   		
   			$order_product=mysqli_query($con,"insert into order_details(order_id,product_id,qty,price) values('$order_id','".$key."','".$qty."','".$price."')");

            
            }

            unset($_SESSION['cart']);
   			if ($order_product) {
   		 echo "<script>alert('Your Order Has been Successfully')</script>";
   		 echo "<script>window.open('thank_you.php','_SELF')</script>";
            sentInvoice($con,$order_id);

   	}else{ 
   		 echo "<script>alert('Wrong')</script>";
   	}
   	
   	

   	
   	
   }
   ?>
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner1.jpg) no-repeat scroll center center / cover ;">
   <div class="ht__bradcaump__wrap">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="bradcaump__inner">
                  <nav class="bradcaump-inner">
                     <a class="breadcrumb-item text-white" style="color: white" href="index.php">Home</a>
                     <span class="brd-separetor"><i class="zmdi zmdi-chevron-right" style="color:orange"></i></span>
                     <span class="breadcrumb-item active" style="color:orange">checkout</span>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="checkout__inner">
               <div class="accordion-list">
                  <div class="accordion">
                     <?php 
                        $accordion_class='accordion__title';
                        if(!isset($_SESSION['USER_LOGIN'])){
                        $accordion_class='accordion__hide';
                        ?>
                     <div class="accordion__title">
                        Checkout Method
                     </div>
                     <div class="accordion__body">
                        <div class="accordion__body__form">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="checkout-method__login">
                                    <form id="login-form" method="post">
                                       <h5 class="checkout-method__title">Login</h5>
                                       <div class="single-input">
                                          <input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                          <span class="field_error" id="login_email_error"></span>
                                       </div>
                                       <div class="single-input">
                                          <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                          <span class="field_error" id="login_password_error"></span>
                                       </div>
                                       <p class="require">* Required fields</p>
                                       <div class="dark-btn">
                                          <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                       </div>
                                       <div class="form-output login_msg">
                                          <p class="form-messege field_error"></p>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="checkout-method__login">
                                    <form action="#">
                                       <h5 class="checkout-method__title">Register</h5>
                                       <div class="single-input">
                                          <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                          <span class="field_error" id="name_error"></span>
                                       </div>
                                       <div class="single-input">
                                          <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                          <span class="field_error" id="email_error"></span>
                                       </div>
                                       <div class="single-input">
                                          <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
                                          <span class="field_error" id="mobile_error"></span>
                                       </div>
                                       <div class="single-input">
                                          <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                          <span class="field_error" id="password_error"></span>
                                       </div>
                                       <div class="dark-btn">
                                          <button type="button" class="fv-btn" onclick="user_register()">Register</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                     <div class="<?php echo $accordion_class?>" id="accordion__title">
                        Address Information
                     </div>
                     <form method="post">
                        <div class="accordion__body" id="accordion__body">
                           <div class="bilinfo">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="single-input">
                                       <input type="text" name="address" placeholder="Street Address" required>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="single-input">
                                       <input type="text" name="city" placeholder="City/State" required>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="single-input">
                                       <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="<?php echo $accordion_class?>" id="accordion__title_p">
                           payment information
                        </div>
                        <div class="accordion__body" id="accordion__body_p">
                           <div class="paymentinfo">
                              <div class="single-method">
                                 COD <input type="radio" name="payment_type" value="COD" required/>
                                 &nbsp;&nbsp;Debit Card <input type="radio" name="payment_type" value="Debit Card"/>
                                 <br>
                                 <p>If your purches Debit/Credit Card,Please Send order amount blew account number</p>
                                <span>2345-345323-2342</span> 
                              </div>
                              <div class="single-method">
                              </div>
                           </div>
                        </div>
                        <input type="submit" class="fv-btn" name="submit"/>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="order-details">
               <h5 class="order-details__title">Your Order</h5>
               <div class="order-details__item">
                  <?php
                  
                    $cart_total_price=0;
                      $cart_total_final=0;
                        foreach($_SESSION['cart'] as $key=>$val){
                        $productArr=get_product($con,'','',$key);
                        $pid=$productArr[0]['id'];
                        $pname=$productArr[0]['name'];
                        $mrp=$productArr[0]['mrp'];
                        $price=$productArr[0]['price'];
                        $gift_offer=$productArr[0]['gift_offer'];
                        $image=$productArr[0]['image'];
                        $qty=$val['qty'];
                        
                        ?>
                        <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"  />
                                    </div>
                                    <div class="single-item__content">
                                        <a href="product.php?id=<?php echo $pid?>"><?php echo $pname?></a>
                                        <span class="price">RS <?php
                                         
                                            if ($gift_offer==0) {
                                              echo $price*$qty;
                                              
                              $cart_total_price=$cart_total_price+($price*$qty);
                                            }else if($gift_offer>1){
                                            $per_price=ceil($mrp*$gift_offer/100);
                                            $final_price=$mrp-$per_price;
                                            echo $final_price*$qty;
                                           
                                             $cart_total_final=$cart_total_final+($final_price*$qty);
                                         }
                                
                                         ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
                                    </div>
                                </div>
                        <?php } ?>
                            </div>
                     <div class="ordre-details__total" id="coupon_box">
                                <h5>Coupon Value</h5>
                                <span class="price" id="coupon_price"></span>
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price" id="order_total_price">RS <?php 
                                         if ($gift_offer==0) {

                     echo  $cart_total_price +$cart_total_final;
                     }else if($gift_offer>1){

                     echo   $cart_total_price +$cart_total_final;
                     }  
                            ?></span>
                            </div>
               <div class="ordre-details__total" id="coupon_box">
                  <h5>Coupon Value</h5>
                  <span class="price" id="coupon_price"></span>
               </div>
               <div class=" bilinfo" style="margin: 30px;padding-bottom: 20px;">
                  <h5>Coupon Code</h5>
                  <div class="single-input">
                     <input type="text" name="coupon_str" id="coupon_str" placeholder="Coupon Code*"  style="width:66%;">
                     <span class="field_error" id="name_error"></span>
                  </div><br>
                  <input type="submit" value="Apply Coupon" onclick="set_coupon()" class="fv-btn" name="submit" style="width: 200px;height: 40px" />
                  
                  <div id="coupon_result" style="margin: 15px;"></div>
               </div>

              
            </div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   function set_coupon(){
      var coupon_str=jQuery('#coupon_str').val();
      if (coupon_str!='') {
         jQuery.ajax({
            url:'set_coupon.php',
            type:'post',
            data:'coupon_str='+coupon_str,
            success:function(result){
               jQuery('#coupon_result').html('');
               var data=jQuery.parseJSON(result);
            if (data.is_error=='yes') {
               jQuery('#coupon_box').hide();
               jQuery('#coupon_result').html(data.dd);
                jQuery('#order_total_price').html(data.result);
            }
            if (data.is_error=='no') {
               jQuery('#coupon_box').show();
               jQuery('#coupon_price').html(data.dd);
               jQuery('#order_total_price').html(data.result);
            }
            }
         });
      }
   }
</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $('document').ready(function(){
    $('#accordion__body').hide();
    $('#accordion__title').click(function(){
      $('#accordion__body').toggle();
    });

     $('#accordion__title_p').click(function(){
      $('#accordion__body_p').toggle();
    });
   
  });
</script>
<?php
if (isset($_SESSION['COUPON_ID'])) {
         unset($_SESSION['COUPON_ID']);
         unset($_SESSION['COUPON_VALUE']);
         unset($_SESSION['COUPON_VALUE']);
      }

 require('footer.php');?>