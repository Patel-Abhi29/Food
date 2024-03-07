<?php
    include "../connect.php";
    session_start();
    $email = $_POST['email'];
 
    $password = $_POST['password'];
   if($email == 'admin@gmail.com' && $password =='1234' ){
    $_SESSION["email"] = $email;
    $_SESSION["status"] = 1;
    $_SESSION["admin"] = 1;
    header("Location:../index.php");
   }
 $stmt = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
   $sqli=mysqli_query($conn,$stmt);
   $row= $sqli->fetch_assoc();
   if(mysqli_num_rows($sqli) == 1)
   {
    $_SESSION["email"] = $email;
    $_SESSION["status"] = 1;
    $_SESSION["id"] = $row['id'];

    header("Location:../index.php");

   }
   else
   {  

    $_SESSION["status"] = 0;
        echo "Invalid EmaiL"; 
    }

  $conn -> close(); 
?>