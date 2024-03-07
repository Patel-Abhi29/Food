<?php
     
     session_start(); 
     include('../../connect.php');
        
     $product_id= $_GET['product_id'];
         $sql = "SELECT * FROM products WHERE id='$product_id'";
         $result = $conn->query($sql);
        ?> 

<!DOCTYPE html>
<html>
<head>
    <title>Product Update Form</title>
    <link rel="stylesheet" href="../css/add.css">
</head>
<body>
<nav id="navbar">
        <div id="logo">
            <img class="logo" src="../../img/image3.png" alt="MyOnlineMeal.com">
        </div>
        <ul>
         
            <li class="item"><a href="../../index.php">Home</a></li>
            <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>

            
           
            <?php
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {

            ?>
            <li class="item"><a href="../admin.php">Admin control</a></li>
            <div style="position:absolute; right:20px">   <ul>
                
                
                <li class="item"><a href="../../login/logout.php">Log out</a></li>
            </ul>
            </div>
            <?php




            } elseif (!isset($_SESSION["status"])) {
            ?>  <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="../../login/sign_up.php">Sign Up</a></li>
                <li class="item"><a href="../../login/login.php">Login</a></li>
                </ul>
            </div>
            <?php
            } else {
            ?>  <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>

                <li class="item"><a href="../../login/logout.php">Log out</a></li>
                </ul>
            </div>
            <?php
            }


            ?>

        </ul>

    </nav>
 <?php
        if ($result->num_rows > 0) {
           
            while ($row = $result->fetch_assoc()) { 
    
            
           
    ?>
    <h2 style="text-align: center; padding-top:25px;">Upload a Product</h2>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <label for="product_type">Product Type:</label>
        <input type="text" name="product_type" id="product_type" value="<?php echo $row['product_type']?>" required><br>
        
        <input type="hidden" name="id" value="<?php echo $row['id']?>" >
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $row['title']?>" required><br>
       
        <label for="description">Description:</label>
        <textarea name="description" id="description" value="<?php echo $row['descriptions']?>" required><?php echo $row['descriptions']?></textarea><br>
        
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo $row['price']?>" required><br>
        <p>Old Image:</p>
        <img src="../images/<?php echo $row['image_path']?>" alt="" width="200px">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br>

        <input type="submit" value="Upload" name="submit">
    </form>
    <?php 
            }
            
            } 
            
            ?>
</body>
</html>

