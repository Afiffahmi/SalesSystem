<?php
include('config.php');

if(isset($_POST['submit'])){
    if(isset($_POST['category'])){
        $category = $_POST['category'];
        $sql = "SELECT COUNT(PRODUCT_ID) AS COUNT FROM PRODUCTS";
        $stid = oci_parse($conn,$sql);
        $result = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
        $lastproduct = $row["COUNT"];
        $temp = $lastproduct + 1;
        $temp = (string) $temp ;

        if($category == 1){
            $categoryname = "Notebook";
            $categorycode = "N0";
            $newproduct = $categorycode.$temp;
        }elseif($category == 2){
            $categoryname = "Totebag";
            $categorycode = "T0";
            $newproduct = $categorycode.$temp;
        }elseif($category == 3){
            $categoryname = "Iron On Sticker";
            $categorycode = "F0";
            $newproduct = $categorycode.$temp;
        }elseif($category == 4){
            $categoryname = "Art Class";
            $categorycode = "A0";
            $newproduct = $categorycode.$temp;
        }elseif($category == 5){
            $categoryname = "Digital Class" ;
            $categorycode = "C0";
            $newproduct = $categorycode.$temp;
        }elseif($category == 6){
            $categoryname = "Enamel pins";
            $categorycode = "E0";
            $newproduct = $categorycode.$temp;
        }else{
            $categoryname = "Scarf";
            $categorycode = "K0";
            $newproduct = $categorycode.$temp;
        }


    }

$productname = $_POST['productname'];
$productprice = $_POST['productprice'];
$file = rand(1000,100000)."-".$_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$folder="img/product/";
$new_size = $file_size/1024;  
$new_file_name = strtolower($file);
$final_file=str_replace(' ','-',$new_file_name);
if(move_uploaded_file($file_loc,$folder.$final_file)){
$fetch = "INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_CATEGORY,ATTACHMENT) VALUES ('$newproduct','$productname','$productprice','$categoryname','$final_file')";
$stid = oci_parse($conn,$fetch);
if(oci_execute($stid)){
    echo 'successfully';
}
}else{
    echo 'error';
}

}

?>
<h1>Create new product</h1>

<form action="" method ="POST" data-validate="parsley" enctype="multipart/form-data">
<label for="productid">Product ID:</label><br>
  <input type="text" name="productid" value="auto generate" disabled><br>
  <label for="productname">Name:</label><br>
  <input type="text" name="productname" placeholder="Input product name"><br>
  <p>Product Category:</p>
  <input type="radio" name="category" value="1">
  <label for="Notebook">Notebook</label><br>
  <input type="radio" name="category" value="2">
  <label for="Totebag">Totebag</label><br>
  <input type="radio" name="category" value="3">
  <label for="Iron On Sticker">Iron On Sticker</label><br>
  <input type="radio" name="category" value="4">
  <label for="Art Class">Art Class</label><br>
  <input type="radio" name="category" value="5">
  <label for="Digital Goods">Digital Goods</label><br>
  <input type="radio" name="category" value="6">
  <label for="Enamel Pins">Enamel Pins</label><br>
  <input type="radio" name="category" value="7">
  <label for="Scarf">Scarf</label><br>
  <label for="productprice">Price:</label><br>
  <input type="text" name="productprice" placeholder="Input product price"><br>
  <input type="file" name="file" data-required="true" /><br>
  <input type="submit" value="Submit" name="submit">
</form> 

<?php
$code = "T03";
$piece = explode("0",$code);
echo $piece[2];
?>