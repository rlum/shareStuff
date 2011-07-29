<html>

<head>
<meta content="en-ca" http-equiv="Content-Language">
<style type="text/css">
.auto-style1 {
	font-size: large;
}
</style>
</head>

<body>
<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"><br>
	<br><span class="auto-style1">People sharing report:</span></FORM>

<?php 	$mylocalvar = $_POST['myperson'];
?>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select email, available, count(*), sum(value)  from item i, ownedby o  where 
			i.i_number=o.i_number  
   		group by rollup(
                              i.available, o.email)
                              order by o.email, i.available";

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
<table border="2">

<?php
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<tr>";
		echo "<td>";
		echo "Person = ";
		echo $row[0];
		echo "<td>";
		echo " Avail = ";
		echo $row[1];
		echo "<td>";
		echo " count  = ";
		echo $row[2];
		echo "<td>";
		echo " total value  = ";
		echo $row[3];
		echo "</tr>  ";
	}

	echo "</table>";
	echo "<br />";
	 OCICommit($db_conn);
	OCILogoff($db_conn);
}
?>

<?php
	echo "$cmdstr \n";
	echo "<br/>";
?>
</table>
<hr />
<p class="auto-style1">Total Items report</p>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select SUM(i.value) from item i";
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
<table border="2">

<?php
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<tr>";
		echo "<td>";
		echo "Total value of all the items registered =  ";
		echo $row[0];
		echo "</tr>  ";
	}

	echo "</table>";
	echo "<br />";
	 OCICommit($db_conn);
	OCILogoff($db_conn);
}
?>

<?php
	echo "$cmdstr \n";
	echo "<br/>";
?>
</table>
<hr />
<br><span class="auto-style1">Presidential report:<br></span></FORM>

&nbsp;<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select email from person p where not exists 
 (select * from ownedby o where o.email='president@us.gov' and not exists 
 (select * from makesTransaction m where m.email=p.email and m.item_number = o.i_number))";
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
	
?><table border="2">

<?php
		echo "<tr>";
		echo "<td>";
		echo "People who have borrowed all items that are ownedby obama ";
		echo "</tr>  ";

	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<tr>";
		echo "<td>";
		echo $row[0];
		echo "</tr>  ";
	}

	echo "</table>";
	echo "<br />";
	 OCICommit($db_conn);
	OCILogoff($db_conn);
}
?>

<?php
	echo "$cmdstr \n";
	echo "<br/>";
?>

<hr />
<br><span class="auto-style1">Stats for users offering more than Average Value <br></span></FORM>

&nbsp;<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select email,imax, icount, isum
			from (
			select o.email as email, max(i.value) as imax, 
				count(*) as icount, 
				sum (i.value) as isum ,
				min (i.value) as imin,
				avg (i.value) as iavg
			from item i, ownedby o
			where i.i_number = o.i_number 
			group by o.email) tmp
		where iavg> 
			(select avg(value) from item)
		"; 
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
	
?><table border="2">

<?php
		echo "<tr>";
		echo "<td>";
		echo "User ";
		echo "<td>";
		echo "Max Value Item ";
		echo "<td>";
		echo "Count ";
		echo "<td>";
		echo "Total Value Offered";
		echo "</tr>  ";

	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<tr>";
		echo "<td>";
		echo $row[0];
		echo "<td>";
		echo $row[1];
		echo "<td>";
		echo $row[2];
		echo "<td>";
		echo $row[3];
		echo "</tr>  ";
	}

	echo "</table>";
	echo "<br />";
	 OCICommit($db_conn);
	OCILogoff($db_conn);
}
?>

<?php
	echo "$cmdstr \n";
	echo "<br/>";
?>


<hr />
<br><span class="auto-style1">Stats for users offering LESS  than Average Value <br></span></FORM>

&nbsp;<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	$cmdstr = "select email,imax, icount, isum
			from (
			select o.email as email, max(i.value) as imax, 
				count(*) as icount, 
				sum (i.value) as isum ,
				min (i.value) as imin,
				avg (i.value) as iavg
			from item i, ownedby o
			where i.i_number = o.i_number 
			group by o.email) tmp
		where iavg< 
			(select avg(value) from item)
		"; 
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
	
?><table border="2">

<?php
		echo "<tr>";
		echo "<td>";
		echo "User ";
		echo "<td>";
		echo "Max Value Item ";
		echo "<td>";
		echo "Count ";
		echo "<td>";
		echo "Total Value Offered";
		echo "</tr>  ";

	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<tr>";
		echo "<td>";
		echo $row[0];
		echo "<td>";
		echo $row[1];
		echo "<td>";
		echo $row[2];
		echo "<td>";
		echo $row[3];
		echo "</tr>  ";
	}

	echo "</table>";
	echo "<br />";
	 OCICommit($db_conn);
	OCILogoff($db_conn);
}
?>

<?php
	echo "$cmdstr \n";
	echo "<br/>";
?>

</body>
</html>

