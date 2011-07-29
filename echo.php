<html>
<body>

Welcome <?php echo $_POST["name"]; ?><br />
Your password is <?php echo $_POST["password"]; ?> <br />

<br />
<br />
Today is : 
<?php
	echo date("Y/m/d"). "<br />";
	echo date("Y.m.d"). "<br />";
	echo date("Y-m-d"). "<br />";
        echo date("H:i:s"). " <br />";
?>
	<a href="index.html">Proceed to SuperUser</a> 	

</body>
</html>
