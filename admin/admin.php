<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .logo {
            width: 70px;
            height: 100px;
            border-radius: 20px;
        }

        /* Navbar */
        #navbar {
            display: flex;
            align-items: center;

            top: 0px;
            font-family: "Gill Sans Extrabold", sans-serif;
            position: sticky;
        }

        /* Navbar :Logo and image */
        #logo {
            margin: 10px 34px;

        }

        #logo img {
            height: 59px;
            margin: 3px 6px;
        }

        /* Navbar List styling */
        #navbar ul {
            display: flex;

        }

        #navbar::before {
            content: "";
            background-color: black;
            position: absolute;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            z-index: -1;
            opacity: 0.7;

        }

        #navbar {
            z-index: 10;
        }

        #navbar ul li {
            list-style: none;
            font-size: 1.3rem;
        }

        #navbar ul li a {
            color: white;
            display: block;
            padding: 3px 22px;
            border-radius: 20px;
            text-decoration: none;
        }

        #navbar ul li a:hover {
            color: black;
            background-color: white;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

<body class="bg-[#ffe6e6]">
<nav id="navbar">
        <div id="logo">
            <img class="logo" src="../img/image3.png" alt="MyOnlineMeal.com">
        </div>
        <ul>
            <li class="item"><a href="../index.php">Home</a></li>
         

            <?php
            session_start();
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {

            ?>
                <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>
                <li class="item"><a href="product/insert.php">Add </a></li>
                <li class="item"><a href="approve.php">Approve</a></li>

                <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="../login/logout.php">Log out</a></li>
                </ul>
            </div>
            <?php




            } elseif (!isset($_SESSION["status"])) {
            ?>   <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="../login/sign_up.php">Sign Up</a></li>
                <li class="item"><a href="../login/login.php">Login</a></li>
            </ul>
            </div>
           <?php
            } else {
            ?>
                <li class="item"><a href="#"><?php echo $_SESSION["email"] ?> </a></li>
                <div style="position:absolute; right:20px">   <ul>
                <li class="item"><a href="../login/logout.php">Log out</a></li>
                </ul>
            </div>
            <?php
            }


            ?>

        </ul>

    </nav>
    <div class="container mx-auto ">
      
        <?php
       
        $conn = new mysqli('localhost', 'root', '', 'food');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="overflow-x-auto ">';
            echo '<table class="  table-auto w-80  shadow-md rounded-lg mx-auto " style="width: 80%;">';
            echo '<thead>';
            echo '<tr class="bg-[#ff6666]">';
            echo '<th class="px-4 py-2 border">No.</th>';
            echo '<th class="px-4 py-2 border">Product Type</th>';
            echo '<th class="px-4 py-2 border">Title</th>';
            echo '<th class="px-4 py-2 border">Description</th>';
            echo '<th class="px-4 py-2 border">Price</th>';
            echo '<th class="px-4 py-2 border">Image</th>';
            echo '<th class="px-4 py-2 border">Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            $rowNumber = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr class="hover:bg-gray-100">';
                echo '<td class="px-4 py-2 border">' . $rowNumber++ . '</td>';
                echo '<td class="px-4 py-2 border">' . $row['product_type'] . '</td>';
                echo '<td class="px-4 py-2 border">' . $row['title'] . '</td>';
                echo '<td class="px-4 py-2 border">' . $row['descriptions'] . '</td>';
                echo '<td class="px-4 py-2 border">₹' . $row['price'] . '</td>';
                echo '<td class="  border"><img src="images/' . $row['image_path'] . '" alt="Product Image" class="w-20 h-20 object-cover rounded"></td>';
                echo '<td class="px-4 py-2 border">';
                ?>
                <a href="Product/update_product.php?product_id=<?php echo $row['id']?>" class="btn" style="color:#ff6666;padding-right:3px"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="product/delete.php?product_id=<?php echo $row['id']?>" class="btn" style="color:#ff6666"><i class="fa fa-trash" aria-hidden="true" ></i></a>
                <?php

                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="text-gray-600 text-xl mt-4">No products found in the database.</div>';
        }

        
        $conn->close();
        ?>
</body>

</html>