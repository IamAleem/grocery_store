<?php
include('../vendor/autoload.php');
require('connection.inc.php');
require('functions.inc.php');
$order_id=get_safe_value($con,$_GET['id']);
if(!isset($_SESSION['ADMIN_LOGIN'])){
    die();
}
$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value from order_product where id='$order_id'"));
$coupon_value=$coupon_details['coupon_value'];
$css=file_get_contents('../css/bootstrap.min.css');
$css.=file_get_contents('../style.css');

$html='<div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
												<th class="product-thumbnail">Product Image</th>
                                                <th class="product-name">Qty</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-price">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

   $uid=$_SESSION['USER_ID'];
	$res=mysqli_query($con,
        "select distinct(order_details.id),order_details.*,product.name,product.image from order_details,product ,order_product where order_details.order_id='$order_id' and order_product.user_id='$uid' and order_details.product_id=product.id
");
		$total_price=0;                                   
		while($row=mysqli_fetch_assoc($res)){
		$total_price=$total_price+($row['qty']*$row['price']);
		$pp=$row['qty']*$row['price'];
       $html.='	       <tr>
			<td class="product-name">'.$row['name'].'</td>
             <td class="product-name"> 
             <img src="'.PRODUCT_IMAGE_SITE_PATH.$row['image'].'" class="image-responsive" width="100" height="100"></td>
	<td class="product-name">'.$row['qty'].'</td>
		<td class="product-name">'.$row['price'].'</td>
	<td class="product-name">'.$pp.'</td>
                                                
                           </tr>';
                                }

	                            
                             if ($coupon_value!='') {
                                            
                                
                        $html.='<tr>
                         <td colspan="3"></td>
                        <td class="product-name">Coupon Value</td>
                        <td class="product-name">
                            '.$coupon_details['coupon_value'].'';                        
                            
                           $html.='</td>
                                                </tr>
                                                <tr>
                                                 <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name">
                                                '.$total_price-$coupon_details['coupon_value'].'';
                                                    $html.='</td>
                                                </tr>';
                                             }else{
                                                $html.='</tr>
                                                <tr>
                                                 <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name">
                                                     '.$total_price.'';
                                                     $html.='</td>';
                                                 }
                                            $html.='</tr>
                                        </tbody>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
$mpdf= new \Mpdf\Mpdf();
$mpdf->writeHtml($css,1);
$mpdf->writeHtml($html,2);
$file=time().'.pdf';
$mpdf->output($file,'D');

?>
    

        
        						
