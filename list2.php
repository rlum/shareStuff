<html>
<body>
ENTERED LIST2 
<br />
	<?php echo "myperson = $myperson"; ?>
<br />
	<?php echo "myperson = $myperson"; ?>
<br />

<br />
<br />
<br />
<?php 
	$mytestvar = "star trek"; 
	$year = 2003;
	echo $year;
	echo " the year is $year ";
 	echo $mytestvar; ?>
<?php echo $mytestvar; ?>
<br />
<button type="button" onclick="getGlobalUser.php">Get Global UserID
</button>

<br />
<form method="post" action=testr.php target="main" >
<input type="submit" name="town" value="ROCHESTER"
			name="user" value="theUser">
</ form>
<br />


<IMG src="apache_pb22_ani.gif" alt="a neat image">
<a href="http://Www.google.com" target ="main" >My Home Page</a>
<a href="sample_page.html" target ="main" >Sample Page</a>
<A HREF="testreceive.html?town=Rochester" target="main">West Rochester</A>
<A HREF="testr.php?town=Rochester&email=no@jumkhome" target="main">West Rochester</A>
<A HREF="testr.html?town=Rochester" target="main">West Rochester</A>
<br />
<br />

// <A HREF="testr.php?town=<?php echo $mytestvar?>&email=no@jumkhome" target="main">rest wochester</A>


<a href="vartest.php?arg1=one&parm=cheese" target="main">Test var</a>
<?php $zza="AnotherOne"; 
	echo $zza ; ?>
<a href="vartest.php?arg1=<?php echo $zza ?>&parm=cheese" target="main">Test var</a>

<br />

</body>
</html>

