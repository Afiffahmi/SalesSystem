<?php
include('config.php');



//retrieven data based on carried id
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id =  trim($_GET["id"]);

$sql = "SELECT * FROM PRODUCTS WHERE PRODUCT_ID = '$id'";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$productname = $row['PRODUCT_NAME'];
$productcategory = $row['PRODUCT_CATEGORY'];
$productprice= $row['PRODUCT_PRICE'];

//update row 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $code = $id ;
    

    if(isset($_POST['category2'])){
        $category = $_POST['category2'];
        if($category == 1){
            $categoryname = "Notebook";
            $categorycode = "N0";
            if(strlen($code)==3){
                $newproduct = $categorycode.$code[2];
            }else{
                $newproduct = $categorycode.$code[2].$code[3];
            }
        }elseif($category == 2){
            $categoryname = "Totebag";
            $categorycode = "T0";
            if(strlen($code)==3){
                $newproduct = $categorycode.$code[2];
            }else{
                $newproduct = $categorycode.$code[2].$code[3];
                }
        }elseif($category == 3){
            $categoryname = "Iron On Sticker";
            $categorycode = "F0";
            if(strlen($code)==3){
                $newproduct = $categorycode.$code[2];
            }else{
                $newproduct = $categorycode.$code[2].$code[3];
                }
        }elseif($category == 4){
            $categoryname = "Art Class";
            $categorycode = "A0";
            if(strlen($code)==3){
                $newproduct = $categorycode.$code[2];
            }else{
                $newproduct = $categorycode.$code[2].$code[3];
                }
        }elseif($category == 5){
            $categoryname = "Digital Class" ;
            $categorycode = "C0";
            if(strlen($code)==3){
                $newproduct = $categorycode.$code[2];
            }else{
                $newproduct = $categorycode.$code[2].$code[3];
                }
        }elseif($category == 6){
            $categoryname = "Enamel pins";
            $categorycode = "E0";
            if(strlen($code)==3){
                $newproduct = $categorycode.$code[2];
            }else{
                $newproduct = $categorycode.$code[2].$code[3];
                }
        }else{
            $categoryname = "Scarf";
            $categorycode = "K0";
            if(strlen($code)==3){
                $newproduct = $categorycode.$code[2];
            }else{
                $newproduct = $categorycode.$code[2].$code[3];
            }
        }
 

    }
    $productname = $_POST['productname'];
    $productprice = $_POST['productprice'];

    $sql = "UPDATE PRODUCTS SET PRODUCT_ID = '$newproduct' , PRODUCT_NAME  ='$productname', PRODUCT_CATEGORY = '$categoryname' ,PRODUCT_PRICE = '$productprice' WHERE PRODUCT_ID ='$id'  ";
    $stid = oci_parse($conn,$sql);
    if(oci_execute($stid)){
    echo 'successfully update products '; echo $id;
    }else{
    echo 'error';
}}}
?>
<h1>Update Products</h1>
<form action="" method ="POST">
<label for="productid">ID:</label><br>
  <input type="text" name="productid" value="<?php echo $id; ?>" disabled><br>
  <label for="productname">Name:</label><br>
  <input type="text" name="productname" placeholder="Input new product name" value="<?php echo $productname; ?>"><br>
  <input type="hidden" name="id" value="<?php echo $id; ?>"/>

  <p>Product Category:</p>
  <p>Previous Category : <?php echo $productcategory; ?></p>
  <input type="radio" name="category2" value="1">
  <label for="Notebook">Notebook</label><br>
  <input type="radio" name="category2" value="2">
  <label for="Totebag">Totebag</label><br>
  <input type="radio" name="category2" value="3">
  <label for="Iron On Sticker">Iron On Sticker</label><br>
  <input type="radio" name="category2" value="4">
  <label for="Art Class">Art Class</label><br>
  <input type="radio" name="category2" value="5">
  <label for="Digital Goods">Digital Goods</label><br>
  <input type="radio" name="category2" value="6">
  <label for="Enamel Pins">Enamel Pins</label><br>
  <input type="radio" name="category2" value="7">
  <label for="Scarf">Scarf</label><br>
  <label for="productprice">Price:</label><br>
  <input type="text" name="productprice" placeholder="Input product price" value = "<?php echo $productprice; ?>"><br>
  <input type="file" name="file" data-required="false" /><br>
  <input type="submit" value="Submit" name="submit">

</form> 


<?php
$coda = 'T051';
echo strlen($coda);

?>