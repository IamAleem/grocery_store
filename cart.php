<?php 
   require('top.php');
     if(empty($_SESSION['cart'])){
echo "<script>
   window.location.href='index.php';
   </script>";
  }
   ?>
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner2.jpg) no-repeat scroll center center / cover ;">
   <div class="ht__bradcaump__wrap">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="bradcaump__inner">
                  <nav class="bradcaump-inner">
                     <a class="breadcrumb-item" style="color:white" href="index.php">Home</a>
                     <span class="brd-separetor"><i class="zmdi zmdi-chevron-right" style="color:orange"></i></span>
                     <span class="breadcrumb-item active" style="color:orange">shopping cart</span>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="#">
               <div class="table-content table-responsive">
                  <table>
                     <thead>
                        <tr>
                           <th class="product-thumbnail">products</th>
                           <th class="product-name">name of products</th>
                           <th class="product-price">Price</th>
                           <th class="product-quantity">Quantity</th>
                           <th class="product-subtotal">Total</th>
                           <th class="product-remove">Remove</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                              if(isset($_SESSION['cart'])){
                                 foreach($_SESSION['cart'] as $key=>$val){
                                 $productArr=get_product($con,'','',$key);
                                 $pname=$productArr[0]['name'];
                                 $mrp=$productArr[0]['mrp'];
                                 $price=$productArr[0]['price'];
                                 $gift_offer=$productArr[0]['gift_offer'];
                                 $image=$productArr[0]['image'];
                                 $qty=$val['qty'];
                                 ?>
                                 <tr>
                                    <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"  /></a></td>
                                    <td class="product-name"><a href="#"><?php echo $pname?></a>
                                       <ul  class="pro__prize">
                                          <li class="old__prize"><del>RS <?php echo $mrp?></del></li>
                                          <li>RS  <?php 
                                           
                                            
                                            if ($gift_offer==0) {
                                              echo $price;
                                            }else if($gift_offer>1){
                                            $per_price=ceil($mrp*$gift_offer/100);
                                            $final_price=$mrp-$per_price;
                                            echo $final_price;
                                          }
                                            ?></li>
                                       </ul>
                                    </td>
                                    <td class="product-price"><span class="amount"><?php 
                                            
                                            if ($gift_offer==0) {
                                              echo $price;
                                            }else if($gift_offer>1){
                                            $per_price=ceil($mrp*$gift_offer/100);
                                            $final_price=$mrp-$per_price;
                                            echo $final_price;
                                          }?></span></td>
                                    <td class="product-quantity"><input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>" />
                                    <br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">update</a>
                                    </td>
                                    <td class="product-subtotal"><?php 

                                            
                                            if ($gift_offer==0) {
                                              echo $price * $qty;
                                            }else if($gift_offer>1){
                                            $per_price=ceil($mrp*$gift_offer/100);
                                            $final_price=$mrp-$per_price;
                                            echo $final_price * $qty;
                                          }
                                    ?>  </td>
                                    <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a></td>
                                 </tr>
                                 <?php } } ?>
                     </tbody>
                  </table>
               </div>
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="buttons-cart--inner">
                        <div class="buttons-cart">
                           <a href="index.php">Continue Shopping</a>
                        </div>
                        <div class="buttons-cart checkout--btn">
                           <a href="checkout.php">checkout</a>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php require('footer.php')?>