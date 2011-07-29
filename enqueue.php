<html>
<body>
<!--
<br />

<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
-->

<?php  //echo $_GET['myperson'];?>
<?php  //echo $_GET['item'];?>
<?php 	//$mylocalvar = $_GET['myperson'];?>
	<?php 
	if ($mylocalvar == '')
	$mylocalvar = $_GET['myperson'];
	
	$myitem = $_GET['item'];

	echo $mylocalvar . "a" . $myitem;
?>

<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){

	$cmdstr = 'INSERT INTO InQueue(theDate, I_Number, Email) VALUES (SYSDATE, \'';
	$cmdstr .=  $_GET['item'] . '\', \'' . $_GET['myperson'] . '\')';

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

include ('notAvailable.php'); 
?>

</body>
</html>
