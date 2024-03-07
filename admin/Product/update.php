
 <?php
include('D:/xampp/htdocs/Food/admin/product/Products.php');
include('D:/xampp/htdocs/Food/connection.php');

$conn= new connection();

$database_obb = new Products($conn);


$data = array(
    'product_type' => $_POST['product_type'],
    'title' => $_POST['title'],
    'descriptions' => $_POST['description'],
    'price' => $_POST['price'],
    'image_path' => $_FILES["image"]["name"]
);

$id=$_POST['id'];


 // Image upload handling
 if (isset($_POST["submit"])) {
 
     $target_file =$_FILES["image"]["name"];
     $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
 
    
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


             $update= $database_obb->update($data,$id);
          if ($update === true) {
                header('location:../admin.php');
            } else {
                echo "Error";
            }
    }
    $conn->closeConnection();
 }
 

 ?>
 