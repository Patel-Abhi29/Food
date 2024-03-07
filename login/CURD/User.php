<?php
    class User{
        private $db;

        public function __construct($db){
            $this->db=$db;
        }
       
        public function insert($data){
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("', '", $data) . "'";
            $sql = "INSERT INTO users ($columns) VALUES ($values)";

            if ($this->db->conn->query($sql)) {
                return true;
            }
            else{
                return false;
            }      
        }

    }