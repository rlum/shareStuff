<html>
<body>
<?php // echo $_GET['myperson'];?>
<h1> Add Item </h1>

<a href="insertvideo.php?myperson=<?php echo $_GET['myperson']; ?>" >
	Insert video item instead         
</a>
&nbsp;
&nbsp;
<a href="insertbook.php?myperson=<?php echo $_GET['myperson']; ?>" >
	Insert  book instead         
</a>
&nbsp;
&nbsp;
<a href="insertcd.php?myperson=<?php echo $_GET['myperson']; ?>" >
	Insert  cd instead         
</a>


<form method="POST" action="insertNewItemOwnedby.php">
  <p>Value
	<input type="text" name="value"  value=0.00 >
	Owner
	<input type="text" name="owner" value='<?php echo $_GET['myperson'];?>' >
	<input type="submit" value="submit" name="B1"></p>
		Description
	<textarea rows="5" cols="75"  name="description" >
	</textarea>
	</p><p>
</form>
</body>
</html>
