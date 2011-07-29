<html>
<body>

Welcome <?php echo $_POST['name']; ?><br />

<?php 

$myperson = $_POST['name'];
$secret = $_POST['password'];
echo $myperson;
echo "<br />" ;
echo $secret;
echo "<br />";

if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	echo "Connected to Oracle". "<br />";
//	$cmdstr = "select email from person p where p.email='$myperson' and p.password='ora_hash("$secret")'";
//	$cmdstr = "select * from person ";
//	$cmdstr = "select * from person  where email='$myperson'";
//	$cmdstr = "select * from person p  where p.name='$myperson' ";
	$cmdstr = "select email from person p  where p.email = '$myperson' ";
	$cmdstr = $cmdstr . "and '$secret' = p.password ";
//	$cmdstr = $cmdstr . " and p.password=ora_hash('$secret')";
	echo $cmdstr;
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
	//while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
	echo "<br />";
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		
	echo "zero  = ";
		 echo $row[0];
	echo " one  = ";
		 echo $row[1];
	echo " two  = <br />";
		 echo $row[2];
	echo " three  = <br />";
		 echo $row[3];
		echo "<br />";
// for some reason select returns email with trailing blank - datafill? char vs varchar?
	echo " myperson = $myperson <br/>";
		if ((trim($row[0]))==trim($myperson)) {
			echo "success login";
		 	if ($myperson=='theOne')
				echo "<a href=\"index.html\">Proceed to SuperUser</a> ";
			else
				echo $myperson;
				$GLOBALS['SelectedUser']=$myperson;
				?>
				<a href="index2.php?myuser=<?php echo $myperson?>" >Proceed to Login</a> 
			<?php
		}else{
			echo "failed login";
		}

	}
	echo $row; 
	echo $parsed; 
}
?> 


</body>
</html>
