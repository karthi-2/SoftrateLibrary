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
 session_start();
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
?>
<ul>
    <li><a href="Userhome.php"><i class="fas fa-home" style="color: white;"> Home</i></a></li>
    <li style="float: right;"><a href="index.html"><i class="fas fa-sign-out-alt" style="color: white;"> Logout</i></a></li>
    <li class="noHover" style="float: right"><i class="fas fa-user" style="margin-right:5px;"></i><?php echo $name?></li>
</ul>
<br>
<br>
<br>

<table style="width:98%; margin-left:1%">
    <tr>
        <th>Sr. No</th>
        <th>Book ID</th>
        <th>Book Name</th>
        <th>Author</th>
        <th>Status</th>
    </tr>
    <?php
        $sql = "SELECT * from cart WHERE email='$email';";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $sno = 1;
            while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $sno;?></td>
                <td><?php echo $row['bid'];?></td>
                <td><?php echo $row['bname'];?></td>
                <td><?php echo $row['author'];?></td>
                <?php
                $temp = $row['bid']; 
                $sql2 = "SELECT * from books where bid=$temp";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();

                $flag9=0;
                $sql9 = "SELECT * from records where returndate IS NULL AND username='$email';";
                $result9 = $conn->query($sql9);
                if($result9->num_rows > 0){
                $flag9=1;
                }

                if($row2['status']==1){?>
                <td><a href="rentSuccess.php?bid=<?php echo $row['bid']?>&del=1"><button class="button" <?php if($flag9==1) { ?> disabled <?php } ?>>Borrow</button></a></td>
               <?php } else { ?>
                <td>Not Available</td>
                <?php
               }
                ?> 
            </tr>
    <?php   $sno = $sno + 1;
            }
        }
        else{?>
            <tr>
                <td colspan="8">No Books Available!!</td>
            <tr>
    <?php }
        $conn-> close();
    ?> 
</table>
<br>