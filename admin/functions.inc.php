<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function ProductSoldQtyByProduct($con,$pid){
	$sql="select sum(order_details.qty) as qty from order_details,order_product where order_product.id=order_details.order_id and order_details.product_id=$pid and order_product.order_status!=4";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}


?>