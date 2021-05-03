<?php 
require('top.php');

if(!isset($_GET['id']) && $_GET['id']!=''){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$sub_categories='';
$cat_id=mysqli_real_escape_string($con,$_GET['id']);

if (isset($_GET['sub_categories'])) {
	$sub_categories=mysqli_real_escape_string($con,$_GET['sub_categories']);
}


$price_high_selected="";
$price_low_selected="";
$new_selected="";
$old_selected="";
$sort_order="";
if(isset($_GET['sort'])){
	$sort=mysqli_real_escape_string($con,$_GET['sort']);
	if($sort=="price_high"){
		$sort_order=" order by product.price desc ";
		$price_high_selected="selected";	
	}if($sort=="price_low"){
		$sort_order=" order by product.price asc ";
		$price_low_selected="selected";
	}if($sort=="new"){
		$sort_order=" order by product.id desc ";
		$new_selected="selected";
	}if($sort=="old"){
		$sort_order=" order by product.id asc ";
		$old_selected="selected";
	}

}

if($cat_id>0){
	$get_product=get_product($con,'',$cat_id,'','',$sort_order,$sub_categories);
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}										
?>
<div class="body__overlay"></div>
        
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner3.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" style="color:#fff" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right" style="color:orange"></i></span>
                                  <span class="breadcrumb-item active" style="color:orange">Products</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
					<?php if(count($get_product)>0){?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php echo $price_low_selected?>>Sort by price low to hight</option>
                                        <option value="price_high" <?php echo $price_high_selected?>>Sort by price high to low</option>
                                        <option value="new" <?php echo $new_selected?>>Sort by new first</option>
										<option value="old" <?php echo $old_selected?>>Sort by old first</option>
                                    </select>
                                </div>
                               
                            </div>
                            <!-- Start Product View -->
        <div class="row">
            <div class="shop__grid__view__wrap">
                <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                   <?php
						
							foreach($get_product as $list){
							?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                  <div class="">
                                    <?php
                                    $zero=$list['gift_offer'];
                                    $zero=0;
                                    $zero='';
                                    echo $zero;
                                    if ($list['gift_offer'] == 0) {
                                      echo '<span class="btn btn-primary">Fixed Price</span>';
                                    }else if ($list['gift_offer'] <= 10 && $list['gift_offer'] >=5) {
                                      echo '<span class="btn btn-warning">'.$list['gift_offer'].'% OFF</span>';
                                    }
                                    else if($list['gift_offer'] <= 20){
                                      echo '<span class="btn btn-info">'.$list['gift_offer'].'% OFF</span>';
                                    }else if($list['gift_offer'] >= 30){
                                      echo '<span class="btn btn-success">'.$list['gift_offer'].'% OFF</span>';
                                    }
                                    
                                    ?>
                                    
                                  </div>
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
                                        </a>
                                    </div>
                                     <div class="fr__hover__info">
                                 
                                </div>
                                    <div class="fr__product__inner">
                                        <h4><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize"><del>RS <?php echo $list['mrp']?></del></li>
                                            <li>RS <?php 
                                           
                                            
                                            if ($list['gift_offer']==0) {
                                              echo ''.$list['price'].'';
                                            }else if($list['gift_offer']>1){
                                            $per_price=ceil($list['mrp']*$list['gift_offer']/100);
                                            $final_price=$list['mrp']-$per_price;
                                            echo $final_price;
                                          }
                                            ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
							<?php } ?>
                </div>
		   </div>
        </div>
                        </div>
                    </div>
					<?php } else { 
						echo "Data not found";
					} ?>
                
				</div>
            </div>
        </section>
        <!-- End Product Grid -->
        <!-- End Banner Area -->
<?php require('footer.php')?>        