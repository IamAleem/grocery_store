<?php
require('top.inc.php');
$order_id=get_safe_value($con,$_GET['id']);
if (isset($_POST['update_order_status'])) {
    $update_order_status=$_POST['update_order_status'];
    mysqli_query($con,"update order_product set order_status='$update_order_status' where id='$order_id'");

}

$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value,coupon_code from order_product where id='$order_id'"));
$coupon_value=$coupon_details['coupon_value'];
$coupon_code=$coupon_details['coupon_code'];
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Detail </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
                                            <tr>
                                                
                                                <th class="product-name"><span class="nobr">Product Name</span></th>
                                                <th class="product-thumbnail">Product Image</th>
                                                <th class="product-price"><span class="nobr">Price</span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Qty</span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Total Price</span></th>
                                              
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
//$whishlist="select distinct(order_details.id),order_details.*,product.name,product.image,order_product.address,order_product.city,order_product.pincode from order_details,product,order_product where order_details.order_id='$order_id' and order_details.product_id=product.id";
$run_whishlist=mysqli_query($con,
        "select distinct(order_details.id),order_details.*,product.name,product.image from order_details,product ,order_product where order_details.order_id='$order_id' and order_details.product_id=product.id");
//$run_whishlist=mysqli_query($con,$whishlist);
$total_price=0;
while ($row=mysqli_fetch_assoc($run_whishlist)) {
   
    $total_price=$total_price+($row['qty']*$row['price']);
                                            ?>
                                <tr>
                                    <td class="product-add-to-cart"><?php echo $row['name']?></td>
                                    <td class="product-thumbnail"> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
                                    <td class="product-name"><?php echo $row['price']?></td>
                                    <td class="product-name"><?php echo $row['qty']?></td>
                                    <td class="product-name"><?php echo $row['qty']* $row['price']?></td>                                             
                                </tr>
                               
                                <?php }
                             if ($coupon_value!='') {
                                            
                                ?>
                                          <tr>
                         <td colspan="3"></td>
                        <td class="product-name">Coupon Value</td>
                        <td class="product-name">
                           <?php echo $coupon_value." ($coupon_code)"?></td>
                                                </tr>
                                                <tr>
                                                 <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name">
                                                    <?php echo $total_price-$coupon_value;?></td>
                                                </tr>
                                            <?php }else{?>
                                                </tr>
                                                <tr>
                                                 <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name">
                                                    <?php echo $total_price;?></td>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                        
					  </table>
                      <div id="address_details" class="ml-4">
                        <?php
 $order_product_details=mysqli_query($con,"select * from order_product where id='$order_id'");         $row=mysqli_fetch_assoc($order_product_details);            
                      $address=$row['address'];
                      $city=$row['city'];
                      $pincode=$row['pincode'];
                          
                       ?>
                          <strong>Address:-</strong>
                          <?php echo $address?>,
                          <?php echo $city?>,
                          <?php echo $pincode?>
                       
                          <br><br>
                          <strong>Order Status:-</strong>
                          <?php 
                          $order_status_str=mysqli_fetch_assoc(mysqli_query($con,"select order_status.name from order_status,order_product where order_product.id='$order_id' and order_product.order_status=order_status.id"));
                          echo $order_status_str['name'];
                          ?>

                          <div>
                             <form method="post">
                                <label>Update Status</label>
                                  <select class="form-control col-6" name="update_order_status">
                                        <option>Select Status</option>
                                        <?php
                                        $res=mysqli_query($con,"select * from order_status");
                                        while($row=mysqli_fetch_assoc($res)){
                                            if($row['id']==$categories_id){
                                                echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            }
                                            
                                        }
                                        ?>
                                    </select><br>
                                    <input type="submit" name="submit" value="Status Update" class="form-control btn btn-success col-6"><br> 
                             </form>
                             <br><br>
                          </div>
                      </div>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>