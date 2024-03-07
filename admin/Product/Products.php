<?php
    class Products{
        private $db;

        public function __construct($db){
            $this->db=$db;
        }
        // product insertion table

        // insert product
        public function insert($data){
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("', '", $data) . "'";
            $sql = "INSERT INTO products ($columns) VALUES ($values)";

            if ($this->db->conn->query($sql)) {
                return true;
            }
            else{
                return false;
            }      
        }
        
            public function delete($id){
                $sql = "DELETE FROM products WHERE id=$id";
                if ($this->db->conn->query($sql)) {
                    return true;
                }
                else{
                    return false;
                }      
            }

            public function update($data,$id){

                $updates = array();
                foreach ($data as $column => $value) {
                    $updates[] = "$column = '$value'";
                }
                $setClause = implode(', ', $updates);

                $sql = "UPDATE products SET $setClause WHERE id = $id";


                
                if ($this->db->conn->query($sql)) {
                    return true;
                }
                else{
                    return false;
                }      
            }



    }