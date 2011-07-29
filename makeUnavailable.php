<html>
<body>

<?php 	$mylocalvar = $_GET['myperson'];?>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){

	$cmdstr = 'update item set available=\'F\' where item.i_number=';
	$cmdstr = $cmdstr . $_GET['item']; 

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

include ('deleteItem.php'); 
?>

</body>
</html>

