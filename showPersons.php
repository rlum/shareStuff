<html>
<body>
<?php 

$myperson="";

if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	echo "Connected to Oracle". "<br />";
	$cmdstr = "select name, email, password from person";
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
	
//	echo "<br /> Data Retrieved <br />";
/**
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo $row["NAME"]; 
		echo "\n";
		echo $row[1];
		echo "<br />";
	}
**/
	?>
	
	<form method="post" action="setGlobalUser.php">
	<select name="selectUser">
	<option value=""></option>
	<?php 
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
	?>
	<option value="<?php echo $row[1] ?>" > <?php echo $row[0] ?> </option>
	<?php 
	$username[$row[1]] =$row[0];
	$userpasswd[$row[1]] =$row[2];

	}  
	?> 
	</select>
	<input type="submit" value="Set User"><br/>
	Password: 
	<input type="password" size =10" name="pwd" value="password">
	</form>

<?php
	//echo "Current User = ";
	//echo $GLOBALS["SelectedUser"];	
	$myperson=$GLOBALS["SelectedUser"];	
	
	//echo "<br />";	
	OCILogoff($db_conn);
}else{ // logon succesful
	$err = OCIError();
	echo htmlentities($err['message']);
}
	
?>

<?php 
/**
foreach ($username as $key => $value)  {
	echo $key   ;
	echo $value ;
	echo "<br />";
}
foreach ($userpasswd as $key => $value) {
	echo $key   ;
	echo $value ;
	echo "<br />";
}

*/
?>



<?php 
	echo "USERID = $myperson ";
?>
<br />		
</body>	
</html>
