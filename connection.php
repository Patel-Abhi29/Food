<?php

class connection{
    public $servername="localhost";
    public $username="root";
    public $password="";
    public $database="food";

    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->database);
        if ($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public function getconnection(){
        return $this->conn;
    }
        
    public function closeConnection(){
        $this->conn->close();
    }
        public function query($sql) {
        return $this->conn->query($sql);
    }
        public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
       
}

?>