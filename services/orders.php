


<?php
session_start();
include('D:/xampp/htdocs/Food/services/CURD/Cart.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$cart_obb = new Cart($conn);

$status="Pending";
$data = array(
    'product_id' => $_POST['add_to_cart'],
    'quantity' => $_POST['quantity'],
    'user_id' => $_SESSION['id'],
    'status' => $status
);





$insert= $cart_obb->insert($data);
if ($insert === true) {
  header('location: cart.php');
  } else {
      echo "Error";
  }

$conn->closeConnection();


?>