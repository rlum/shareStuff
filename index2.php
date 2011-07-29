<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
   "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD>
<TITLE>Share Stuff</TITLE>
</HEAD>
<?php
	$myperson=$_POST["myuser"];
	echo $myperson;
?>

<FRAMESET cols="30%, 70%">
  <FRAME name="topLeft" src="list.php?myperson=<?php echo $_POST['myuser']?>">
  <FRAME name="main" src="sample_page.html">
</FRAMESET>
</HTML>

