<?php
require('connection.inc.php');
require('functions.inc.php');
$coupon_str=get_safe_value($con,$_POST['coupon_str']);
$res=mysqli_query($con,"select * from coupon_master where coupon_code='$coupon_str' and status='1'");
$count=mysqli_num_rows($res);
$jsonArr=array();
$cart_total=0;
$cart_total_price=0;
$cart_total_final=0;
if (isset($_SESSION['COUPON_ID'])) {
         unset($_SESSION['COUPON_ID']);
         unset($_SESSION['COUPON_VALUE']);
         unset($_SESSION['COUPON_VALUE']);
      }
 foreach($_SESSION['cart'] as $key=>$val){
 $productArr=get_product($con,'','',$key);
 $mrp=$productArr[0]['mrp'];
 $price=$productArr[0]['price'];
 $gift_offer=$productArr[0]['gift_offer'];
 $qty=$val['qty'];

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

if ($count>0) {
	$row=mysqli_fetch_assoc($res);
	$coupon_id=$row['id'];
	$coupon_value=$row['coupon_value'];
	$coupon_type=$row['coupon_type'];
	$coupon_min_value=$row['coupon_min_value'];

if ($coupon_min_value>$cart_total) {
	$jsonArr=array('is_error'=>'yes','result'=>$cart_total,'dd'=>'Cart value apply must be'.$coupon_min_value);
}else{
		if ($coupon_type=='Rupee') {
			 $final_price=$cart_total-$coupon_value;
		}else{
			$final_price=ceil($cart_total-($cart_total*$coupon_value/100));
		}
					//dd means discount
		$dd=ceil($cart_total-$final_price);
		$_SESSION['COUPON_ID']=$coupon_id;
		$_SESSION['FINAL_PRICE']=$final_price;
		$_SESSION['COUPON_VALUE']=$dd;
		$_SESSION['COUPON_CODE']=$coupon_str;
	$jsonArr=array('is_error'=>'no','result'=>$final_price,'dd'=>$dd);
}
}else{
		$jsonArr=array('is_error'=>'yes','result'=>$cart_total,'dd'=>'Coupon Code Not Found');
}
echo json_encode($jsonArr);

?>