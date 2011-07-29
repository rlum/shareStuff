<?php
$GLOBALS['SelectedUser']=$_POST["selectUser"];

include ('showPersons.php');
echo "<br />";
if ((  $myperson !== '' )&&(trim($_POST["pwd"]) == trim($userpasswd[$myperson]))  ){
include ('list.php');
}else{
echo "<br />";
echo "Wrong Password, try one of these: ";
echo "<br />";
foreach ($userpasswd as $key => $value) {
      echo $key   ;
	echo " : ";
	echo $username[$key];
	echo " : ";
      echo $value ;
      echo "<br />";
}
}


?>
 
