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
        .button {
            color: whitesmoke;
            background-color: red;
            color:white;
            width:60%;
            padding:5px;
            border:2px solid black;
        }
        
        .button:hover {
            color: black;
        }
        .button:disabled{
            border: 1px solid #999999;
            background-color: #cccccc;
            color: #666666;
        }
    </style>
</head>

<?php
 $conn = mysqli_connect("localhost","root","","id17337825_library");
 if($conn->connect_error) {
     die("Connection Failed:".$conn->connect_error);
 }
 $status = mysqli_real_escape_string($conn,$_GET["status"]);
 session_start();
 $email = $_SESSION['email'];
 $name = $_SESSION['name'];
 $flag=0;
 $sql = "SELECT * from records where returndate IS NULL AND username='$email';";
 $result = $conn->query($sql);
 if($result->num_rows > 0){
     $flag=1;
 }
 if(isset($_GET['bid'])){
    $bid = $_GET['bid'];
    $sql = "SELECT * from books WHERE bid=$bid";
    $result=$conn->query($sql);
    $row = $result->fetch_assoc();
    $bname = $row['bname'];
    $author = $row['author'];
    $sql = "INSERT INTO cart values('$email','$bid','$bname','$author')";
    $conn->query($sql);
 }
?>

<ul>
    <li><a href="Userhome.php"><i class="fas fa-home" style="color: white;"> Home</i></a></li>
    <li style="float: right;"><a href="index.html"><i class="fas fa-sign-out-alt" style="color: white;"> Logout</i></a></li>
    <li class="noHover" style="float: right"><i class="fas fa-user" style="margin-right:2px;"></i> <?php echo $name?></li>
</ul>

<br>
<br>
<br>

<?php
    if($status==0){
?>
<h1 style="text-align:center;font-size:120%">It's only out of stock for now, but you can add to cart to view its availability!!</h1>
<?php }?>

<?php
    if($status==1 and $flag==1){?>
    <h1 style="text-align:center;font-size:120%">You have not returned the previous book yet. Return it to proceed renting further!!</h1>
<?php

    }
?>

<table style="width:98%; margin-left:1%">
    <tr>
        <th>Sr. No</th>
        <th>Book ID</th>
        <th>Book Name</th>
        <th>Author</th>
        <th></th>
    </tr>
    <?php
        $sql = "SELECT * from books where status=$status;";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $sno = 1;
            $flag1=1;
            while($row = $result->fetch_assoc()) { 
                $var = $row['bid'];
                $sql1 = "SELECT * from records where returndate IS NULL AND username='$email' AND bid=$var";
                $result1 = $conn->query($sql1);
                if($result1->num_rows > 0){
                    continue;
                }?>
            <tr>
                <?php $flag1=0?>
                <td><?php echo $sno;?></td>
                <td><?php echo $row['bid'];?></td>
                <td><?php echo $row['bname'];?></td>
                <td><?php echo $row['author'];?></td>
                <?php if($status==1) { ?>
                <td><a href="rentSuccess.php?bid=<?php echo $row['bid']?>"><button class="button" <?php if($flag==1){?> disabled <?php } ?> >Borrow</button></a></td>  
                <?php }
                else{
                    $temp = $row['bid'];
                    $flag2=0;
                    $sql2 = "SELECT * from cart WHERE bid=$temp AND email='$email';";
                    $result2 = $conn->query($sql2);
                    if($result2->num_rows > 0){
                        $flag2=1;
                    }
                    if($flag2==0){
                ?>
                <td><a href="viewBooks.php?status=0&bid=<?php echo $temp?>"><i style="background-color:red;padding:7px 20px;color: black">Add to Cart</i></a></td>
                <?php } else { ?>
                <td><i style="background-color:green;padding:7px 20px;color: black">Added</i></td>
                <?php }
                } ?>         
            <tr>
    <?php   $sno = $sno + 1;
            }
        }
        if($result->num_rows<=0 or $flag1==1){?>
            <tr>
                <td colspan="8">No Books Available!!</td>
            <tr>
    <?php }
        $conn-> close();
    ?> 
</table>
<br>