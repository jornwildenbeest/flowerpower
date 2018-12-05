<?php
require_once "../classes/product.php";

$cookie_name ='cart';
if(isset($_GET['productId']) && isset($_COOKIE[$cookie_name]) ){
  $id =  $_GET['productId'];
  $cookieitems = json_decode($_COOKIE[$cookie_name]);

  // echo '<pre>';
  // print_r($cookieitems);

  for ($i=0; $i < count($cookieitems); $i++) {
    $product = $cookieitems[$i];
    // print_r($product);


    // echo '<pre>';
    // print_r($product);
    if($id == $product->ID){
      unset($cookieitems[$i]);
      // new Cookie
      $CookieValue = array_values($cookieitems);
      setcookie('cart', json_encode($CookieValue), time() + (86400 * 30), "/");
    }
  }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
