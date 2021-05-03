<?php 
require('top.php');
$str=mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
	$get_product=get_product($con,'','','',$str);
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
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" style="color:#fff" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right" style="color:#fff"></i></span>
                                  <span class="breadcrumb-item active" style="color:#fff">Search</span>
								  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right" style="color:orange"></i></span>
                                  <span class="breadcrumb-item active" style="color:orange"><?php echo $str?></span>
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
                                    }else if ($list['gift_offer']  <=10 && $list['gift_offer'] >=5) {
                                      echo '<span class="btn btn-warning">'.$list['gift_offer'].'% OFF</span>';
                                    }
                                    else if($list['gift_offer'] <= 20 && $list['gift_offer'] >10){
                                      echo '<span class="btn btn-info">'.$list['gift_offer'].'% OFF</span>';
                                    }else if($list['gift_offer'] >20){
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
		<input type="hidden" id="qty" value="1"/>
<?php require('footer.php')?>        