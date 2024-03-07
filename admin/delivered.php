<?php
   
   $conn = new mysqli('localhost','root','','food');
   if($conn -> connect_error){
       die("Connection failed: " . $conn -> connect_error);
   }
    
   $product_id = $_GET['product_id'];
    
    $stmt = "UPDATE carts SET status='Delivered' where product_id=$product_id";
  
  if( $conn -> query($stmt)){
    header('location: approve.php');
    
  }
   
  $conn -> close(); 


?>