
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")) {
  echo "insertnewItemOwnedby : Successfully connected to Oracle.<br>";
$value=$_POST['value'];
$owner=$_POST['owner'];
$descr=$_POST['description'];

echo "value= ";
echo $value; 
echo "owner= ";
echo $owner;
echo "descr= ";
echo $descr;

if ($value&&$owner)  
{

 $cmdstr = "insert into item(value,description) values (:bind1, :bind2)"; 
// $cmdstr = $cmdstr . "insert into item(value,description) values (:bind1, :bind2)"; 
//$cmdstr = $cmdstr . " ; ";
echo $cmdstr;
 
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
 
//$cmdstr2 =  "insert into ownedby (item_seq.currval, :bind3)";
$cmdstr2 =  "insert into ownedby values (item_seq.currval, :bind3)";
echo $cmdstr2;
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
}

else{
   echo "<br>input invalid value.<br>";
  }

// Select data...
   //$cmdstr = "select i.inumber, i.value, i.description, o.email from item i, ownedby i where i.i_number=o.i_number";
   $cmdstr = "select i.i_number, i.value, i.description, o.email 
		from item i, ownedby o 
		where i.i_number=o.i_number
		order by i.i_number desc";
	echo $cmdstr;
   $parsed = OCIParse($db_conn, $cmdstr);
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
   while ($row = OCI_Fetch_Array($parsed, OCI_BOTH))

   {
     echo $row[0];     
     echo "\n";
     echo $row[1]; 
     echo "\n";
     echo substr($row[2],0,15); 
     echo "\n";
     echo $row[3]; 
     echo "\n";
     echo $row[4]; 
     echo "<br>";    
  } 

  OCICommit($db_conn);  
  OCILogoff($db_conn);
} 

else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>
