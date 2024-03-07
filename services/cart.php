<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location: ../login/login.php');
  }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food";

$conn = new mysqli($servername, $username, $password, $dbname);

$user_id=$_SESSION['id'];
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql= "SELECT * FROM carts INNER JOIN products on carts.product_id = products.id WHERE carts.user_id=$user_id";

$result = $conn->query($sql);
$total=0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <title>Shopping </title>
</head>
<body>
<nav id="navbar">
        <div id="logo">
            <img class="logo" style="border-radius:20px" src="../img/image3.png" alt="MyOnlineMeal.com">
        </div>
        <ul>
            <li class="item"><a href="../index.php">Home</a></li>
            <li class="item"><a href="food_ordering.php">Order Now</a></li>

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
                        <li class="item"><a href="your_order.php">Your Orders</a></li>

        </ul>
</nav>
   
    <div class="cart-container">
        <div class="cart">
            <h1 class="cart-title">Your Cart</h1>
            <div class="cart-items">
                <?php   
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                
                                $total  += $row['quantity'] * $row['price'];
                                
            
    ?>                              
                            <form action="checkout.php" method="POST">
                                       <div class="cart-item" id="product_<?php echo $row['product_id']; ?>">
                                       
                            <input type="checkbox" id="checkbox" name="checkbox[]" value="<?php echo $row['product_id']  ?>">
                            <div class="product-image">
                                <img src="<?php echo '../admin/images/'. $row['image_path']; ?>" alt="<?php echo $row['product_type']; ?>">
                            </div>
                            <div class="product-details">
                                <h2 class="product-title"><?php echo $row['title']; ?></h2>
                                <p class="product-price">Rs <?php echo $row['price'] ?></p>
                            </div>
                            <div class="quantity-controls">
                               
                                <?php
                                    $quantity= $row['quantity'];
                                ?>
        

                                <a class="quantity-decrease btn"  href="quantity_update.php?dec_id=<?php echo $row['cart_id'] ?> && quantity=<?php echo $quantity?> " style="text-decoration:none">-</a>
                                <!-- </form> -->

                                <input type="text" name="quantity" class="quantity-display" id="quantity_<?php echo $row['product_id']; ?>" value="<?php echo $row['quantity'] ?>">
                               
                       

                                <a class="quantity-increase btn" href="quantity_update.php?inc_id=<?php echo $row['cart_id'] ?> && quantity=<?php echo $quantity?>  " style="text-decoration:none">+</a>
                            <!-- </form> -->
                                <a href="delete_product.php?product_id=<?php echo $row['cart_id'];?>" class="remove-button btn" style="text-decoration:none" >Remove</a>
                            </div>
                        </div>
                    <?php         
                                }
                            }
                    ?>
            </div>
            <div class="cart-summary">
                <div class="subtotal">
                    <span class="summary-label">Subtotal:</span>
                    <span class="summary-value">Rs <?php    echo $total ?></span>
                </div>
                <div class="checkout-button">
                    <button class="checkout-button" onclick="location.href='checkout.php" type="submit">Proceed to Checkout</button>
                </div>
            </div>
        </div>

        </form>
    </div>
</body>
</html>
