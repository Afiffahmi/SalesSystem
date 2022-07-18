<head>
  <title>Order</title>

  <link rel="icon" type="image/x-icon" href="img/Assest/Coin.png">
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
<body>
<?php
include('../config.php');

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

if(isset($_GET["invid"]) && !empty(trim($_GET["invid"]) && isset($_GET["custid"]) && !empty(trim($_GET["custid"])))){
$invid =  trim($_GET["invid"]);
$custid =  trim($_GET["custid"]);
if(!empty($invid)){
$sql = "SELECT * FROM INVOICE WHERE INVOICE_ID = '$invid'";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$lasttotalamount = $row['TOTAL_AMOUNT'];
}
if(!empty($custid)){
$sql = "SELECT * FROM CUSTOMERS WHERE CUST_ID = '$custid'";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);    
$custname = $row['CUST_NAME'];
}

if(isset($_POST['submit'])){
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
    
    $fetch = "INSERT INTO ORDERS (ORDER_ID,ORDER_DATE,CUST_ID,INVOICE_ID) VALUES ('$neworder', sysdate,'$custid','$invid')";
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
        $tempinv = $lastinv + 1;
        $tempinvs = (string) $tempinv ;
        $invcodes = "INV0";
        $newinv = $invcodes.$tempinvs;
        $newsubtotal= $subtotal + $lasttotalamount;
          $fetch = "UPDATE INVOICE SET TOTAL_AMOUNT ='$newsubtotal' WHERE INVOICE_ID = '$invid'";
          $stid = oci_parse($conn,$fetch);
          oci_execute($stid);
          echo'<div class="alert alert-primary" role="alert">';
     echo 'SUCESSFULLY ORDERED';
    echo'</div>';
    
    echo'<div class="alert alert-success" role="alert">';
     echo 'Do you make another for this customer?';
    echo'</div>';
    echo '<a href="repeatorder.php?invid='.$newinv.'&custid='.$custname.'" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">YES</a>';
    
    
      }
    }
    }
}


?>
<h1>Additional Order</h1>
<?php
$sql = "SELECT CURRENT_DATE, SESSIONTIMEZONE FROM DUAL";
$stid = oci_parse($conn,$sql);
$result = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
$datenow = $row['CURRENT_DATE'];
?>
<form action="" method ="POST" data-validate="parsley" enctype="multipart/form-data">
<label for="orderid">ID:</label><br>
  <input type="text" name="orderid" value="<?php echo $neworder; ?>" disabled><br><br>
  <label>Date: <?php echo $datenow; ?></label><br><br>
  <label for="orderid">Name:</label><br>
  <input type="text" name="" value="<?php echo $custname; ?>" disabled><br><br>
        <br>

        <label for="product">Choose Product:</label><br>
        <?php
        $query = "SELECT *  FROM PRODUCTS";
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        while($row = oci_fetch_array($stid)){
        echo  "  <input type='radio' name='productname' value='$row[PRODUCT_ID]'>" ; 
        echo "<lable>$row[PRODUCT_NAME] RM$row[PRODUCT_PRICE]</label><br>";
        
      
        }
        ?>
        </select>
        <input type='number' name='quantity' min='1' value="1"><br>

  <input type="submit" value="Submit" name="submit">
</form> 
</body>
</html>