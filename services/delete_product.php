<?php
include('D:/xampp/htdocs/Food/services/CURD/Cart.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$cart_obb = new Cart($conn);


   $product_id = $_GET['product_id'];
    
   $delete= $cart_obb->delete($product_id);
   if ($delete === true) {
         header('location:cart.php');
     } else {
         echo "Error";
     }
     
     $conn->closeConnection();

?>
  
