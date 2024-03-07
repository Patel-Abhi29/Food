<?php
session_start();

include('D:/xampp/htdocs/Food/services/CURD/Checkout.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$checkout_obb = new Checkout($conn);

$id= $_SESSION["id"];

$data = array(
    'user_id' => $id,
    'total_price' => $_POST['total'],
    'cardNumber' => $_POST['card-number'],
);





            if(is_array($_SESSION['product_arr'])){
                foreach($_SESSION['product_arr'] as $productid){
                
                    
                $sql1="UPDATE carts SET status='Processing' where product_id=$productid AND user_id=$id";
                $conn->query($sql1);
                }
            }

            $insert= $checkout_obb->insert($data);
            if ($insert === true) {
                header("location:cart.php");
              } else {
                  echo "Error";
              }
             
      $conn->closeConnection();
            
            ?>

       

       
    






