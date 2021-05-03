<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}

	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from product where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}
//$limit=6;
	
	//if (isset($_GET['page'])) {
	//	$page=$_GET['page'];
	//}else{
	//	$page=1;
	//}
	//$offset=($page-1)*$limit;
//LIMIT {$offset},{$limit}
$sql="select product.*,categories.categories from product,categories where product.categories_id=categories.id order by product.id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="manage_product.php">Add Product</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h my-3 px-3">
					  <table class="table table-responsive " id="myTable">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th width="2%">ID</th>
							   <th width="10%">Categories</th>
							   <th width="15%">Name</th>
							   <th width="10%">Image</th>
							   <th width="10%">Offer</th>
							   <th width="10%">MRP</th>
							   <th width="7%">Price</th>
							   <th width="7%">Qty</th>
							   <th width="26%" class="text-center">Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i++?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['categories']?></td>
							   <td ><?php echo $row['name']?></td>
							   <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"/></td>
							   <td><?php echo $row['gift_offer']?>% OFF</td>
							   <td><?php echo $row['mrp']?></td>
							   <td><?php echo $row['price']?></td>
							   <td><?php echo $row['qty']?><br/>
							   <?php
							   $ProductSoldQtyByProduct=ProductSoldQtyByProduct($con,$row['id']);
							   $pending_qty=$row['qty']-$ProductSoldQtyByProduct;
							   
							   ?>
							   Pqty <?php echo $pending_qty?>
							   
							   </td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<a href='?type=status&operation=deactive&id=".$row['id']."'><span class='badge badge-complete'>Active</span></a>&nbsp;";
								}else{
									echo "<a href='?type=status&operation=active&id=".$row['id']."'><span class='badge badge-pending'>Deactive</span></a>&nbsp;";
								}
								echo "<a href='manage_product.php?id=".$row['id']."'><span class='badge badge-edit'>Edit</span></a>&nbsp;";
								
								echo "<a href='?type=delete&id=".$row['id']."'><span class='badge badge-delete'>Delete</span></a>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
				
			 </div>
<center>
	<!-- <?php
	//$pagi="select * from product";
	//$result=mysqli_query($con,$pagi);
	//if (mysqli_num_rows($result)>0) {
		//$total_record=mysqli_num_rows($result);
		//$total_page=ceil($total_record/$limit);
		//echo '<ul class="pagination justify-content-center">';
		//if ($page>1) {
		//echo '<li class="page-item "><a class="page-link" href="product.php?page='.($page - 1).'">Prev</a></li>';
	//	}
	//	for($i=1;$i <=$total_page;$i++)
		{
		//	if ($i == $page) {
			//$active="active";
			//}else{
				//$active='';
			}
		//	echo '<li class="page-item'.$active.'"><a class="page-link" href="product.php?page='.$i.'">'.$i.'</a></li>';
//		}
		//if ($total_page > $page) {
			//echo '<li class="page-item"><a class="page-link" href="product.php?page='.($page + 1).'">Next</a></li>';
	//	}
		
		//echo '</ul>';
//	}
	?> -->
	</center>
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
