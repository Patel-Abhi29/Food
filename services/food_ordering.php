<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/foodcard.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Food Ordering</title>
    

</head>
<body>
<nav id="navbar">
        <div id="logo">
            <img class="logo" src="../img/image3.png" alt="MyOnlineMeal.com">
        </div>
        <ul>
            <li class="item"><a href="../index.php">Home</a></li>


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
            ?> <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>
                <li class="item"><a href="../login/logout.php">Log out</a></li>
            </ul>
            </div>
            <?php
            }
            ?>
            <li class="item"><a href="cart.php">My Cart</a></li>
            <li class="item"><a href="your_order.php">Your Orders</a></li>
        </ul>
</nav>
    <header class="header">
        <h1>Food Ordering</h1>
    </header>
    <section class="slide">
    <div class="slideshow-container">

<div class="mySlides fade">
 
  <img src="../img/pizzas.jpeg">
  >
</div>

<div class="mySlides fade">
 
  <img src="../img/burgers.jpg" >
  
</div>

<div class="mySlides fade">
  
  <img src="../img/pastrys.jpg" >
 
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
    </section>
<h1 style="text-align:center">Category :</h1>
<section class="category">
        <a href="category.php?category=pizza"><img src="../img/pizza.jpeg" width="100px" height="300px"></a>
        <a href="category.php?category=burger"><img src="../img/burger.jpeg" width="100px" height="300px"></a>
        <a href="category.php?category=pastry"><img src="../img/pastry2.jpeg" width="100px" height="300px"></a>
</section>

    <section>
    <?php



$servername = "localhost";
$username = "root";
$password = "";
$database = "food";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




    
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container-column">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="container">';
        echo '<img src="../admin/images/' . $row["image_path"] . '" alt="' . $row["product_type"] . '" />';
        echo '<div class="container__text">';
        echo '<div class="time">';
        echo '<div class="container_text_timing_time ">';
        echo '<h2 style="color:#351897;">' . $row["product_type"] . '</h2>';
        echo '</div>';
        echo '</div>';
        echo '<h2>' . $row["title"] . '</h2>';
        echo '<div class="container_text_star">';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '</div>';
        echo '<p class="desc">' . $row["descriptions"] . '</p>';
        echo '<div class="time">';
        echo '<div class="container_text_timing_time price">';
        echo '<h2>Price</h2>';
        echo '<p>Rs. ' . $row["price"] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<form action="orders.php" method="post" >';
        echo '<input type="hidden" name="add_to_cart" value="' . $row["id"] . '">';

            
        echo '<div class="quantity">';
        echo '<label for="quantity' . $row["id"] . '">Quantity:</label>';
        echo '<input class="quan" type="number" name="quantity" value="1">';
       
        echo '</div>';
        echo '<button  class="btn" type="submit">Order Now</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
      
    }
    echo '</div>';
} else {
    echo '<div class="text-gray-600 text-xl mt-4">No products found.</div>';
}



$conn->close();

?>

    </section>
    <script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 4000); // Change image every 4 seconds
}
</script>

</body>
</html>