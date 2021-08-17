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
    <li><a href="memberHome.php"><i class="fas fa-home" style="color: white;"> Home</i></a></li>
</ul>

<br><br><br>
<table style="width:98%; margin-left:1%">
    <tr>
        <th>Sr. No</th>
        <th>Name</th>
        <th>Book ID</th>
        <th>Book Name</th>
        <th>Author</th>
        <th>Date purchased</th>
    </tr>
    <?php
        $sql = "SELECT * from records WHERE returndate IS NULL;";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $sno = 1;
            while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $sno;?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['bid'];?></td>
                <td><?php echo $row['bookname'];?></td>
                <td><?php echo $row['authorname'];?></td>
                <td><?php echo $row['buydate'];?></td>       
            <tr>
    <?php   $sno = $sno + 1;
            }
        }
        else{?>
            <tr>
                <td colspan="8">No Current Users!!</td>
            <tr>
    <?php }
        $conn-> close();
    ?> 
</table>
<br>