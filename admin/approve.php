<?php
session_start();

include('../connect.php');
$user_id=$_SESSION['id'];
$status="Processing";

$sql= "SELECT * FROM carts INNER JOIN Users on carts.user_id = Users.id INNER JOIN products on carts.product_id = products.id WHERE carts.status='$status'";

$result = $conn->query($sql);
$total=0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon_io/favicon.ico">
    <link rel="stylesheet" href="css/approve.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <title>Approve</title>
</head>
<body>

<nav id="navbar">
        <div id="logo">
            <img class="logo" src="../img/image3.png" alt="MyOnlineMeal.com">
        </div>
        <ul>
            <li class="item"><a href="../index.php">Home</a></li>
            <li class="item"><a href="../services/food_ordering.php">Order Now</a></li>

            <?php
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {

            ?>  
                <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>
                <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="../admin/admin.php">Admin control</a></li>
                <li class="item"><a href="../login/logout.php">Log out</a></li>
            </ul>
            </div>
            <?php
            } elseif (!isset($_SESSION["status"])) {
            ?><div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="../login/sign_up.php">Sign Up</a></li>
                <li class="item"><a href="../login/login.php">Login</a></li>
                </ul>
            </div> 
            <?php
            } else {
            ?><div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>
                <li class="item"><a href="../login/logout.php">Log out</a></li>
                </ul>
            </div>
            <?php
            }
            ?>
            
        </ul>
</nav>

    <div class="cart-container">
        <div class="cart">
           
            <div class="cart-items">
                <?php   
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                           $product_id=$row['product_id'];
            
    ?>
                

                         <div class="cart-item" id="product_<?php echo $row['product_id']; ?>">
                         <div class="product-image">
                                <img src="<?php echo '../admin/images/'. $row['image_path']; ?>" alt="<?php echo $row['product_type']; ?>">

                            </div>
                            
                            <h2 class=""><?php echo $row['email']; ?></h2>

                            
                            <div class="product-details">
                                <h2 class="product-title"><?php echo $row['title']; ?></h2>
                                <p class="product-price">Rs <?php echo $row['price'] ?></p>
                             
                            </div>
                            
                            <div class="quantity-controls">
                            
                               
                    <a href="delivered.php?product_id=<?php echo $product_id ?>" class="btn" >Approve</a>
                 </div>
                        </div>
                    <?php         
                                }
                            }
                    ?>
            </div>
           
        </div>
       

    </div>
</body>
</html>
