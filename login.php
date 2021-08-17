<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <title>Softrate Library</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="./Images/logo.jpg" type="image/x-icon">
    <style>
        body {
            background-image: url("Images/menu.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        .button {
            color: whitesmoke;
            background-color: black;
            padding:8px;
            width:50%;
            margin-left: 25%;
        }
        
        .button:hover {
            color: coral
        }
    </style>
</head>
<?php
$conn = mysqli_connect("localhost","root","","id17337825_library");
if($conn->connect_error) {
    die("Connection Failed:".$conn->connect_error);
}
$mode = mysqli_real_escape_string($conn,$_GET["mode"]);
session_start();
$_SESSION['mode']=$mode;
?>

<ul>
    <li><a href="index.html"><i class="fas fa-home" style="color: white;"> Home</i></a></li>
    <?php if($mode=='User'){?>
    <li style="float:right"><a href="addUser.php"><i class="fas fa-user" style="color:white"> SignUp</i> </a></li>
    <?php }?>
</ul>

<div style="padding: 10px 60px; border: 2px solid black;background-color: white;opacity: 0.9; width: fit-content;margin-left: 38%;margin-top: 12%;">
    <form method="post">
    <?php if($mode=='User') { ?>
        <h1 style="text-align: center;font-size: 120%;">User Login</h1>
        <?php } else { ?>
            <h1 style="text-align: center;font-size: 120%;">Admin Login</h1>
        <?php } ?>
        <?php if($mode=='User'){?>
        <img src="./Images/use.png" style="height:60px;width: 60px;margin-left: 35%;">
        <?php }
        else { ?>
        <img src="./Images/member.png" style="height:60px;width: 60px;margin-left: 35%;">
        <?php }?> 
        <br><br>
        <label for="email"><i class="fas fa-user"> </i></label>
        <input type="email" name="email" placeholder="Enter your Mail ID" style="margin-left: 5px;" required>
        <br><br><br>
        <label for="password"><i class="fas fa-unlock"></i></label>
        <input type="password" name="password" placeholder="Enter your Password" style="margin-left: 5px;" required>
        <br><br><br>
        <input type="submit" value="Login" class="button">
    </form>
</div>
<br>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email = $_POST['email'];
        $pswd = $_POST['password'];
        $sql = "SELECT * from users";
        $result = $conn->query($sql);
        $flag=0;
        while($row = $result->fetch_assoc()){
            if($row['mailid']==$email and $row['pswd']==$pswd and $mode==$row['mode']){
                $flag=1;
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                if($mode=='User'){
                    header("Refresh:0;url=Userhome.php");
                }
                else{
                    header("Refresh:0;url=memberHome.php");
                }
                break;
            }
        }
        if($flag==0){
?>
        <script>
            alert("Oops, The Credentials are not correct!!");
        </script>
<?php
        }
    }
?>