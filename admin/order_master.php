<?php
require('top.inc.php');

?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Master </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table " id="myTable">
						 <thead>
                                            <tr>
                                                
                                                <th class="product-name"><span class="nobr">Order Id</span></th>
                                                <th class="product-price"><span class="nobr">Order Date</span></th>
                                                <th class="product-price"><span class="nobr">Address</span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Payment Type</span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Payment status</span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Order status</span></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$whishlist="select order_product.*,order_status.name as order_status_str from order_product,order_status where order_status.id=order_product.order_status";
            $run_whishlist=mysqli_query($con,$whishlist);
                                            while ($row=mysqli_fetch_assoc($run_whishlist)) {
                                            ?>
                                            <tr>
                                    <td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $row['id']?>"><?php echo $row['id']?>:View Order</a>
                                        <br>
              <a href="order_pdf.php?id=<?php echo $row['id']?>">Download Pdf</a>                          
                                    </td>
                                    <td class="product-name"><?php echo $row['added_on']?></td>
                                    <td class="product-name"><?php echo $row['address']?><br>
                                        <?php echo $row['city']?><br><?php echo $row['pincode']?></td>
                                    <td class="product-name"><?php echo $row['payment_type']?></td>
                                    <td class="product-name"><?php echo $row['payment_status']?></td>
                                    <td class="product-name"><?php echo $row['order_status_str']?></td>
                                             
                                             
                                            </tr>
                                            <?php

                                            }
                                            ?>
                                        </tbody>
                                        
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
});
</script>
<?php
require('footer.inc.php');
?>