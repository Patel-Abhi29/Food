<?php

include('D:/xampp/htdocs/Food/services/CURD/Cart.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$cart_obb = new Cart($conn);



    if(!isset($_GET['dec_id'])){
        $product_id=$_GET['inc_id'];
        $increment = $_GET['quantity'];
        $add = $increment + 1;

        $update= $cart_obb->update($add, $product_id);
        if ($update === true) {
          header('location:cart.php');
      } else {
          echo "Error";
      }
      
      $conn->closeConnection();
           
    }
   else {$product_id=$_GET['dec_id'];
        $decrement = $_GET['quantity'];
        $sub = $decrement - 1;
        $update= $cart_obb->update($sub, $product_id);
        if ($update === true) {
          header('location:cart.php');
      } else {
          echo "Error";
      }
      
      $conn->closeConnection();
           
           
    }
    
    ?>