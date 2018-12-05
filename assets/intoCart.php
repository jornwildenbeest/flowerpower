<?php
require_once "../classes/product.php";

if(isset($_POST['productID'])){
    $id = $_POST['productID'];
} else {
    // $id = 0;
}
echo $id;

if(isset($_POST['submit'])){
    $product = new product();
    $product = $product->find_by_id($id);
    $product = $product[0];
    $product->amount = $_POST['amount'];
    $product->newprice = $_POST['newprice'];
} else {
    $product = "";
}

if(isset($_POST['submit'])){
    if(!isset($_COOKIE['cart'])) {
        // if cookie is not set, create cookie.
        
        $value = json_encode(array($product));
        setcookie('cart', $value, time() + (86400 * 30), "/");
    } else {
        // update cookie
        $CookieValue = json_decode($_COOKIE["cart"]);
        // echo "<pre>";
        // print_r($CookieValue);
        $item_array_id = array_column($CookieValue, "ID");
        if (!in_array($_POST["productID"], $item_array_id)){
            // add item to array if item is not in array.
            // count array so we can add the new item to the end of array.
            $count = count($CookieValue);
            // echo $count;

            $CookieValue[$count] = $product;
            print_r($CookieValue);
            // update cookie
            setcookie('cart', json_encode($CookieValue), time() + (86400 * 30), "/");
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>