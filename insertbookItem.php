
<?php
if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")) {
  echo "Successfully connected to Oracle.<br>";
$value=$_POST['value'];
$owner=$_POST['owner'];
$descr=$_POST['description'];
$title=$_POST['title'];
$author=$_POST['author'];



echo "value= ";
echo $value; 
echo "owner= ";
echo $owner;
echo "descr= ";
echo $descr;
echo "title= ";
echo $title;
echo "author= ";
echo $author;


if ($value&&$owner)  
{

 $cmdstr = "insert into item(value,description) values (:bind1, :bind2)"; 
// $cmdstr = $cmdstr . "insert into item(value,description) values (:bind1, :bind2)"; 

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
}

else{
   echo "<br>input invalid value.<br>";
  }

// Select data...
   $cmdstr = "select * from item";
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
