<?php 

     require ('connect.php');

     $name = $_POST['name'];
     $email = $_POST['email'];
     $number = $_POST['number'];
     $message = $_POST['message'];
     
    $stmt = "insert into mytable(name,email,phone,message)values('$name', '$email', '$number', '$message')";
   
    $conn -> query($stmt);
   $conn -> close(); 


?>