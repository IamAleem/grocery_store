<?php
session_start();
$con=mysqli_connect("localhost","root","","ecomuni");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/grocerystore/');
define('SITE_PATH','http://127.0.0.1/grocerystore/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
?>