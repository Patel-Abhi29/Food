<?php
  

session_start();
include('D:/xampp/htdocs/Food/login/CURD/Users.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$users_obb = new Users($conn);


$data = array(
  'email' => $_POST['email'],
  'password' => $_POST['password'],
);
$insert = $signupsql->insert($data);  


if( $insert==true){
header('location: login.php');
}
else {
      echo "Error";
  }

$conn->closeConnection();


?>
   