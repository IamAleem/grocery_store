<?php
require('top.inc.php');
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Dashboard </h4>
				</div>
			</div>
		  </div>
	   </div>
	</div>
</div>

<div class="container">
	<div class="row">
		<?php
		$product_sel=mysqli_query($con,"select * from product");
		$product_count=mysqli_num_rows($product_sel);
		$category_sel=mysqli_query($con,"select * from categories");
		$category_count=mysqli_num_rows($category_sel);
		$sub_category_sel=mysqli_query($con,"select * from sub_categories");
		$sub_category_count=mysqli_num_rows($sub_category_sel);
		$order_sel=mysqli_query($con,"select * from order_product");
		$order_count=mysqli_num_rows($order_sel);
		?>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                       
                        <h4 class="mb-0">
                            <span class="count"><?php echo $product_count?></span>
                        </h4>
                        <h5 class="text-light">Products</h5>

                        <div class="chart-wrapper px-0" style="height:30px;" height="30">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                       
                        <h4 class="mb-0">
                            <span class="count"><?php echo $category_count?></span>
                        </h4>
                        <h5 class="text-light">Categories</h5>

                        <div class="chart-wrapper px-0" style="height:30px;" height="30">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count"><?php echo $sub_category_count?></span>
                        </h4>
                        <h5 class="text-light">Sub Categories</h5>

                    </div>

                    <div class="chart-wrapper px-0" style="height:30px;" height="30">
                        <canvas id="widgetChart3"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                       
                        <h4 class="mb-0">
                            <span class="count"><?php echo $order_count?></span>
                        </h4>
                        <h5 class="text-light">Order Products</h5>

                        <div class="chart-wrapper px-3" style="height:30px;" height="30">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->
	</div>
</div>

<?php
require('footer.inc.php');
?>