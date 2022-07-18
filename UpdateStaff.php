<?php
include('config.php');
//retrieven data based on carried id
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
$id =  trim($_GET["id"]);
$sql = "SELECT * FROM STAFFS WHERE STAFF_ID = '$id' ";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$staffname = $row['STAFF_NAME'];
$staffphone = $row['STAFF_PHONE'];


//update row 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $staffname  = $_POST['staffname'];
    $staffphone = $_POST['staffphone'];


    $sql = "UPDATE STAFFS SET STAFF_NAME ='$staffname', STAFF_PHONE = '$staffphone' WHERE STAFF_ID ='$id'  ";
    $stid = oci_parse($conn,$sql);
    if(oci_execute($stid)){
    echo 'successfully update customer '; echo $id;
    }else{
    echo 'error';
}}}
?>
<h1>Update Customer</h1>
<form action="" method ="POST">
<label for="staffid">ID:</label><br>
  <input type="text" name="staffid" value="<?php echo $id; ?>" disabled><br>
  <label for="staffname">Name:</label><br>
  <input type="text" name="staffname" placeholder="Input staff name" value="<?php echo $staffname; ?>"><br>
  <label for="staffphone">Phone:</label><br>
  <input type="text" name="staffphone" placeholder="Input phone" value="<?php echo $staffphone; ?>" required><br>
  <input type="hidden" name="id" value="<?php echo $id; ?>"/>
  <input type="submit" value="Submit" name="submit">
</form> 


<?php

//SQL PREVIOUS PURCHASE BY THIS CUSTOMER

//table

?>