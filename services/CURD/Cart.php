<?php
    class Cart{
        private $db;

        public function __construct($db){
            $this->db=$db;
        }
       
        public function insert($data){
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("', '", $data) . "'";
            $sql = "INSERT INTO carts ($columns) VALUES ($values)";

            if($this->db->conn->query($sql)) {
                return true;
            }
            else{
                return false;
            }      
        }

        public function delete($id){
            $sql = "DELETE FROM carts WHERE cart_id=$id";
            if($this->db->conn->query($sql)) {
                return true;
            }
            else{
                return false;
            }      
        }
        
        public function update($data,$id){

            $sql = "UPDATE carts SET quantity = $data WHERE cart_id=$id";


            
            if ($this->db->conn->query($sql)) {
                return true;
            }
            else{
                return false;
            }      
        }


    }