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
<br>
<br>
<?php
    $conn = mysqli_connect("localhost","root","","id17337825_library");
    if($conn->connect_error) {
        die("Connection Failed:".$conn->connect_error);
    }
    session_start();
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $bid = mysqli_real_escape_string($conn,$_GET["bid"]);
    if(isset($_GET['del'])){
        $sql = "DELETE FROM cart WHERE bid = $bid AND email='$email';";
        $conn->query($sql);
    }
    date_default_timezone_set("Asia/kolkata");
    $currentDate = date("Y/m/d");
    $sql = "SELECT bname,author from books WHERE bid=$bid";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    $bname=$row['bname'];
    $author=$row['author'];
    $sql = "INSERT into records VALUES('$email','$name','$bid','$bname','$author','$currentDate',NULL)";
    $result=mysqli_query($conn,$sql);
    $val = 0;
    $sql = "UPDATE books SET status = $val WHERE bid=$bid";
    $result = mysqli_query($conn,$sql);
    $sql = "SELECT * from cart WHERE bid=$bid AND email='$email';";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $sql = "DELETE FROM cart WHERE bid=$bid AND email='$email';";
        $conn->query($sql);
    }
?>

<ul>
    <li><a href="Userhome.php"><i class="fas fa-home" style="color: white;"> Home</i></a></li>
    <li style="float: right;"><a href="index.html"><i class="fas fa-sign-out-alt" style="color: white;"> Logout</i></a></li>
    <li class="noHover" style="float: right"><i class="fas fa-user" style="margin-right:2px;"></i> <?php echo $name?></li>
</ul>

<br><br>
<br><br>
<br><br>

<h1 style="text-align: center; font-size: 130%;">The Book has been successfully purchased!!</h1>
<br>
<h1 style="font-size: 130%; margin-left:37%">Details:</h1>

<div> 
    <table style="margin-left:37%; float: left;">
        <tr>
            <th>Name of the book</th>
            <td>
                <?php echo $bid?>
            </td>
        </tr>
        <tr>
            <th>Name of the book</th>
            <td>
                <?php echo $bname?>
            </td>
        </tr>
        <tr>
            <th>Author</th>
            <td>
                <?php echo $author?>
            </td>
        </tr>
        <tr>
            <th>Date</th>
            <td>
                <?php echo $currentDate?>
            </td>
        </tr>
    </table>
</div>