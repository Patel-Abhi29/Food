<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Upload Form</title>
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
    <h2 style="text-align: center; padding-top:25px;">Upload a Product</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="product_type">Product Type:</label>
        <input type="text" name="product_type" id="product_type" required><br>
        
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>
        
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br>

        <input type="submit" value="Upload" name="submit">
    </form>
</body>
</html>
