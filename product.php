<?php 
ob_start();
require('top.php');
if(isset($_GET['id'])){
	$product_id=mysqli_real_escape_string($con,$_GET['id']);
	if($product_id>0){
		$get_product=get_product($con,'','',$product_id);
	}else{
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
?>
    <!-- Stylesheets -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../assets/css/docs.theme.min.css">

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="../assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/owlcarousel/assets/owl.theme.default.min.css">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">

    <!-- javascript -->
    <script src="../assets/vendors/jquery.min.js"></script>
    <script src="../assets/owlcarousel/owl.carousel.js"></script>
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
                                  <a class="breadcrumb-item" style="color:#fff" href="categories.php?id=<?php echo $get_product['0']['categories_id']?>"><?php echo $get_product['0']['categories']?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right" style="color:orange"></i></span>
                                  <span class="breadcrumb-item active" style="color:orange"><?php echo $get_product['0']['name']?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $get_product['0']['name']?></h2>
                                <ul  class="pro__prize">
                                    <li class="old__prize"><del>RS <?php echo $get_product['0']['mrp']?></del></li>
                                    <li>RS <?php 
            if ($get_product['0']['gift_offer']==0) {
              echo ''.$get_product['0']['price'].'';
            }else if($get_product['0']['gift_offer']>1){
            $per_price=ceil($get_product['0']['mrp']*$get_product['0']['gift_offer']/100);
            $final_price=$get_product['0']['mrp']-$per_price;
            echo $final_price;
              }
                                    ?></li>
                                </ul>
                                <p class="pro__info"><?php echo $get_product['0']['short_desc']?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <?php
                                        $productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id']);
                                        
                                        $pending_qty=$get_product['0']['qty']-$productSoldQtyByProductId;
                                        
                                        $cart_show='yes';
                                        if($get_product['0']['qty']>$productSoldQtyByProductId){
                                            $stock='In Stock';          
                                        }else{
                                            $stock='Not in Stock';
                                            $cart_show='';
                                        }
                                        ?>
                                        <p><span><b>Availability:</b></span> <?php echo $stock?></p>
                                    </div><br>
                                    <div class="sin__desc">
                                        <?php
                                        if($cart_show!=''){
                                        ?>
                                        <p><span><b>Select Quantity:</b></span> 
                                        <select id="qty" class="form-control col-lg-12 ">
                                            <?php
                                            for($i=1;$i<=10;$i++){
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                        </p>
                                        <?php } ?>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span><b>Categories:</b></span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $get_product['0']['categories']?></a></li>
                                        </ul>
                                    </div>
                                    
                                    </div>
                                    
                                </div>
                                <?php
                                if($cart_show!=''){
                                ?>
                                <a class="fr__btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Add to cart</a>
                                <?php } ?>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </section>

        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">  
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <?php echo $get_product['0']['description']?>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </section><hr>
        <?php
        if (isset($_COOKIE['recently_viewed'])) {
        $arrRecentView=unserialize($_COOKIE['recently_viewed']);
        $countRecentView=count($arrRecentView);
        $countStartRecentView=$countRecentView-4;
        if ($countRecentView>4) {
           $arrRecentView=array_slice($arrRecentView,$countStartRecentView, 4);
        }
        $recentViewId=implode(",", $arrRecentView);
        $res=mysqli_query($con,"select * from product where id IN ($recentViewId)");
        ?>
      <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                      
                        <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Recently Viewed</h2>
                            <p>You also Like This</p>
                        </div>
                    </div>
                    </div>
                </div>
               
           
             <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <div class="row">
                                <?php while($list=mysqli_fetch_assoc($res)){
                            ?>
                                <div class="col-xs-3">
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
                           
                        </div><?php } ?>
                        </div>
                    </div>
                </div>
                 </div>
     </section>

<?php
$arrRec=unserialize($_COOKIE['recently_viewed']);
if (($key=array_search($product_id, $arrRec))!==false) {
    unset($arrRec[$key]);
}
$arrRec []=$product_id; 
setcookie('recently_viewed',serialize($arrRec),time()+60*60*24*365);

}else{
    $arrRec []=$product_id; 
setcookie('recently_viewed',serialize($arrRec),time()+60*60*24*365);
}
?>
<hr>
 <section class="ftr__product__area ptb--10">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Releted Products</h2>
                            <p>You also Like This</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__list clearfix mt--30">
                            <?php
                            $get_product=mysqli_query($con,"select * from product where categories_id=".$get_product['0']['categories_id']." order by rand() LIMIT 0,8");
                            foreach($get_product as $list){
                            ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
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
        </section>

										
<?php require('footer.php');
ob_flush();
?>        