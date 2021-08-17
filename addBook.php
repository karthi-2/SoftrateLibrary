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
        .button{
            background-color:black;
            color:white;
            padding:7px; 
            width:30%;
        }
        .button:hover{
            color: coral;
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
    <li><a href="memberHome.php"><i class="fas fa-home" style="color: white;"> Home</i></a></li>
</ul>

<div style="padding: 10px 60px; border: 2px solid black;background-color: white;opacity: 0.9; width: fit-content;margin-left: 38%;margin-top: 12%;">
    <form method="post">
        <h1 style="text-align: center;font-size: 120%;">Enter the book details below!!</h1>
        <br>
        <label for="bid">Book ID: </label>
        <input type="number" name="bid" placeholder="Enter Book ID" style="margin-left: 5px;" required>
        <br><br><br>
        <label for="bname">Book Name: </label>
        <input type="text" name="bname" placeholder="Enter Book Name" style="margin-left: 5px;" required>
        <br><br><br>
        <label for="author"> Author: </label>
        <input type="text" name="author" placeholder="Enter Author Name" style="margin-left: 5px;" required>
        <br><br><br>
        <input type="submit" value="Create" class="button">
    </form>
</div>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $bid = $_POST['bid'];
        $bname = $_POST['bname'];
        $author = $_POST['author'];
        $status = 1;
        $sql = "INSERT into books VALUES('$bid','$bname','$author','$status')";
        $result = $conn->query($sql);
        if(!$result){?> 
        <script>
            alert("Book already Exists!!")
        </script>        
    <?php }
    else {
         header("Refresh:0;url=memberHome.php");
    }
    }
?>
