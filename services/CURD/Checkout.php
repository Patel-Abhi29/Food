<?php
    class Checkout{
        private $db;

        public function __construct($db){
            $this->db=$db;
        }
       
        public function insert($data){
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("', '", $data) . "'";
            $sql = "INSERT INTO checkout ($columns) VALUES ($values)";

            if ($this->db->conn->query($sql)) {
                return true;
            }
            else{
                return false;
            }      
        }
        
         


    }