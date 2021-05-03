<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
	$cat_arr[]=$row;	
}

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

if (isset($_SESSION['USER_LOGIN'])) {
    $uid=$_SESSION['USER_ID'];

}
$script_page=$_SERVER['SCRIPT_NAME'];
$script_page_arr=explode('/', $script_page);
$mypage=$script_page_arr[count($script_page_arr)-1];



$meta_title='Ecom Grosry';
$meta_desc='Ecom Grosry';
$meta_keyword='Ecom Grosry';
if ($mypage=='product.php') {
    $product_id=get_safe_value($con,$_GET['id']);
$product_meta_res=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
$meta_title=$product_meta_res['meta_title'];
$meta_desc=$product_meta_res['meta_desc'];
$meta_keyword=$product_meta_res['meta_keyword'];
}if ($mypage=='contact.php') {
$meta_title='Contact Us';

}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title?></title>
    <meta name="meta_desc" content="<?php echo $meta_desc?>">
    <meta name="meta_keyword" content="<?php echo $meta_keyword?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
    
</head>
<body>

    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/logo/4.png" alt="E-Shopper"></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                         <?php
							foreach($cat_arr as $list){
        					?>
				<li class="drop"><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                    <?php
                    $sub_id=$list['id'];
                    $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$sub_id'");
                    if (mysqli_num_rows($sub_cat_res)>0) {
                        
                    
                    ?>
                  <ul class="dropdown">
                    <?php
                    while ($row=mysqli_fetch_assoc($sub_cat_res)) {
                        echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$row['id'].'">'.$row['sub_categories'].'</a></li>';

                    }
                    ?>
                   </ul>
               <?php }?>
                  </li>
				<?php } ?>
								             
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li class="drop"><a href="index.php">Home</a></li>
                         <?php
                            foreach($cat_arr as $list){
                            ?>
                <li class="drop"><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                    <?php
                    $sub_id=$list['id'];
                    $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$sub_id'");
                    if (mysqli_num_rows($sub_cat_res)>0) {
                        
                    
                    ?>
                  <ul class="dropdown">
                    <?php
                    while ($row=mysqli_fetch_assoc($sub_cat_res)) {
                        echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$row['id'].'">'.$row['sub_categories'].'</a></li>';

                    }
                    ?>
                   </ul>
               <?php }?>
                  </li>
                <?php } ?>
                                             
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">
									<div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                <div class="header__account">
                            <?php 
                              if(isset($_SESSION['USER_LOGIN'])){
                                ?>
<!-- Single button -->
<div class="btn-group">
  <a class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Account  </a>
  <ul class="dropdown-menu">
    <li><a href="profile.php">Profile</a></li>
    <li><a href="my_order.php">My Order</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</div>

   <?php

	}else{
	echo '<a href="login.php">Login/Register</a>';
			}
	?>
										
        </div>
 
    <div class="htc__shopping__cart">
        <a href="cart.php"><i class="icon-handbag icons"></i></a>
         <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>
    </div>
     </div>
    </div>
      </div>
    </div>
      <div class="mobile-menu-area"></div>
      </div>
   </div>
</header>
		<div class="body__overlay"></div>
		<div class="offset__wrapper">
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>