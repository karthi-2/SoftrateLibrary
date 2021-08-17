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
        <th>Date Purchased</th>
        <th>Date Returned</th>
    </tr>
    <tr>
        <?php
        $sql = "SELECT * from records WHERE username = '$email' AND returndate IS NULL;"; 
        $result = $conn->query($sql);
        $flag5=1;
        $sno = 1;
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()) { 
                $flag5 = 0;
                ?>
            
            <tr style="background-color: red;">
                <td><?php echo $sno;?></td>
                <td><?php echo $row['bid'];?></td>
                <td><?php echo $row['bookname'];?></td>
                <td><?php echo $row['authorname'];?></td>
                <td><?php echo $row['buydate'];?></td>
                <?php if($row['returndate']==NULL){?>
                    <td>Not yet Returned</td>
                <?php } else { ?>
                <td><?php echo $row['returndate'];?></td>
                <?php }
                $sno+=1; 
                }
            }?>
            </tr>
           <?php 
           $sql = "SELECT * from records WHERE username = '$email' AND returndate IS NOT NULL;"; 
            $result = $conn->query($sql);
            if($result->num_rows>0){
            while($row = $result->fetch_assoc()) { 
                $flag5 = 0;?>
            <tr>
                <td><?php echo $sno;?></td>
                <td><?php echo $row['bid'];?></td>
                <td><?php echo $row['bookname'];?></td>
                <td><?php echo $row['authorname'];?></td>
                <td><?php echo $row['buydate'];?></td>
                <?php if($row['returndate']==NULL){?>
                    <td>Not yet Returned</td>
                <?php } else { ?>
                <td><?php echo $row['returndate'];?></td>
            </tr>
            <?php
                }
                $sno = $sno + 1;
            }
            echo "</table>";
            }
        if ($flag5==1) { ?>
        <tr>
            <td colspan="8">No Records Yet!!</td>
        </tr>
        <?php } ?>
    </tr>
</table>
<br>