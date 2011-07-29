<html>
<head>
<style type="text/css">
.auto-style1 {
	font-size: large;
}
</style>
</head>
<?php //	echo $temp;
;?>
<body>
<h1> STUFF I HAVE BORROWED</h1>
<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"><br>
	<br><span class="auto-style1">Please click on an item to rate it or write a comment:</span></FORM>

<?php 	$mylocalvar = $_GET['myperson'];
	if ($mylocalvar== '')
		$mylocalvar = $temp;
;?>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select i.i_number, i.value, i.description, i.available from 
	makestransaction m, item i where i.i_number=m.item_number and m.email = '$mylocalvar' and type = 'Borrow'";
	//and i.available = 'F'
	$parsed = OCIParse($db_conn,$cmdstr);
	if (!$parsed){
		$err = OCIError($db_conn);
		echo htmlentities($err['message']);
		exit;
	}
	
	$r=OCIExecute($parsed, OCI_DEFAULT);
	if(!$r){
		$err = oci_error($parsed);
		echo htmlentities($err['message']);
		exit;
	}
	
	echo "<br /> Data Retrieved <br />";
?>
<TABLE border="1">
<tr>
<td>
Item
</td>
<td>
Value
</td>
<td>
Description
</td>
<td>
Avail
</td>

</tr>


<?php
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<TR>";
		echo "<TD>";
		echo "<a href=\"comment.php?item=$row[0]&myperson=$mylocalvar\">";
		echo $row[0];
		echo "</a>";
		echo "</TD><TD>";
		echo $row[1];
		echo "</TD><TD>";
		echo $row[2];
		echo "</TD><TD>";
		echo $row[3];
		echo "</TD>>";
		echo "<tr />";
	}

	echo "</TABLE>";

	OCILogoff($db_conn);
}

?>

<hr />
<?php echo $_GET['myperson'];?>
<?php echo $_GET['item'];?>
<?php
	echo "<br/>";
	echo  "mylocalvar for using with queries = $mylocalvar";
	echo "<br/>";
	echo "<br/>";
	echo "$cmdstr \n";
?> 
</body>
</html>

