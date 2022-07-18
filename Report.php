<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
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
    width: 180px;
    height: 180px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #a1a1a1;
    box-shadow: 0 2px 6px #292929;    

    }
  </style>
</head>
<body>
  <?php include('config.php'); ?>
    <header class="p-3 bg-dark text-white">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="#" class="nav-link px-4 text-primary">GGATORART</a></li>
              <li><a href="#" class="nav-link px-2 text-secondary">Dashboard</a></li>
              <li><a href="customer/ListCustomer.php" class="nav-link px-2 text-white">Customer</a></li>
              <li><a href="staff/ListStaff.php" class="nav-link px-2 text-white">Staff</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Product</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Order</a></li>
            </ul>
    
    
            <div class="text-end">
              <button type="button" class="btn btn-warning">Logout</button>
            </div>
          </div>
        </div>
      </header>
    
      <main class="col-md-10 ms-sm-auto col-lg-10 px-md-10">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          </div>
        </div>
        <!-- TOTAL SALES VIEW(ALL TIME) -->
        <?php
            $sql = "SELECT SUM(TOTAL_AMOUNT)AS TOTALSALES FROM INVOICE ";
            $stid = oci_parse($conn,$sql);
            $result = oci_execute($stid);
            $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
            $totalsales = $row["TOTALSALES"];
            ?>
        <div class="container">
          <div class="row">
            <div class="col">
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"><div class="row"><div class="col-1"><img src="img/Assest/Coin.png" width="50px" height="50px"></div><div class="col-4"><h2>Total Sales Alltime</h2></div></div></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><h2>RM<?php echo $totalsales; ?>.00</h2></td>
            </tr>
          </tbody>
        </table>
      </div>
            </div>
            <div class="col">
      <!-- TOTAL SALES VIEW(ALL TIME) -->
      <?php
            $sql = "SELECT TOTAL_AMOUNT,EXTRACT(MONTH FROM INVOICE_DATE)AS DATES FROM INVOICE WHERE EXTRACT(MONTH FROM INVOICE_DATE) = EXTRACT(MONTH FROM sysdate)";
            $stid = oci_parse($conn,$sql);
            $result = oci_execute($stid);
            $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
            $totalsalesm = $row["TOTAL_AMOUNT"];
            if(empty($totalsalesm)){
              $totalsalesm=0;
            }
            ?>        
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"><div class="row"><div class="col-1"><img src="img/Assest/Coin.png" width="50px" height="50px"></div><div class="col-4"><h2>Total Sales Current Month</h2></div></div></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><h2>RM <?php echo $totalsalesm; ?>.00</h2></td>
            </tr>
          </tbody>
        </table>
      </div>
            </div>
          </div>
        </div>
        
      </div>
      <!-- TOP CUSTOMER VIEW -->
      <h2>TOP CUSTOMER</h2>
      <?php include('config.php');

$query = 'SELECT C.CUST_NAME,C.ATTACHMENT, SUM(I.TOTAL_AMOUNT)AS TOTAL FROM CUSTOMERS C,INVOICE I,ORDERS O WHERE C.CUST_ID = O.CUST_ID AND o.order_id = i.order_id GROUP BY C.CUST_NAME, C.ATTACHMENT ORDER BY TOTAL DESC';
$stid = oci_parse($conn, $query);
oci_execute($stid);
echo"<div class='container'>";
echo"<div class='row g-1'>";
$count = "";
while($row = oci_fetch_array($stid)){
  $count = $count + 1 ;
  echo"<div class='col-2'>";
  echo"<img src='img/customer/$row[ATTACHMENT]' class='profile'>";
  echo"<figure class='text-center'>";
  echo"<p><mark><span class='badge bg-primary'>$count</span>$row[CUST_NAME]</mark></p>";
  echo"<figcaption class='blockquote-footer'>";
    echo "Spent RM$row[TOTAL]";
  echo"</figcaption>";
  echo"</figure>";
echo"</div>";
                   
                
} ?>
      
        
          
          
            
           </div>
           <table class="table table-dark table-sm table-striped ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Month</th>
                    <th>Sales</th>

                  </tr>
                </thead>
                <tbody>
                <?php

                $query = 'SELECT EXTRACT(MONTH FROM INVOICE_DATE) AS MONTH,
                CASE 
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 1 THEN SUM(total_amount) 
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 2 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 3 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 4 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 5 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 6 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 7 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 8 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 9 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 10 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 11 THEN SUM(total_amount)
                WHEN EXTRACT(MONTH FROM INVOICE_DATE) = 12 THEN SUM(total_amount)
                END AS BYMONTH
                FROM INVOICE group by EXTRACT(MONTH FROM INVOICE_DATE)
                ORDER BY MONTH ASC';
                $stid = oci_parse($conn, $query);
                oci_execute($stid);
                $counter = "";
                while($row = oci_fetch_array($stid)){
                echo "<tr>";
                    $counter = $counter +1;

                    if($row['MONTH']==1){
                      $month ="January";
                    }elseif($row['MONTH']==2){
                      $month ="February";
                    }elseif($row['MONTH']==3){
                      $month ="March";
                    }elseif($row['MONTH']==4){
                      $month ="April";
                    }elseif($row['MONTH']==5){
                      $month ="May";
                    }elseif($row['MONTH']==6){
                      $month ="June";
                    }elseif($row['MONTH']==7){
                      $month ="July";
                    }elseif($row['MONTH']==8){
                      $month ="August";
                    }elseif($row['MONTH']==9){
                      $month ="September";
                    }elseif($row['MONTH']==10){
                      $month ="October";
                    }elseif($row['MONTH']==11){
                      $month ="November";
                    }elseif($row['MONTH']==12){
                      $month ="Disember";
                    }
                echo "<td>". $counter. "</td>";
                echo "<td>". $month. "</td>";
                echo "<td>". "RM ".$row['BYMONTH']. "</td>";

               


                    
                    
                echo "</tr>";
}
                echo "</tbody>";
              
            echo"</table>"; ?>

    </main>
    <div class="row">
      <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px;">
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
          <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
          <span class="fs-5 fw-semibold">Latest order</span>
        </a>
        <div class="list-group list-group-flush border-bottom scrollarea">
        <?php 

                $query = 
                'SELECT O.ORDER_ID,O.ORDER_DATE,P.PRODUCT_NAME,A.ORDER_QUANTITY
                FROM ORDERS O
                JOIN ORDER_PRODUCT A
                ON o.order_id = a.order_id
                JOIN PRODUCTS P
                ON p.product_id = a.product_id
                ORDER BY o.order_date ASC';
                $stid = oci_parse($conn, $query);
                oci_execute($stid);
                while($row = oci_fetch_array($stid)){
           echo "<a href='#' class='list-group-item list-group-item-action py-3 lh-sm'>";
           echo'<div class="d-flex w-100 align-items-center justify-content-between">';
           echo "<strong class='mb-1'>$row[ORDER_ID]</strong>";
           echo "<small class='text-muted'>$row[ORDER_DATE]</small>";
           echo '</div>';
           echo "<div class='col-10 mb-1 small'>Product : $row[PRODUCT_NAME]</div>";
           echo "<div class='col-10 mb-1 small'>Quantity : $row[ORDER_QUANTITY] units</div>";
           echo '</a>';

                }?>
          
          
          

        </div>
      </div>
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

</body>
</html>