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
$total=0;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Checkout</title>
</head>

<body>

    <button class="absolute top-7 left-7 bg-[#ff6666] text-white py-2 px-4 rounded-lg z-50" onclick="location.href='cart.php'">My Cart</button>


    <div class="relative mx-auto w-full bg-[#ffe6e6]">
        <div class="grid min-h-screen grid-cols-10">
            <div class="col-span-full py-6 px-4 sm:py-12 lg:col-span-6 lg:py-24">
                <div class="mx-auto w-full max-w-lg">
                    <h1 class="relative text-2xl font-medium text-gray-700 sm:text-3xl">Secure Checkout<span class="mt-2 block h-1 w-10 bg-[#ff6666] sm:w-20"></span></h1>
                    <form action="product_status.php" method="POST" class="mt-10 flex flex-col space-y-4">
                        <div><label for="email" class="text-xs font-semibold text-gray-500">Email</label><input type="email" id="email" name="email" placeholder="john.capler@fang.com" class="mt-1 block w-full rounded border-gray-300 bg-gray-50 py-3 px-4 text-sm placeholder-gray-300 shadow-sm outline-none transition focus:ring-2 focus:ring-[#ff6666]" /></div>
                        <div class="relative"><label for="card-number" class="text-xs font-semibold text-gray-500">Card number</label><input type="text" id="card-number" name="card-number"  pattern="[0-9]{16}" maxlength="16" minlength="16"  placeholder="1234-5678-XXXX-XXXX" class="block w-full rounded border-gray-300 bg-gray-50 py-3 px-4 pr-10 text-sm placeholder-gray-300 shadow-sm outline-none transition focus:ring-2 focus:ring-[#ff6666]" /><img src="/images/uQUFIfCYVYcLK0qVJF5Yw.png" alt="" class="absolute bottom-3 right-3 max-h-4" /></div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Expiration date</p>
                            <div class="mr-6 flex flex-wrap">
                                <div class="my-1">
                                    <label for="month" class="sr-only">Expiration month</label>
                                    <input type="text" id="month"  name="month" placeholder="Expiration month" maxlength="2" minlength="2" class="cursor-pointer w-36 rounded border-gray-300 bg-gray-50 py-3 px-4 text-sm placeholder-gray-300 shadow-sm outline-none transition focus:ring-2 focus:ring-[#ff6666]">
                                </div>
                                <div class="my-1 ml-3 mr-6">
                                    <label for="year" class="sr-only">Expiration year</label>
                                    <input type="text" maxlength="4" minlength="4" id="year" name="year" placeholder="Expiration year" class="cursor-pointer w-36 rounded border-gray-300 bg-gray-50 py-3 px-4 text-sm placeholder-gray-300 shadow-sm outline-none transition focus:ring-2 focus:ring-[#ff6666]">
                                </div>

                                <div class="relative my-1"><label for="security-code" class="sr-only">Security code</label><input type="text" id="security-code" name="security-code" maxlength="3" minlength="3" placeholder="Security code" class="block w-36 rounded border-gray-300 bg-gray-50 py-3 px-4 text-sm placeholder-gray-300 shadow-sm outline-none transition focus:ring-2 focus:ring-[#ff6666]" /></div>
                            </div>
                        </div>
                        <div><label for="card-name" class="sr-only">Card name</label><input type="text" id="card-name" name="card-name" placeholder="Name on the card" class="mt-1 block w-full rounded border-gray-300 bg-gray-50 py-3 px-4 text-sm placeholder-gray-300 shadow-sm outline-none transition focus:ring-2 focus:ring-[#ff6666]" /></div>
                    
                    <p class="mt-10 text-center text-sm font-semibold text-gray-500">By placing this order you agree to the <a href="#" class="whitespace-nowrap text-[#ff6666] underline hover:text-[#ff6666]">Terms and Conditions</a></p>
                    <button type="submit" class="mt-4 inline-flex w-full items-center justify-center rounded bg-[#ff6666] py-2.5 px-4 text-base font-semibold tracking-wide text-white text-opacity-80 outline-none ring-offset-2 transition hover:text-opacity-100 focus:ring-2 focus:ring-[#ff6666] sm:text-lg">Place Order</button>
               
                </div>

            </div>
            <div class="relative col-span-full flex flex-col py-6 pl-8 pr-4 sm:py-12 lg:col-span-4 lg:py-24">

                <div>
                    <div class="absolute inset-0 h-full w-full bg-[#ff6666] opacity-95"></div>
                </div>
                <div class="relative">
                <ul class="space-y-5">
    <?php
    $product_arr= array();

    if(isset($_POST['checkbox']) && is_array($_POST['checkbox'])){
    foreach($_POST['checkbox'] as $productid){
        $sql="SELECT * FROM carts INNER JOIN products on carts.product_id = products.id WHERE carts.user_id=$user_id AND products.id=$productid" ;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
       
        $product_arr[] =  $productid; 
            //  $total  = $total + $row['quantity'] * $row['price'];
            ?>
            <li class="flex justify-between items-center">
                <div class="inline-flex">
                    <img src="<?php echo '../admin/images/'. $row['image_path']; ?>" alt="<?php echo $row['product_type']; ?>" class="max-h-16" />
                    <div class="ml-3">
                        <p class="text-base font-semibold text-white"><?php echo $row['title']; ?></p>
                        <p class="text-sm font-medium text-white text-opacity-80"><?php echo $row['product_type']; ?></p>
                    </div>
                </div>
                <div class="flex items-center">
                    <p class="text-sm font-semibold text-white mr-2"> <?php echo $row['quantity']; ?> x</p>
                    <p class="text-sm font-semibold text-white">Rs <?php echo $row['price'] ?></p>
                </div>
            </li>
        <?php 
            $total += $row['quantity'] * $row['price'];
    
    }
     $_SESSION['product_arr']= $product_arr;
            }
            ?>
</ul>
                    <div class="my-5 h-0.5 w-full bg-white bg-opacity-30"></div>
                    <div class="space-y-2">
                        <p class="flex justify-between text-lg  font-bold text-white"><span>Total price:</span><span class="summary-value text-white">Rs <?php echo $total ?></span></p>
                
                    </div>
                </div>
                <input type="hidden" name="total" value="<?php echo $total ?>">
                </form>
                <div class="relative mt-10 text-white">
                    <h3 class="mb-5 text-lg font-bold">Support</h3>
                    
                    <p class="mt-1 text-sm font-semibold">support@nanohair.com <span class="font-light">(Email)</span></p>
                    <p class="mt-2 text-xs font-medium">Email us now for payment related issues</p>
                </div>
                <div class="relative mt-10 flex">
                    <p class="flex flex-col"><span class="text-sm font-bold text-white">Money Back Guarantee</span><span class="text-xs font-medium text-white">within 30 days of purchase</span></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>