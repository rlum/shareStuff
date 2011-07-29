<html>
<body>


<br />
<?php echo $_GET['myperson'];?>
<?php echo $_GET['item'];?>
<br />
<?php 	$mylocalvar = $_GET['myperson'];
	echo  "mylocalvar for using with queries = $mylocalvar" ;?>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	echo "Connected to Oracle". "<br />";
	$cmdstr = 'select * from item';
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

	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo $row[0]; 
		echo "\n";
		echo $row[1];
		echo "\n";
		echo $row[2];
		echo "\n";
		echo $row[3];
		echo "\n";
		echo "<br />";
	}


	OCILogoff($db_conn);
}

?>


</body>
</html>

