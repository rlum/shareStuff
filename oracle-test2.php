
<?php

/* Test Oracle file for UBC CPSC304 2006 Winter Term 2
   Created by Jiemin Zhang
   This file shows how to get the values from user 
 
   The script assumes you already have a server set up 
   ALL OCI commands are commands to the Oracle libraries
   To get the file to work, you must place it somewhere where
   Apache server can run it, and you must rename it to have a ".php"
   extension. You must also change the ora_i0r7 and a41671785 on the 
   OCILogon below to be your ORACLE username and password */

if ($db_conn=OCILogon("ora_i0r7", "a41671785", "ug")) {
  echo "Successfully connected to Oracle.<br>";

//Insert data got from user...

$number=$_POST['NO']; // get variables from previous page
$name=$_POST['name']; 

if ($number&&$name)  
{
 $cmdstr = "insert into tab1 values ($number, '$name')";
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
}

else{
   echo "<br>input invalid value.<br>";
  }

// Select data...
   $cmdstr = "select * from tab1";
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

   echo "<br>Got data from table tab1:<br>"; 
   while ($row = OCI_Fetch_Array($parsed, OCI_BOTH))

   {
     echo $row["COL1"];     
     echo "\n";
     echo $row["COL2"]; 
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
