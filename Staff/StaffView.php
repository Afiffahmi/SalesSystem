<!DOCTYPE html>
<html lang="en">
<head>
  <title>Staff View</title>
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
  <?php
  include('../config.php');
   //retrieven data based on carried id
  if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
      $id =  trim($_GET["id"]);
  
  $sql = "SELECT * FROM STAFFS WHERE STAFF_ID = '$id'";
  $stid = oci_parse($conn,$sql);
  $result = oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
  $staffname = $row['STAFF_NAME'];
  $staffphone = $row['STAFF_PHONE'];
  $email = $row['EMAIL'];
  $file = $row["ATTACHMENT"];

  }
  
  ?>
</head>

<body>
  
    <header class="p-3 bg-dark text-white">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="../Report.php" class="nav-link px-4 text-primary">GGATORART</a></li>
              <li><a href="../Report.php" class="nav-link px-2 text-secondary">Dashboard</a></li>
              <li><a href="../Customer/ListCustomer.php" class="nav-link px-2 text-white">Customer</a></li>
              <li><a href="ListStaff.php" class="nav-link px-2 text-white">Staff</a></li>
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
          <h1 class="h2">Staff View</h1>
          </div>
          <div class="row">
            <?php
            //Profile Picture Retrieve
            $message =""; 
            $profilepicture = $file;  
            //Check Picture availablity
            if(empty($profilepicture)){
              $profilepicture = "default.jpg";
              $message = "$staffname do not have profile picture";
            }
            ?>
            <div class="col-3"><img class="profile" src="../img/customer/<?php echo $profilepicture; ?>"><br>
            <br><?php echo $message; ?>
 
            </div>
            
            <div class="col-8"><table class="table table-dark table-striped">
            <h3>Staff Detail</h3>
                  <tr>
                    <th>Staff ID:</th>
                    <td><?php echo $id; ?></td>
                  </tr>
                  <tr>
                    <th>Full Name:</th>
                    <td><?php echo $staffname; ?></td>
                  </tr>
                  <tr>
                    <th>Phone:</th>
                    <td><?php echo $staffphone; ?></td>
                  </tr>
                  <tr>
                    <th>Email:</th>
                    <td><?php echo $email; ?></td>
                  </tr>
            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
           <a href="StaffUpdate.php?id=<?php echo $row['STAFF_ID']?>"  class='btn btn-primary btn-lg active' role='button btn-sm' aria-pressed='true'>Update</a>
            <button type="button" class="btn btn-danger btn-lg">Delete</button></div>
            <h3>Invoice Issue History</h3>
            <?php 
            //Invoice Issue History 
            $sql = "SELECT  I.INVOICE_ID , S.STAFF_ID , S.STAFF_NAME 
                          FROM STAFFS S
                          JOIN INVOICE I
                          ON S.STAFF_ID = I.STAFF_ID 
                          WHERE S.STAFF_ID = '$id' " ;

              $stid3 = oci_parse($conn,$sql);
              $result = oci_execute($stid3);
              ?>
            <table class="table table-dark table-striped">
                <thead>
                  <tr>
                    <th>INVOICE ID</th>
                    <th>STAFF ID</th>
                    <th>STAFF NAME</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  //Retrieve History Customer
                  while ($row = oci_fetch_array($stid3, OCI_RETURN_NULLS+OCI_ASSOC)) {
                    print '<tr>';
                    foreach ($row as $item) {
                        print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
                    }
                    print '</tr>';
                 }
                  ?>
                  <td></td>
                  <td></td>
                  <td></td>
              
                 
                </tbody>
            </table>
        </div>

    
        <?php
        //Badges SQL ( total invoice)
        $sql = "SELECT COUNT(INVOICE_ID)AS COUNT FROM INVOICE WHERE STAFF_ID = '$id'";
        $stid4 = oci_parse($conn,$sql);
        $result = oci_execute($stid4);
        $row = oci_fetch_array($stid4, OCI_ASSOC+OCI_RETURN_NULLS);
        $count=$row['COUNT'];
        if(empty($count)){
          $count = "This staff didnt make any invoice.";
        }else{
          $count = $count." Total Invoice";
        }

        
        ?>
</main>
        <h3>Badges</h3>
      <p>Achievement that have collected by this customer</p>
        <div class="card" style="width: 18rem; ">
            <img src="../img/Assest/EDC 2.png" class="card-img-top" >
            <div class="card-body">
              <p class="card-text"><h3>Total Invoice</h3><?php echo $count;  ?></p>
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
    