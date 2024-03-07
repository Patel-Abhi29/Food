<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Online Food dilivery services in India | MyOnlineMeal.com</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="css/phone.css">

</head>

<body>
    <nav id="navbar">
        <div id="logo">
            <img class="logo" src="img/image3.png" alt="MyOnlineMeal.com">
        </div>
        <ul>
            <li class="item"><a href="#home">Home</a></li>
            <li class="item"><a href="#srevices-container">Services</a></li>
                      
            <li class="item"><a href="#contact">Contact us</a></li>
            
            <?php
             session_start();
            if(isset($_SESSION["admin"]) && $_SESSION["admin"]==1 ){
                
                    ?>
                    <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>
                    
                    <div style="position:absolute; right:20px">   <ul>
                    <li class="item"><a href="./admin/admin.php">Admin control</a></li>
                    

                    <li class="item"><a href="./login/logout.php">Log out</a></li>
                    </ul>    
            </div>
                    <?php

                
              
                    
            }
      
            elseif (!isset($_SESSION["status"])){
                ?>
                <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="./login/sign_up.php">Sign Up</a></li>
                <li class="item"><a href="./login/login.php">Login</a></li>
                </ul>    
            </div>
                <?php
            }
            else{
                ?><div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>

                <li class="item"><a href="./login/logout.php">Log out</a></li>
                </ul>    
            </div>
                <?php
            }
            
            
            ?>
                        <li class="item"><a href="  services/your_order.php">Your Orders</a></li>

        </ul>

    </nav>
    <section id="home">
        <h1 class="h-primary">Welcome to MyOnlineMeal</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit sunt, ut consequuntur velit deleniti

        </p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>
        <button class="btn" onclick="location.href='./services/food_ordering.php'">Order Now</button>
    </section>

                
<?php
        require('connect.php');
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $products = array();
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                $product = array(
                'image_path' => $row["image_path"],
                'title' => $row["title"],
                'price' => $row["price"]
            );
            $products[] = $product;
        }
        } else {
            echo "No records found.";
        }
        $conn->close();
    ?>

    <section id="product-container">
        <button class="prev-btn" onclick="changeProduct(-1)">&#10094; Prev</button>

        <div class="carousel-container">
        
        <?php
        foreach ($products as $product) {
            echo '<div class="carousel">';
            echo '<a href="services/food_ordering.php" style="text-decoration:none; color:inherit">';
            echo '<img class="product-image" src="admin/images/' . $product["image_path"] . '" alt="' . $product["title"] . '">';
            echo '<h2 class="product-name">' . $product["title"] . '</h2>';
            echo '<p class="product-price">Rs. ' . $product["price"] . '</p>';
            echo '</a>';
            echo '</div>';
        }
        ?>
        
        </div>

            <button class="next-btn" onclick="changeProduct(1)">Next &#10095;</button>
    </section>






    <section id="srevices-container">
        <h1 class="h-primary center">Our services</h1>
        <div id="services">
            <a href="./services/food_ordering.php" class="atag">
            <div class="box">
                <img src="img/1.png" alt="">
                <h2 class="h-secondary center">Food ordering</h2>
                <p class="center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi tenetur, cupiditate
                    accusamus at expedita nobis unde eos. Neque voluptatibus ratione id quas velit reiciendis delectus,
                    laborum numquam ullam, dolorum tempora necessitatibus? Ipsam, quae sunt!
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident magni, aut quam nostrum nisi
                    cupiditate corporis mollitia alias eos illum illo. Culpa, aut.</p>
            </div>
            </a>
            <a href="./services/food_ordering.php" class="atag">
            <div class="box">
                <img src="img/2.png" alt="">
                <h2 class="h-secondary center">Food Catering </h2>
                <p class="center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi tenetur, cupiditate
                    accusamus at expedita nobis unde eos. Neque voluptatibus ratione id quas velit reiciendis delectus,
                    laborum numquam ullam, dolorum tempora necessitatibus? Ipsam, quae sunt!
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit laudantium optio corporis, quisquam,
                    ipsam aliquid labore ea ratione sequi pariatur odio sit dicta.</p>
            </div>
            </a>
            <a href="./services/food_ordering.php" class="atag">
            <div class="box">
                <img src="img/3.png" alt="">
                <h2 class="h-secondary center">Bulk ordering</h2>
                <p class="center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi tenetur, cupiditate
                    accusamus at expedita nobis unde eos. Neque voluptatibus ratione id quas velit reiciendis delectus,
                    laborum numquam ullam, dolorum tempora necessitatibus? Ipsam, quae sunt! Lorem ipsum dolor sit, amet
                    consectetur adipisicing elit. Quasi, nobis ut necessitatibus aliquam, veniam explicabo amet in fuga
                    delectus praesentium iste? Repellendus, perspiciatis!
                </p>
            </div>
        </a>
        </div>
    </section>

    <section id="contact">
        <h1 class="h-primary center">Contact Us</h1>
        <div id="contact-box">
            <form action="contact_us.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Enter Your Name">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email">
                </div>
                <div class="form-group">
                    <label for="number">Phone Number:</label>
                    <input type="phone" name="number" id="phone" placeholder="Enter Your Phone Number">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                <input type="submit">
                </div>
            </form>
        </div>
        <div>
       
        </div>
    </section>
    

   
    <footer>
        <div class="center">
            Copyright &copy; www.myOnlineMeal.com All Rights Reserved!
        </div>
    </footer>

   
  <!-- slider effect -->
    <script>
    const products = <?php echo json_encode($products); ?>;
    let currentIndex = 0;
    const numProducts = products.length;

   function displayProduct(index) {
          const productElements = document.querySelectorAll('.carousel');
   
          for (let i = 0; i < productElements.length; i++) {
              const product = products[(index + i) % numProducts];
              const element = productElements[i];
   
              const img = element.querySelector('.product-image');
              const name = element.querySelector('.product-name');
              const price = element.querySelector('.product-price');
   
              img.src = './admin/images/' + product.image_path;
              img.alt = product.title;
              name.innerText = product.title;
              price.innerText = 'Rs. ' + product.price;
          }
      }
   

    function changeProduct(direction) {
        currentIndex = (currentIndex + direction + numProducts) % numProducts;
        displayProduct(currentIndex);
    }

    function autoChangeProduct() {
        currentIndex = (currentIndex + 1) % numProducts;
        displayProduct(currentIndex);
    }

    // Automatically change product every 5 seconds
    setInterval(autoChangeProduct, 5000);

    displayProduct(currentIndex);
</script>
</body>

</html>

