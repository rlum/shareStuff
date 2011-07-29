<html>
<body>

<!--
<br />

<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>

post myperson
<?php // echo  $_POST['myperson'] ;?>
post item
<?php //echo  $_POST['item'] ;?>
post value
<?php //echo  $_POST['value'] ;?>
<br />
-->
<?php 	$mylocalvar = $_POST['myperson'];
//	echo  "mylocalvar for using with queries = $mylocalvar";
//	echo "<br/>" ;
?>
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
//	echo "Connected to Oracle". "<br />";
 	$cmdstr = 'update item set available=\'T\' where item.i_number in (select i.i_number from item i inner join ownedby o on i.i_number=o.i_number and o.email=\'';
	$cmdstr = $cmdstr . $_POST['myperson']  . '\''; 
	$cmdstr = $cmdstr .')';

	//echo "$cmdstr \n";
	//echo "<br/>";
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
	 OCICommit($db_conn);

	OCILogoff($db_conn);
}

include ('mystuff.php'); 
?>

</body>
</html>

