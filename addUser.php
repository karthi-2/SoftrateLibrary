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
?>

<ul>
    <li><a href="index.html"><i class="fas fa-home" style="color: white;"> Home</i></a></li>
</ul>

<div style="padding: 10px 60px; border: 2px solid black;background-color: white;opacity: 0.9; width: fit-content;margin-left: 38%;margin-top: 12%;">
    <form method="post">
        <h1 style="text-align: center;font-size: 120%;">Sign Up</h1>
        <br>
        <label for="name">Name: </label>
        <input type="text" name="name" placeholder="Enter your Name" style="margin-left: 5px;" required>
        <br><br><br>
        <label for="email"> Mail ID: </label>
        <input type="email" name="email" placeholder="Enter your Mail ID" style="margin-left: 5px;" required>
        <br><br><br>
        <label for="password"> Password: </label>
        <input type="password" name="password" placeholder="Enter your Password" style="margin-left: 5px;" required>
        <br><br><br>
        <input type="submit" value="SignUp" class="button">
    </form>
</div>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pswd = $_POST['password'];
        $sql = "INSERT into users VALUES('$name','$email','$pswd','User')";
        $result = $conn->query($sql);
        if(!$result){?> 
        <script>
            alert("Account already Exists!!")
        </script>        
    <?php }
    else {?>
    <script>
        alert("Account Created!! Sign in to Continue.")
    </script>
    <?php 
         header("Refresh:0;url=login.php?mode=User");
    }
    }
?>