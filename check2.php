<html>
<body>

Welcome <?php echo $_POST["name"]; ?><br />
<!-- Your password is <?php// echo $_POST["password"]; 
?> <br />
-->

<br />
Today is : 
<?php
	echo date("Y/m/d"). "<br />";
	echo date("Y.m.d"). "<br />";
	echo date("Y-m-d"). "<br />";
        echo date("H:i:s"). " <br />";
?>

<?php 

$myperson=$_POST["name"];
$secret=$_POST["password"];

if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	echo "Connected to Oracle". "<br />";
	$cmdstr = "select email from person p where p.email='$myperson' and p.password='ora_hash("$secret")'";
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
		 echo $row[0];
		if ($row[0] ==  $myperson) {
			echo "success login";
			<a href="index.html">Proceed to SuperUser</a> 	
		}else{
			echo "failed login";
		}
	} 
	?> 


</body>
</html>
