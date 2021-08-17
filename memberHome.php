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
            width:90%;
            padding:5px;
            border: 2px solid black;
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
 if(isset($_GET['bid'])){
     $bid = $_GET['bid'];
     $sql = "UPDATE books SET status=1 WHERE bid = $bid";
     $conn->query($sql);
     date_default_timezone_set("Asia/kolkata");
     $currentDate = date("Y/m/d");
     $sql = "UPDATE records SET returndate = '$currentDate' WHERE bid = $bid AND returndate IS NULL";
     $conn->query($sql);
 }
 if(isset($_GET['delbid'])){
    $delbid = $_GET['delbid'];
    $sql = "DELETE FROM books WHERE bid = $delbid";
    $conn->query($sql);
}
?>

<ul>
    <li style="float: right;"><a href="index.html"><i class="fas fa-sign-out-alt" style="color: white;"> Logout</i></a></li>
    <li class="noHover" style="float: right"><i class="fas fa-user" style="margin-right:2px;"></i> <?php echo $name?></li>
    <li><a href="currentUsers.php"><i class="fas fa-users" style="color:white"> Records</i></a></li>
    <li><a href="addBook.php"><i class="fas fa-plus" style="color:white"> Add Book</i></a></li>
</ul>

<br><br><br>
<table style="width:98%; margin-left:1%">
    <tr>
        <th>Sr. No</th>
        <th>Book ID</th>
        <th>Book Name</th>
        <th>Author</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        $sql = "SELECT * from books;";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $sno = 1;
            while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $sno;?></td>
                <td><?php echo $row['bid'];?></td>
                <td><?php echo $row['bname'];?></td>
                <td><?php echo $row['author'];?></td>
                <?php if($row['status']==1) { ?>
                    <td><i style = "background-color:green;width:fit-content;padding:10px"><?php echo "Available";?></td>
                <?php } else { ?>
                <td><a href = "memberHome.php?bid=<?php echo $row['bid'];?>"><i style = "background-color:red;width:fit-content;padding:10px;color: black"><?php echo "Make Available";?></i></a></td>
                <?php } ?>
                <td><a href = 'editBook.php?bid=<?php echo $row['bid'];?>'><button class="button"<?php if($row['status']==0) { ?> disabled <?php } ?>> <i class="fas fa-edit"></i> Edit</button></a></td>
                <td><a href = "memberHome.php?delbid=<?php echo $row['bid'];?>"><button class="button" <?php if($row['status']==0) { ?> disabled <?php } ?> ><i class="fas fa-trash"></i> Delete</button></a></td>        
            <tr>
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