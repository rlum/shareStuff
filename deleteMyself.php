<html>
<body>
<h1> DELETING SELF </h1>

<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>

<?php echo $_GET['token'];?>
<?php echo $_POST['token'];?>
<?php 	$mylocalvar = $_POST['token'] ;
;?>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){

	$cmdstr = "delete from item i where i.i_number in ( 
		select it.i_number from item it, ownedby o 
		where  
			o.email = '$mylocalvar'
			and o.i_number=it.i_number )";

	$parsed = OCIParse($db_conn,$cmdstr);
	if (!$parsed){
		$err = OCIError($db_conn);
		echo htmlentities($err['message']);
		exit;
	}
	echo "Your Items have been erased";
	echo "<br/>";	
	echo "<br/>";	
	$r=OCIExecute($parsed, OCI_DEFAULT);
	if(!$r){
		$err = oci_error($parsed);
		echo htmlentities($err['message']);
		exit;
	}

	$cmdstr = "delete from person p where  p.email = '$mylocalvar'";
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
	
	echo "<br /> YOU HAVE BEEN ERASED <br />";
	OCICommit($db_conn);
	OCILogoff($db_conn);
}

?>

<hr />
<?php echo $_GET['myperson'];?>
<?php echo $_GET['item'];?>
<?php
	echo  "mylocalvar for using with queries = $mylocalvar";
	echo "<br/>";
	echo "<br/>";
	echo "$cmdstr \n";
?> 
</body>
</html>

