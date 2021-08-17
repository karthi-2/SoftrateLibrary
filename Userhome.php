<head>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Softrate Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="icon" href="./Images/logo.jpg" type="image/x-icon">
    <style>
        body {
            background-color: coral;
        }
    </style>
</head>

<?php
    $conn = mysqli_connect("localhost","root","","id17337825_library");
    if($conn->connect_error) {
        die("Connection Failed:".$conn->connect_error);
    }
    session_start();
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
?>

<ul>
    <li style="float: right;"><a href="index.html"><i class="fas fa-sign-out-alt" style="color: white;"> Logout</i></a></li>
    <li class="noHover" style="float: right"><i class="fas fa-user" style="margin-right:2px;"></i> <?php echo $name?></li>
</ul>

<div style="margin-top: 3%;margin-left: 17%; margin-top: 15%;">
    <a href="bookMenu.php"><img src="./Images/books.jpg" style="height: 30%; width: 20%; border: 2px solid black;"></a>
    <a href="viewRecords.php"><img src="./Images/his.jpg" style="height: 30%; width: 20%; border: 2px solid black;margin-left: 10%"></a>
    <a href="viewCart.php"><img src="./Images/cart.png" style="height: 30%; width: 20%; border: 2px solid black;margin-left: 10%"></a>
    <br>
    <i style="color: white;margin-left: 8%;">Books</i>
    <i style="color: white; margin-left: 26%;">Records</i>
    <i style="color: white; margin-left: 28%;">Cart</i>
</div>