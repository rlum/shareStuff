<html>
<body>
<?php // echo $_GET['myperson'];?>

<h1> Add Book </h1>
<a href="insert01.php?myperson=<?php echo $_GET['myperson']; ?>" >
	Insert misc item instead         
</a>
&nbsp;
&nbsp;
<a href="insertvideo.php?myperson=<?php echo $_GET['myperson']; ?>" >
	Insert  Video instead         
</a>
&nbsp;
&nbsp;
<a href="insertcd.php?myperson=<?php echo $_GET['myperson']; ?>" >
	Insert  cd instead         
</a>


<form method="POST" action="insertNewBookItemOwnedby.php">
  <p>Value: 
	<input type="text" name="value"  value=0.00 >
	Owner: 
	<input type="text" name="owner" value='<?php echo $_GET['myperson'];?>' >
	<input type="submit" value="submit" name="B1"></p>
		Description
	<textarea rows="5" cols="75"  name="description" >
	</textarea>
	<p />
	Title: <input type="text" name="title"   >
	Author: <input type="text" name="author"  >
	Type of Book: <input type="text" name="type"  >
	</p><p>
</form>
</body>
</html>
