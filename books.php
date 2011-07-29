<html>
<body>
<h1> ALL BOOKS </h1>
<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
<?php 	$mylocalvar = $_GET['myperson'];
?>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select * from bookitem";

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
Title
</td>
<td>
Author
</td>
<td>
Type
</td>
<td>
Value
</td>
<td>
Description
</td>
<td>
Available
</td>
</tr>


<?php
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<TR>";
		echo "<TD>";
		echo "<a href=\"itemReport.php?itemid=$row[0]\">";
		echo $row[0];
		echo "</a>";
		echo "</TD><TD>";
		echo $row[1];
		echo "</TD><TD>";
		echo $row[2];
		echo "</TD><TD>";
		echo $row[3];
		echo "</TD><TD>";
		echo $row[4];
		echo "</TD><TD>";
		echo $row[5];
		echo "</TD><TD>";
		echo $row[6];
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
	echo  "mylocalvar for using with queries = $mylocalvar";
	echo "<br/>" ;
	echo "<br/>" ;
	echo $cmdstr ;
	echo "<br/>";
?>

</body>
</html>

