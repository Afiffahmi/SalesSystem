<?php
include('config.php');

$sql = "SELECT COUNT(STAFF_ID) AS COUNT FROM STAFFS";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$laststaff = $row["COUNT"];
$tempstaff = $laststaff + 1;
$temp = (string) $tempstaff ;
$staffcode = "S0";
$newstaff = $staffcode.$temp;
$templaststaff = (string) $laststaff ;
$laststafffinal = $staffcode.$templaststaff;

$sql = "SELECT * FROM STAFFS WHERE STAFF_ID = '$laststafffinal'";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$laststaffname = $row["STAFF_NAME"];

if(isset($_POST['submit'])){
$staffname = $_POST['staffname'];
$staffphone = $_POST['staffphone'];
$file = rand(1000,100000)."-".$_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$folder="img/staff/";
$new_size = $file_size/1024;  
$new_file_name = strtolower($file);
$final_file=str_replace(' ','-',$new_file_name);
if(move_uploaded_file($file_loc,$folder.$final_file)){
$fetch = "INSERT INTO STAFFS (STAFF_ID,STAFF_NAME,STAFF_PHONE,ATTACHMENT,TYPE_FILE,SIZE_FILE) VALUES ('$newstaff','$staffname','$staffphone','$final_file','$file_type','$new_size')";
$stid = oci_parse($conn,$fetch);
if(oci_execute($stid)){
    echo 'successfully';
}
}else{
    echo 'error';
}

}

?>
<h1>Create new attribute</h1>

<form action="" method ="POST" data-validate="parsley" enctype="multipart/form-data">
<label for="staffid">ID:</label><br>
  <input type="text" name="staffid" value="<?php echo $newstaff; ?>" disabled><br>
  <label for="staffname">Name:</label><br>
  <input type="text" name="staffname" placeholder="Input customer name"><br>
  <label for="staffphone">Phone:</label><br>
  <input type="text" name="staffphone" placeholder="Input phone"><br>
  <input type="file" name="file" data-required="true" />
  <input type="submit" value="Submit" name="submit">
</form> 

<h3>Previous staff registered </h3>
<p>Staff ID :<?php echo $laststafffinal; ?></p>
<p>Staff Name :<?php echo $laststaffname; ?></p>