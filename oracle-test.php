
<html>
<body>
<?php

if ($c=OCILogon("ora_i0r7", "a41671785", "ug")) {
  echo "Successfully connected to Oracle.".   "<br />";
	echo date("Y.m.d"). "<br />";
	echo date("H:i:s"). "<br />";
  OCILogoff($c);
} else {
  $err = OCIError();
  echo "Oracle Connect Error " . $err[text];
}
?>
</body>
</html>
