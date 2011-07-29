<html>
<body>
RESULTS
<br />
<FORM><INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
<br />
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")) {

$value=$_POST['value'];
$owner=$_POST['owner'];
$descr=$_POST['description'];
$title=$_POST['title'];
$author=$_POST['author'];
$type=$_POST['type'];

if ($value&&$owner)  
{

$cmdstr = "insert into item(value,description) values (:bind1, :bind2)"; 
//echo $cmdstr;
 
$parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   OCIBindByName($parsed, ":bind1", $value); 
   OCIBindByName($parsed, ":bind2", $descr); 
   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      echo htmlentities($e['message']);
      exit;
   }
 
$cmdstr2 =  "insert into ownedby values (item_seq.currval, :bind3)";
//echo $cmdstr2;
$parsed2 = OCIParse($db_conn, $cmdstr2);
   if (!$parsed2){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }
   OCIBindByName($parsed2, ":bind3", $owner); 
   $r=OCIExecute($parsed2, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed2); 
      echo htmlentities($e['message']);
      exit;
   } 
$cmdstr3 =  "insert into book values (item_seq.currval, :bind4 , :bind5 , :bind6)";
//echo $cmdstr3;
$parsed3 = OCIParse($db_conn, $cmdstr3);
   if (!$parsed3){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }
   OCIBindByName($parsed3, ":bind4", $title); 
   OCIBindByName($parsed3, ":bind5", $author); 
   OCIBindByName($parsed3, ":bind6", $type); 
   $r=OCIExecute($parsed3, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed2); 
      echo htmlentities($e['message']);
      exit;
   } 
}

else{
   echo "<br>input invalid value.<br>";
  }

// Select data...
   $cmdstr4 = "select i.i_number, i.value, i.description, 
			o.email,
			b.title, b.author, b.type 
		from item i, ownedby o, book b  
		where i.i_number=o.i_number and 
			b.i_number=i.i_number
		order by i.i_number desc ";
//	echo $cmdstr4;
   $parsed = OCIParse($db_conn, $cmdstr4);
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      echo htmlentities($e['message']);
      exit;
   } 

   echo "<br>Got data from table item<br>"; 
?>

<TABLE >
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
Owner
</td>
<td>
Title
</td>
<td>
Author
</td>
<td>
Type
</td>
</tr>

<?php 
   while ($row = OCI_Fetch_Array($parsed, OCI_BOTH))

   {
	echo "<TR>";
	echo "<TD>";
     echo $row[0];     
	echo "</TD><TD>";
     echo $row[1]; 
	echo "</TD><TD>";
     echo substr($row[2],0,25); 
	echo "</TD><TD>";
     echo $row[3]; 
	echo "</TD><TD>";
     echo $row[4]; 
	echo "</TD><TD>";
     echo $row[5]; 
	echo "</TD><TD>";
     echo $row[6]; 
	echo "</TD>";
  } 
	echo "</table>";

  OCICommit($db_conn);  
  OCILogoff($db_conn);

} 

else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>

<hr />
SQL COMMANDS Executed
<br />
<?php echo $cmdstr;?>
<br />
<?php echo $cmdstr1;?>
<br />
<?php echo $cmdstr2;?>
<br />
<?php echo $cmdstr3;?>
<br />
<?php echo $cmdstr4;?>
<br />

</body>
</html>
