<?php

require_once 'database_object.php';

class orderDetails extends database_object
{
    private $pdo;
    // public static $table_name = "order_details";
    // public static $id = "order_details_id";
    // public static $db_fields = array("order_details_id", "order_id", "product_id", "amount");
    //
    // public $order_details_id;
    // public $order_id;
    public $product_id; 
    public $product_img;
    public $product_name;
    public $product_price;
    public $amount;

    function __construct(){
        $this->pdo = $this->connect();
    }

}
