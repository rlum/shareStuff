<html>
<body>
<br />
<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
<br />
myperson = 
<?php $myperson = $_GET['myperson']; echo $myperson;?>
<br/>
itemid = 
<?php $item = $_GET['itemid']; echo $item;?>
<?php /**
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){

	$cmdstr = "INSERT INTO itemRating(Rating, IR_ID, itemComment)
				VALUES ('$rating', default, '$description')";

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
	 OCICommit($db_conn);

	OCILogoff($db_conn);
}
//include ('borrowedStuff.php'); */
?>
<br/>
<br/>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select avg(ir.rating) from hasrating hr, itemrating ir 
	where hr.i_number = '$item' and hr.ir_id = ir.ir_id 
	group by hr.i_number";
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
	
?>


<?php
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<tr>";
		echo "<td>";
		echo "Average rating of the item =  ";
		echo $row[0];
		echo "</tr>  ";
	}
	echo "<br />";
	 OCICommit($db_conn);
	OCILogoff($db_conn);
}
?>
<hr />
<?php
	echo "$cmdstr \n";
	echo "<br/>";
?>

----------------------
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){

	$cmdstr = "select ir.rating, ir.itemcomment from hasrating hr, itemrating ir
				where hr.i_number = '$item' and hr.ir_id = ir.ir_id";
 
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
Rating
</td>
<td>
Comment
</td>
</tr>


<?php
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<TR>";
		echo "<TD>";
		echo $row[0];
		echo "</a>";
		echo "</TD><TD>";
		echo $row[1];
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

<br />
</body>
</html>

