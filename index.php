<?php require('top.php');
?>
<div class="body__overlay"></div>

     <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/banner/1.jpg" alt="Los Angeles" style="width:100%;height: 400px;">
        <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>LA is always so much fun!</p>
      </div>
      </div>

      <div class="item">
        <img src="images/banner/2.jpg" alt="Chicago" style="width:100%;height: 400px;">
      </div>
    
      <div class="item">
        <img src="images/banner/3.jpg" alt="New york" style="width:100%;height: 400px;">
      </div>
    </div>

  </div>
</div>
        <section id="box" class="container" style="border:2px dashed orange;margin-top: 10px; ">
          <div class="row">
          <div class="col-lg-2 bg-info" style="background-color: orange;padding:8px;">
            <h6>You Getting A Offer</h6>
          </div>
          <div class="col-lg-10">
            <div class=" col bg text-success">
          
            <marquee behavior="scroll" direction="left"><h6 style="margin-top: 10px;">* If you are Purches product RS 1000 then send a Email Coupon Code,Next time can apply coupon code will be  Discount all purches Products.  </h6></marquee>

        </div> 
          </div>
          </div>
             
        </section>
        <section id="box" class="border border-danger"></section>
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--10 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
							<?php
							$get_product=get_product($con,8);
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
        </section>
        <!-- End Category Area -->

<style type="text/css">
     h6{
  width:100%;
  height:100%;
  color:black;
  font-weight:bold;
  animation: myanimation 10s infinite;
  text-align:center;
}

@-webkit-@keyframes myanimation {
  0% {color: red;}
  25%{color:black;}
  50%{color:green;}
  75%{color:pink;}
  100% {color: red;}
}
#cat{

  animation: myanimation 3s infinite;
}

@keyframes myanimation {
  0% {color: red;}
  25%{color:black;}
  50%{color:green;}
  75%{color:pink;}
  100% {color: orange;}
}
</style>
        <section id="category_list">
            <div class="container">
                
                    <div class="col-xs-12">
                     <div class="section__title--2 text-center">
                            <h2 id="cat" class="title__line">Top Categories</h2>
                            <p class="">But I must explain to you how all this mistaken idea</p>
        </div> 
             
         </div>
        
        <div class="row">
        <?php
        $cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
        $cat_arr=array();
        while($row=mysqli_fetch_assoc($cat_res)){
        $cat_arr[]=$row;    
        }
                foreach($cat_arr as $list){
        $sub_id=$list['id'];
        $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$sub_id'");
        if (mysqli_num_rows($sub_cat_res)>0) {
            

        while ($row=mysqli_fetch_assoc($sub_cat_res)) {
            echo '<a href="categories.php?id='.$list['id'].'&sub_categories='.$row['id'].'"><div class="col-lg-1 padding">
            <div class="categoris_circle ml-2">
                <p>'.$row['sub_categories'].'</p>
            </div></a><br>
        </div>';

        }
        }
        }

        ?>


        </div>
            </div>
        </section>
        <!-- Start Product Area -->
        <section class="ftr__product__area ptb--10 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Seller</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__list clearfix mt--30">
                            <?php
                            $get_product=get_product($con,8,'','','','','','yes');
                            foreach($get_product as $list){
                            ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="offer"><?php 
                                   $best= $list['best_seller'];
                                   if ($best=1) {
                                     echo  $top='Top Seller';
                                   }
                                  
                                   
                                    ?></div>
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
                                            <li>RS <?php echo $list['price']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
                            <?php } ?>
                        </div>                </div>
            </div>
        </section>
        

        </div>
      </div>
    </section>
        <!-- End Product Area -->
<?php require('footer.php')?>        