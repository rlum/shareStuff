<html>
<body>
<h1> MY STUFF</h1>
<?php 
	if ($mylocalvar == '')
	$mylocalvar = $_GET['myperson'];

	echo $mylocalvar . "a";
?>

<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>

<br />
<?php 	
	if ($mylocalvar == ''){
	$mylocalvar = $_GET['myperson'];
	}
;?>

<form method="post" action="makeMyStuffAvail.php">
Make All My Stuff Available
<input type="submit" name="myperson" value="<?php echo $mylocalvar ?>" >
</form>

<form method="post" action="showMyTotals.php">
Compare EveryOnes totals
<input type="submit" name="myperson" value="Show Totals" >

</form>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
//	echo "Connected to Oracle". "<br />";
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
	
	echo "Data Retrieved <br />";
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
		echo "<a href=\"itemReport.php?itemid=$row[0]\">";
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
<br />
<?php echo $_GET['item'];?>
<br />
<?php echo  "mylocalvar for using with queries = $mylocalvar"; ?>
<br />
<?php	echo "$cmdstr \n"; ?>
<br/>


</body>
</html>

