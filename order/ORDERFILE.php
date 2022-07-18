<!DOCTYPE html>
<html lang="en">
<head>
  <title>CREATE NEW ORDER</title>
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
include('../config.php');
$successful = "";
$req= "";
$sql = "SELECT COUNT(ORDER_ID) AS COUNT FROM ORDERS";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$lastorder = $row["COUNT"];
$temporder = $lastorder + 1;
$temp = (string) $temporder ;
$ordercode = "OR0";
$neworder = $ordercode.$temp;
$templastorder = (string) $lastorder ;
$lastorderfinal = $ordercode.$templastorder;



if(isset($_POST['submit'])){
$custname = $_POST['custname'];
$quantity = $_POST['quantity'];
If(isset($_POST['productname'])){
  $productname = $_POST['productname'];
  $fetch = "SELECT * FROM PRODUCTS WHERE PRODUCT_ID='$productname'";
  $stid = oci_parse($conn,$fetch);
  oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

  $price = $row['PRODUCT_PRICE'];

  $subtotal = $price * $quantity;

}

$fetch = "INSERT INTO ORDERS (ORDER_ID,ORDER_DATE,CUST_ID) VALUES ('$neworder', sysdate,'$custname')";
$stid = oci_parse($conn,$fetch);
if(oci_execute($stid)){
$sql = "SELECT COUNT(ORP_ID) AS COUNT FROM ORDER_PRODUCT";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$lastorders = $row["COUNT"];
$temporders = $lastorders + 1;
$temps = (string) $temporders ;
$ordercodes = "ORP0";
$neworders = $ordercodes.$temps;
$fetch = "INSERT INTO ORDER_PRODUCT (ORP_ID,ORDER_QUANTITY,SUBTOTAL_ORDER,ORDER_ID,PRODUCT_ID) VALUES ('$neworders','$quantity' ,'$subtotal','$neworder','$productname')";
$stid = oci_parse($conn,$fetch);
  If(oci_execute($stid)){
$sql = "SELECT COUNT(INVOICE_ID) AS COUNT FROM INVOICE";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$lastinv = $row["COUNT"];
$tempinv = $lastinv + 2;
$tempinvs = (string) $tempinv ;
$invcodes = "INV0";
$newinv = $invcodes.$tempinvs;
$fetch = "INSERT INTO INVOICE (INVOICE_ID,TOTAL_AMOUNT,INVOICE_DATE,STAFF_ID) VALUES ('$newinv','$subtotal' ,sysdate,'S01')";
$stid = oci_parse($conn,$fetch);
  if(oci_execute($stid)){
$sql = "UPDATE ORDERS SET INVOICE_ID = '$newinv' WHERE ORDER_ID = '$neworder'";
$stid = oci_parse($conn,$sql);
    oci_execute($stid);
      }
      $successful = '<div class="alert alert-primary" role="alert">SUCESSFULLY ORDERED</div>';

      $req ='<div class="alert alert-success" role="alert">Do you make another for this customer?</div><a href="repeatorder.php?invid='.$newinv.'&custid='.$custname.'" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">YES</a>';
      
  }
}
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
              <li><a href="Report.html" class="nav-link px-2 text-secondary">Dashboard</a></li>
              <li><a href="ListCustomer.html" class="nav-link px-2 text-white">Customer</a></li>
              <li><a href="ListStaff.html" class="nav-link px-2 text-white">Staff</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Product</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Order</a></li>
            </ul>
    
    
            <div class="text-end">
              
           
            </div>
          </div>
        </div>
      </header>
      <?php echo $successful;
 echo $req; ?>    
      <main class="col-md-10 ms-sm-auto col-lg-10 px-md-10">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">CREATE NEW ORDER</h1>
          <?php
$sql = "SELECT CURRENT_DATE, SESSIONTIMEZONE FROM DUAL";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$datenow = $row['CURRENT_DATE'];
?>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-8">
              <form action="" method ="POST" data-validate="parsley" enctype="multipart/form-data">
                    <div class="mb-3">
            <div class="col-8"><table class="table table-dark table-striped">
               
                 
                  <tr>
                    <th style="font-size:200%;"> ORDER ID :</th>
                    <td><input type="text" name="orderid" value="<?php echo $neworder; ?>" disabled><br></td>
                  </tr>
                  <tr>
                    <th style="font-size:200%;"> ORDER DATE :</th>
                    <td> Date: <?php echo $datenow; ?><br></td>
                  </tr>
                  <tr>
                  
                  
                </tr>
                
                <div class="container">
                    <div class="row">
                      <div class="col-8">
                        
                            <div class="mb-3">
                    <div class="col-8"><table class="table table-dark table-striped">

            </table>
            <table>
                <tr>
                   
                  <td style="font-size:20px;">Choose Existing Customer :
                   <td> <select name="custname" class="form-control">
                    <?php
                    $query = "SELECT *  FROM CUSTOMERS";
                    $stid = oci_parse($conn, $query);
                    oci_execute($stid);
                    while($row = oci_fetch_array($stid)){
    
                      echo  "  <option value='$row[CUST_ID]'>$row[CUST_NAME]</option>" ; }
                    ?>
                    </select>
                    </td></tr> <tr>
                    <td style="font-size:20px;">New Customer ?</td> 
                    <td><a href="../Customer/CustomerCreate.php" class="btn btn-primary btn-lg"; >Create Account</a>
                </tr>
            </table>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-start">
                <div style="font-size:16px" class="col" >
                PRODUCT
              </div>
              
            </div>
            <br></br>
        <div class="container">
            <div class="row">
              <div class="col-8">
               
              
              <?php
        $query = "SELECT *  FROM PRODUCTS";
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        while($row = oci_fetch_array($stid)){
              echo '<label class="btn btn-secondary"><img src="https://img.ltwebstatic.com/images3_pi/2021/08/24/16297751055d790418013a97d2f0960453e6901352_thumbnail_600x.webp" height=50px width=50px><br>';
              echo '<input type="radio" name="productname" value="'.$row['PRODUCT_ID'].'" autocomplete="off">'.$row['PRODUCT_NAME'];
              echo '</label>';
        }?>
              
              </div>
          
          
        </div>
        <br>
        <input type='number' name='quantity' min='1' value="1"><br>  <br>           
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
    <aside>

    </aside>
        </main>
        
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
          
        </body>
        </html>
    