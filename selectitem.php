<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodeHim">
    <title>SELECT ITEM FINAL NI</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> 
    
	<!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">

  
  </head>
  <body>

  <!-- Top Nav -->
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
              <button type="button" class="btn btn-outline-light me-2">Login</button>
              <button type="button" class="btn btn-warning">Sign-up</button>
            </div>
          </div>
        </div>
      </header>
	<!--tajuk 1-->
      <main class="col-md-10 ms-sm-auto col-lg-10 px-md-10" style="margin-right:100px";>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add To Cart</h1>
            </div>
			<!--soalan 1-->
				<p>New Customer ?
					<td><a href="#" class="btn btn-primary btn-lg"; >Create Account</a>
				</p>
				<p>Existing Customer ?
					<td><div class="custom-select" style="width:200px;">
						<select>
							<option value="0">Find Your Name</option>
							<option value="1">Rokiah</option>
							<option value="2">Gayah</option>
							<option value="3">Saad</option>
							<option value="4">Melur</option>
						</select>
					</td></div>
				</p>
				<!--untuk card product-->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products</h1>
            </div>
      
 <main>
     <!-- Start DEMO HTML (Use the following code into your project)-->
<div class="shopping-cart-wrapper">
  <table class="table is-fullwidth shopping-cart">
    <thead>
      <tr>
        <th><abbr title="Position"></abbr></th>
        <th></th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th></th>
      </tr>
    </thead>
  </table>
  <div class="totals">
    <div class="totals-item">
      <label>total</label>
      <div class="totals-value" id="cart-subtotal">￥0</div>
    </div>
  </div>
  <button class="btn btn-primary btn-lg">Checkout</button>
</div>
     <!-- END EDMO HTML (Happy Coding!)-->
 </main>
		<!--footer-->	
		
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
      

    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    
    <script>
      var taxRate = 0.05;
      var shipping = 15.0;
      $(function() {
        var jsonData = [
          <?php include('config.php');
            $query = 'SELECT * FROM PRODUCTS';
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            while($row = oci_fetch_array($stid)){
            ?>
          
          {
            title: "<?php echo $row['PRODUCT_NAME'];?>",
            price: <?php echo $row['PRODUCT_PRICE'];?>,
            quantity: 1,
            total: <?php echo $row['PRODUCT_PRICE'];?>
          },
          <?php } ?>
        ];
        var html = "<tbody>";
        $.each(jsonData, function() {
          html +=
            '<tr class="cart-item">' +
            "        <td>" +
            '          <input type="checkbox" class="cart-item-check"  />' +
            "        </td>" +
            "        <td>" +
            "          " +
            this.title +
            "        </td>" +
            "        <td>RM" +
            this.price +
            "</td>" +
            "        <td>" +
            '          <input class="input is-primary cart-item-qty" style="width:100px" type="number" min="1" value="' +
            this.quantity +
            '" data-price="' +
            this.price +
            '">' +
            "        </td>" +
            '        <td class="cart-item-total">RM' +
            this.total +
            "</td>" +
            "        <td>" +
            '          <a class="button is-small">Remove</a>' +
            "        </td>" +
            "      </tr>";
        });
        html += "</tbody>";
        $(".shopping-cart").append(html);
        
        recalculateCart();
      
        $(".cart-item-check").change(function() {
          recalculateCart();
        });
      
        $(".cart-item-qty").change(function() {
          var $this = $(this);
          var parent = $this.parent().parent();
          parent.find(".cart-item-check").prop("checked", "checked");
          var price = $this.attr("data-price");
          var quantity = $this.val();
          var total = price * quantity;
          parent.find(".cart-item-total").html(total.toFixed(2));
          recalculateCart();
        });
      
        $(".button").click(function() {
          var parent = $(this)
            .parent()
            .parent();
          parent.remove();
          recalculateCart();
        });
      });
      function recalculateCart() {
        var subTotal = 0;
        var grandTotal = 0;
        var tax = 0;
        var items = $(".cart-item");
        $.each(items, function() {
          var itemCheck = $(this).find(".cart-item-check");
          var itemQuantity = $(this).find(".cart-item-qty");
          if (itemCheck.prop("checked")) {
            var itemTotal = itemQuantity.val() * itemQuantity.attr("data-price");
            subTotal += itemTotal;
          }
        });
        if (subTotal > 0) {
          tax = subTotal * taxRate;
          grandTotal = subTotal + tax + shipping;
          $(".totals,.checkout").show();
        } else {
          $(".totals,.checkout").hide();
        }
        $("#cart-subtotal").html(subTotal.toFixed(2));
        $("#cart-total").html(grandTotal.toFixed(2));
        $("#cart-tax").html(tax.toFixed(2));
        $("#cart-shipping").html(shipping.toFixed(2));
      }
  </script>
  
  </body>
</html>