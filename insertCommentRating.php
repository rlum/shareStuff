<html>
<body>
<br />
<?php $myperson = $_POST['myperson']; //echo $myperson?>
<br/>
<?php $item = $_POST['item']; //echo $item?>
<br />
<?php $rating = $_POST['rating']; //echo $rating?>
<br />
<?php $description = $_POST['description']; //echo $description?>
<br />
<?php
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
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){

	$cmdstr = "INSERT INTO hasRating(IR_ID, I_Number)
				VALUES ((select max(ir.ir_id) from itemRating ir), '$item')";

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

$temp = $myperson;
include ('borrowedStuff.php'); 
?>
<br />
</body>
</html>
