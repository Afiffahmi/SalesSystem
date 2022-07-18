<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INVOICE</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
	</head>
	<?php
include('../config.php');

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
	$id =  trim($_GET["id"]);
  $sql = "SELECT P.PRODUCT_ID,P.PRODUCT_NAME,P.PRODUCT_PRICE,A.SUBTOTAL_ORDER,A.ORDER_QUANTITY,O.ORDER_ID,C.CUST_ID,C.CUST_NAME,C.ADDRESS,C.CUST_PHONE,I.TOTAL_AMOUNT,I.INVOICE_DATE,I.INVOICE_ID
  FROM PRODUCTS P
  JOIN ORDER_PRODUCT A 
  ON P.PRODUCT_ID = A.PRODUCT_ID
  JOIN ORDERS O
  ON A.ORDER_ID = O.ORDER_ID
  JOIN CUSTOMERS C
  ON O.CUST_ID = C.CUST_ID
  JOIN INVOICE I
  ON O.INVOICE_ID = I.INVOICE_ID
  WHERE O.INVOICE_ID = '$id'";
  $stid = oci_parse($conn,$sql);
  $result = oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
  $custname = $row['CUST_NAME'];
  $address = $row['ADDRESS'];
  $phone = $row['CUST_PHONE'];
  $invid = $row['INVOICE_ID'];
  $invdate = $row['INVOICE_DATE'];
  $totalamount = $row['TOTAL_AMOUNT'];
}
?>

	<body>
		<header>
			<h1>Invoice</h1>
			<address contenteditable>
				<p><?php echo $custname ?></p>
				<p><?php echo $address ?></p>
				<p><?php echo $phone ?></p>
			</address>
			<span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address contenteditable>
				<p>Ggatorart<br>RunTimeTerrror</p>
			</address>
			<table class="meta">
				<tr>
					<th><span contenteditable>Invoice #</span></th>
					<td><span contenteditable><?php echo $invid ?></span></td>
				</tr>
				<tr>
					<th><span contenteditable>Date</span></th>
					<td><span contenteditable><?php echo $invdate ?></span></td>
				</tr>
				<tr>
					<th><span contenteditable>Total Amount</span></th>
					<td><span id="prefix" contenteditable>RM </span><span><?php echo $totalamount ?>.00</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody><?php 
				$sql = "SELECT P.PRODUCT_ID,P.PRODUCT_NAME,P.PRODUCT_PRICE,A.SUBTOTAL_ORDER,A.ORDER_QUANTITY,O.ORDER_ID,C.CUST_ID,C.CUST_NAME,C.ADDRESS,C.CUST_PHONE,I.TOTAL_AMOUNT,I.INVOICE_DATE,I.INVOICE_ID
				FROM PRODUCTS P
				JOIN ORDER_PRODUCT A 
				ON P.PRODUCT_ID = A.PRODUCT_ID
				JOIN ORDERS O
				ON A.ORDER_ID = O.ORDER_ID
				JOIN CUSTOMERS C
				ON O.CUST_ID = C.CUST_ID
				JOIN INVOICE I
				ON O.INVOICE_ID = I.INVOICE_ID
				WHERE O.INVOICE_ID = '$id'";
				$stid = oci_parse($conn,$sql);
				$result = oci_execute($stid);
				while($row = oci_fetch_array($stid)){
					echo '<tr>';
					echo	'<td><a class="cut"></a><span contenteditable>'.$row['PRODUCT_ID'].'</span></td>';
					echo	'<td><span contenteditable>'.$row['PRODUCT_NAME'].'</span></td>';
					echo	'<td><span contenteditable>'.$row['ORDER_QUANTITY'].'</span></td>';
					echo	'<td><span data-prefix>RM </span><span contenteditable>'.$row['PRODUCT_PRICE'].'</span></td>';
					echo	'<td><span data-prefix>RM </span><span>'.$row['SUBTOTAL_ORDER'].'</span></td>';
					echo '</tr>';
				}?>
				</tbody>
			</table>

			<table class="balance">
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span data-prefix>RM </span><span><?php echo $totalamount ?>.00</span></td>
				</tr>
			</table>
		</article>
		
	</body>
	
	<style>
	/* reset */

*
{
	border: 0;

	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #212529; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px;  }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }


	</style>
	

</html>