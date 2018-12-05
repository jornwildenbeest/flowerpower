<?php

class database_object
{
    private $pdo;
    public static $spdo;
    private static $db_server = 'localhost';
    private static $db_username = 'jornwildenbeest_flowerpower';
    private static $db_password = 'gc9167';
    private static $db_name = 'jornwildenbeest_flowerpower';
    private static $db_port = '';

    public function connect()
    {

        /* Attempt to connect to MySQL database */
        try {
            $this->pdo = new PDO("mysql:host=" . self::$db_server . ";port=" . self::$db_port . " ;dbname=" . self::$db_name, self::$db_username, self::$db_password);
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$spdo = $this->pdo;
            return $this->pdo;
        } catch (PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

    protected function attributes()
    {
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes()
    {
        global $database;

        $clean_attributes = array();

        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }


    public function create()
    {
        $attributes = $this->attributes();
        //done with prepared statements to keep it safe
        $place_holders = implode(',', array_fill(0, count($attributes), '?'));
        $stmt = $this->pdo->prepare("INSERT INTO " . static::$table_name . " (" . join(", ", array_keys($attributes)) . ") VALUES ($place_holders)");

        if ($stmt->execute(array_values($attributes))) {
            return true;
        } else {
            return false;
        }
    }

    public function find_all($amount)
    {
        $stmt = "";
        if(!empty($amount)){
            $stmt = $this->pdo->prepare("SELECT * FROM " . static::$table_name . " LIMIT :amount");
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM " . static::$table_name);
            $stmt->execute();
        }
        
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }   

    public function find_by_id($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . static::$table_name . " WHERE " . static::$id . " = {$id}");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM " . static::$table_name . " WHERE " . static::$id . " = :id LIMIT 1");
        $stmt->bindParam(":id", $id);

    }

    public function update($id)
    {
        $attributes = $this->attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $stmt = $this->pdo->prepare("UPDATE " . static::$table_name . " SET " . join(", ", $attribute_pairs) . " WHERE " . static::$id . "=:id");
        $stmt->bindParam(":id", $id);
        print_r($stmt);
        $stmt->execute();
    }

    public function find_by_sql($sql="", $param){

        $stmt = $this->pdo->prepare($sql);
        // bindParam if var isset
        if(!empty($param)){
            $stmt->bindParam(":param", $param);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;

    }

    public function get_last_id() {
      return $this->pdo->lastInsertId();
    }
}
