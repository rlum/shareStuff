<html>
<body>
<h1> SEARCH RESULT</h1>

<br />

<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>

<?php echo $_POST['token'];?>
<?php echo $_GET['item'];?>
<br />
<?php 	
	if ($mylocalvar == ''){
	$mylocalvar = $_POST['token'];
	}
	//$mylocalvar = lower($mylocalvar);
	echo  "mylocalvar for using with queries = $mylocalvar";
	echo "<br/>" ;?>


<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")){
	echo "Connected to Oracle". "<br />";

	$cmdstr = " alter session set NLS_COMP='LINGUISTIC'";
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
	$cmdstr = "select i.i_number, i.value, i.description, i.available 
		from item i 
		where 
			i.i_number not in (
				select i_number from bookitem union
				select i_number from cditem union
				select i_number from videoitem )
			and i.description like '%$mylocalvar%'";
	$cmdstr = $cmdstr . " union
		select b.i_number, b.value, ' Author: '|| trim(b.author) || ' Title: ' || trim(b.title) || ' : ' ||
			trim(b.description), b.available 
		from bookitem b
		where (b.author like '%$mylocalvar%') or (b.title like '%$mylocalvar%') ";
	$cmdstr = $cmdstr . " union
		select c.i_number,c.value, ' Genre: '|| trim(c.genre) || ' Album: ' || trim(c.albumname) || ' Artist: ' ||
			trim(c.artistname) || ' : ' || trim(c.description), c.available
		from cditem c
		where (c.genre like '%$mylocalvar%') or (c.albumname like '%$mylocalvar%') or
			(c.artistname like '%$mylocalvar%') or (c.description like '%$mylocalvar%') ";

	$cmdstr = $cmdstr . " union
		select v.i_number,v.value, ' Genre: ' || trim(v.genre) || ' FMT: ' || trim(v.format) || ' Title: ' ||
			trim(v.title) || ' : ' || trim(v.description), v.available
		from videoitem v
		where (v.genre like '%$mylocalvar%') or (v.format like '%$mylocalvar%') or
			(v.title like '%$mylocalvar%') or (v.description like '%$mylocalvar%') ";
 
	echo "$cmdstr \n";
	echo "<br/>";
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
?>
<TABLE border="1">
<tr>
<td>
Item
</td>
<td>
Value
</td>
<td>
Description
</td>
<td>
Avail
</td>

</tr>


<?php
	while($row = OCI_Fetch_Array($parsed, OCI_BOTH)){
		echo "<TR>";
		echo "<TD>";
		echo "<a href=\"itemReport.php?itemid=$row[0]\">";
		echo $row[0];
		echo "</a>";
		echo "</TD><TD>";
		echo $row[1];
		echo "</TD><TD>";
		echo $row[2];
		echo "</TD><TD>";
		echo $row[3];
		echo "</TD>>";
		echo "<tr />";
	}

	echo "</TABLE>";

	OCILogoff($db_conn);
}

?>


</body>
</html>

