<html>
<body>
<h1> REMOVE My Items From Circulation </h1>

<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>

<br />
<?php 	$mylocalvar = $_GET['myperson'];
;?>

<form method="post" action="makeMyStuffUnAvailable.php">
 Make All My Stuff UNAvailable
 <input type="submit" name="myperson" value="<?php echo $mylocalvar ?>" >
 </form>

<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select i.i_number, i.value, i.description, i.available from item i , ownedby o where o.i_number=i.i_number and o.email = '$mylocalvar'";
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
		echo "<a href=\"makeUnavailable.php?item=$row[0]&myperson=$mylocalvar\">";
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
<br />
<?php 
	echo  "mylocalvar for using with queries = $mylocalvar";
	echo "<br/>";
	echo "<br/>";
	echo "$cmdstr \n";
	echo "<br/>";
?> 
</body>
</html>

