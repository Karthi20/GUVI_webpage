<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "details";
 
    // object properties
    public $deg;
    public $name;
    public $email;
    public $ph;
    public $hloc;
    public $clg;
    

    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, ph=:ph, clg=:clg, hloc=:hloc, deg=:deg;
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->ph=htmlspecialchars(strip_tags($this->ph));
        $this->hloc=htmlspecialchars(strip_tags($this->hloc));
        $this->deg=htmlspecialchars(strip_tags($this->deg));
        $this->clg=htmlspecialchars(strip_tags($this->clg));
        


    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":ph", $this->ph);
        $stmt->bindParam(":hloc", $this->hloc);
        $stmt->bindParam(":deg", $this->deg);
        $stmt->bindParam(":clg", $this->clg);



        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }
    // login user
    function login(){
        // select all query
        $query = "SELECT
                    `name`, `email`, `ph`, `deg`, 'hloc', clg
                FROM
                    " . $this->table_name . " 
                WHERE
                    name='".$this->name."' AND email='".$this->email."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    
}