<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product Update</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
    .profile{
    display: inline-block;
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #a1a1a1;
    box-shadow: 0 2px 6px #292929;    

    }
  </style>
</head>
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
<?php
            //Check Picture availablity
            if(empty($profilepicture)){
              $profilepicture = "default.jpg";
            }
            ?>
<body>
  
    <header class="p-3 bg-dark text-white">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="#" class="nav-link px-4 text-primary">GGATORART</a></li>
              <li><a href="#" class="nav-link px-2 text-secondary">Dashboard</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Customer</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Staff</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Product</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Order</a></li>
            </ul>
    
    
            <div class="text-end">
              <button type="button" class="btn btn-outline-light me-2">Login</button>
              <button type="button" class="btn btn-warning">Sign-up</button>
            </div>
          </div>
        </div>
      </header>

      <main class="col-md-10 ms-sm-auto col-lg-10 px-md-10">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Product Update</h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-8">
                <form method="POST" data-validate="parsley" enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name </label>
                            <input type="text" class="form-control" name="productname" value="<?php echo $productname?>">
                          </div>
                       <label for="phone" class="form-label">Product Category</label>
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
                            <label for="email" class="form-label">Product Price</label>
                            <input type="text" class="form-control" name="productprice" value="<?php echo $productprice?>" >
 

                     
                    </div>
                  
                    
                    
                    
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
              </div>
              
              <div class="col-3">
                <img class="profile" src="../img/customer/<?php echo $profilepicture;?>">
                    <div class="mb-3">
                    <label for="formFile" class="form-label">Update image</label>
                      <input class="form-control" type="file" name="file"  id="formFile" >   
          </form>
                      </div>
                  </div>
              </div>
              </div>







          <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
              <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                  <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                </a>
                <span class="mb-3 mb-md-0 text-muted">&copy; 2022 GGATORART</span>
              </div>
          
              <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
              </ul>
            </footer>
          </div>
      </main>
      <h3>Badges</h3>
      <p>Sales collected by this product</p>
      <div class="card" style="width: 18rem; ">
        <img src="../img/Assest/Shopping Bag 1.png" class="card-img-top" >
        <div class="card-body">
          <p class="card-text"><h3>Total Sales</h3>RM10000</p>
        </div>
      </div>
      <div class="card" style="width: 18rem; ">
        <img src="../img/Assest/Cart Bag 2.png" class="card-img-top" >
        <div class="card-body">
          <p class="card-text"><h3>Total Order</h3>7</p>
        </div>
      </div>
        </body>
        </html>