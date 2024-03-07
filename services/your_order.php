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

$sql= "SELECT * FROM carts INNER JOIN products on carts.product_id = products.id WHERE carts.user_id=$user_id AND status != 'Pending'";

$result = $conn->query($sql);
$total=0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <title>Your </title>
</head>
<body>
<nav id="navbar">
        <div id="logo">
            <img class="logo" style="border-radius:20px" src="../img/image3.png" alt="MyOnlineMeal.com">
        </div>
        <ul>
            <li class="item"><a href="../index.php">Home</a></li>
            <li class="item"><a href="food_ordering.php">Order Now</a></li>
            <li class="item"><a href="offer.php"><span>Offers</span> <i class="fa fa-gift" aria-hidden="true" style="color:red"></i></a></li>

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
            <h1 class="cart-title">Your </h1>
            <div class="cart-items">
                <?php   
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                
                              
            
    ?>                              
                            <form action="" method="">
                                       <div class="cart-item" id="product_<?php echo $row['product_id']; ?>">
                                       
                            <div class="product-image">
                                <img src="<?php echo '../admin/images/'. $row['image_path']; ?>" alt="<?php echo $row['product_type']; ?>">
                            </div>
                            <div class="product-details">
                                <h2 class="product-title"><?php echo $row['title']; ?></h2>
                                <p class="product-price">Rs <?php echo $row['price'] ?></p>
                            </div>
                            <div class="quantity-controls">
                                 
                            
                                <label for="quantity" class="display">Quantity : </label>

                                <input type="text" name="quantity" class="quantity-display" id="quantity_<?php echo $row['product_id']; ?>" value="<?php echo $row['quantity'] ?>">
                                <p class="p"><?php echo $row['status']   ?></p> 
                       
                            
                            </div>
                            <?php      
                    
                    if($row['status']=='Processing'){
                        ?>
                        
                        <a href="delete_product.php?product_id=<?php echo $row['cart_id']?> && result=1" class="absolute"><i class="fa fa-trash" aria-hidden="true" ></i></a>
                        <?php    } ?>
                   
                        </div>
                   
                                    <?php
                
                                }
                            }
                    ?>
            </div>
           

        </form>
    </div>
</body>
</html>
