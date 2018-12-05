<?php require_once 'database_object.php';

class login_handler extends database_object
{  
    private $pdo;
    public static $table_name = "Customer";
    public static $id = "ID";
    public static $db_fields = array("ID", "firstname", "lastname", "e_mail", "password", "salt");
    public $ID;
    public $firstname;
    public $lastname;
    public $address;
    public $zipcode;
    public $town;
    public $e_mail;
    public $password;
    public $salt;
    public $register_errors = array();
    public $login_errors = array();
    
    function __construct(){
        $this->pdo = $this->connect();
    }

    // function to create salt.
    public function randomSalt() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

    // function to create user.
    public function register($post){
        // check if field is empty, if so add error to array.
        if(empty($post['voornaam'])){
            $this->register_errors[] = "firstname is empty";
        } else {
            $this->firstname = $post['voornaam'];
        }

        if(empty($post['achternaam'])){
            $this->register_errors[] = "lastname is empty";
        } else {
            $this->lastname = $post['achternaam'];  
        }

        if(empty($post['email'])){
            $this->register_errors[] = "email is empty";
        } else {
            $this->e_mail = $post['email'];
        }
        
        if($post['herhaalwachtwoord'] !== $post['password']) {
            $this->register_errors[] = "passwords don't match";
        }

        if(empty($post['password'])){
            $this->register_errors[] = "password is empty";
        } else if($post['password'] == $post['herhaalwachtwoord'] ){
            $salt = $this->randomSalt();
		    $password = $post['password'] . $salt;
            $password = md5($password);
            $this->password = $password;
            $this->salt = $salt;    
        }

        if(empty($post['herhaalwachtwoord'])){
            $this->register_errors[] = "repeated password is empty";
        } 

        // if error array is empty, create user.
        if(empty($this->register_errors)){
            $this->create();
        }
    } 

    // function to check login 
    public function login($post){

        if(empty($post['email'])){
            $this->login_errors[] = "email is empty"; 
        }

        if(empty($post['password'])){
            $this->login_errors[] = "password is empty"; 
        } 

        if(empty($this->login_errors)){
            $result = $this->find_by_sql("SELECT * FROM Customer WHERE e_mail =:param", $post['email']);
            $salt = $result[0]->salt;
            
            $password = $post['password'] . $salt;
            $password = md5($password);
    
            if($password == $result[0]->password){
                // logged in.
                $_SESSION["email"] = $result[0]->e_mail;
                $_SESSION["user_id"] = $result[0]->ID;
                $_SESSION["logged_in"] = 1;
            } else {
                // wrong password.
                $this->login_errors[] = "password or email is not correct.";
            }
        }

    }
}
?>