

<?php include('config.php');

$query = 'select * from customers';
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);

// Fetch each row in an associative array
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
   print '<tr>';
   foreach ($row as $item) {
       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
   }
   print '</tr>';
}
print '</table>';

?>
<br>
//FETCH DATA<br>
1.	Parse the statement for execution.<br>
The oci_parse() function parses the statement.<br>

2.	Bind data values (optional).<br>
The oci_execute() function executes the parsed statement.<br>

3.	Execute the statement.<br>
The oci_fetch_array() function retrieves a row of results of the query as an associative array, and includes nulls.<br>

4.	Fetch the results from the database.<br>
The htmlentities() function escapes any text resembling HTML tags so it displays correctly in the browser.<br>


<?php
// Insert the date into mytable
$sql = "INSERT SQL HERE";
$s = oci_parse($conn,$sql);
$r = oci_execute($s);

// The rollback does nothing: the data has already been committed
oci_rollback($conn);

echo "Data was committed\n";
?>
//INSERT

function do_delete($conn)
{
  $stmt = "delete from mytable";
  $s = oci_parse($conn, $stmt);
  $r = oci_execute($s);
}
//delete