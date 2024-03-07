<?php
include('D:/xampp/htdocs/Food/admin/product/Products.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$database_obb = new Products($conn);


   $product_id = $_GET['product_id'];
    
   $delete= $database_obb->delete($product_id);
   if ($delete === true) {
         header('location:../admin.php');
     } else {
         echo "Error";
     }
     
     $conn->closeConnection();

?>