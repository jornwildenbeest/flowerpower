<?php
require_once 'database_object.php';

class product extends database_object
{
    private $pdo;
    public static $table_name = "Products";
    public static $id = "ID";
    public static $db_fields = array("ID", "name", "description", "price", "discount", "image_url", "deal_ID");
    public $ID;
    public $name;
    public $description;
    public $price;
    public $discount;
    public $image_url;
    public $deal_ID;
    public $amount;
    public $newprice;

    function __construct(){
        $this->pdo = $this->connect();
    }
}
