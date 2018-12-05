<?php
require_once 'database_object.php';

class deal extends database_object
{
    private $pdo;
    public static $table_name = "Deals";
    public static $id = "ID";
    public static $db_fields = array("ID", "name", "percentage");
    public $ID;
    public $name;
    public $percentage;

    function __construct(){
        $this->pdo = $this->connect();
    }
}
