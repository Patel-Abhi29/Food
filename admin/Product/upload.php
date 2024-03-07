<?php
include('D:/xampp/htdocs/Food/admin/product/Products.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$database_obb = new Products($conn);


// $conn = new mysqli('localhost','root','','food');

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$data = array(
    'product_type' => $_POST['product_type'],
    'title' => $_POST['title'],
    'descriptions' => $_POST['description'],
    'price' => $_POST['price'],
    'image_path' => $_FILES["image"]["name"]
);



if (isset($_POST["submit"])) {
    $target_file =$_FILES["image"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($target_file)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

  
 

    if ($uploadOk == 1) {
            
            $image_path = $target_file;
            $tmp=$_FILES["image"]["tmp_name"];
            $location='../images/'.$image_path;
            move_uploaded_file($tmp,$location);




            
            // $sql = "INSERT INTO products (product_type, title, descriptions, price, image_path) VALUES ('$product_type', '$title', '$description', $price, '$location')";
            // if ($conn->query($sql) === TRUE) {
            //     echo "Product uploaded successfully and added to the database.";
            // } else {
            //     echo "Error: " . $sql . "<br>" . $conn->error;
            // }
        $insert= $database_obb->insert($data);
          if ($insert === true) {
                header('location:../admin.php');
            } else {
                echo "Error";
            }
    }
    $conn->closeConnection();
}


?>
