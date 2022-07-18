<!DOCTYPE html>    
<html>    
<head>    
<link rel="stylesheet" href="Slogin.css">    
    <title>LOG IN</title>    

</head>    
<?php
include('config.php');
if(isset($_POST['submit'])){
$username = $_POST['username'];
$password = $_POST['password'];
$fetch = "SELECT STAFF_NAME FROM STAFFS WHERE STAFF_ID = '$username' AND PASSWORDS = '$password' ";
$stid = oci_parse($conn,$fetch);
oci_execute($stid);
$count = oci_num_fields($stid);;
if($count == 1){
  echo "<script type='text/javascript'>location.href = 'report.php';</script>";
}else{
    echo 'error';
}}

?>
<body>    

    <div class="main">
    <img src="images/pic5.jpg" class="logo">

        <h2>STAFF LOG IN</h2> 
        <form method="POST">
            <input type="text" name="username" placeholder="Enter Username" required>       
            <input type="password" name="password" placeholder="Enter Password" required>      
            <input type="submit" name="submit" value="submit">

             <a class="back-button" href="Sindex.html">Back</a> 
             </form>
        <div class="centered-main">
            <p>New staff ? -</p>
            <a class="user-button" href="register.html">Click Here</a>
        </div> 
    </div>    

</body>    
</html>     
