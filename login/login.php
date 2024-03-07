<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
<div class="container">
<div class="signup">
        <h1 style="margin-top: 15px;">Login Here</h1>
        <form action="authentication.php" method="post">
            <label for="email">Email:</label>
            <input type="email" placeholder="abc@gmail.com" name="email" id="email">
           
            <label for="password">Password:</label>
            <input type="password"  name="password" id="password" >

             <input type="submit" id="btn" >
        </form>

    </div>
</div>
</body>
</html>