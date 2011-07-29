<html>
<body>
<?php // echo $_GET['myperson'];?>

<h1> Add comment and rating</h1>


<form method="POST" action="insertCommentRating.php">
  <p>Rating: 
	<input type="text" name="rating"  value=0 >
	Owner: 
	<input type="text" name="myperson" value='<?php echo $_GET['myperson'];?>' >
	Item Number: 
	<input type="text" name="item" value='<?php echo $_GET['item'];?>' >
	<input type="submit" value="submit" name="B1"></p>
		Description
	<textarea rows="5" cols="75"  name="description" >
	</textarea><p>
</form>
</body>
</html>

