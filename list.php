<html>
<body>
<A HREF="mystuff.php?myperson=<?php echo $myperson?>" target="main">My STuff</A><br />
<A HREF="myQueue.php?myperson=<?php echo $myperson?>" target="main">My Queue</A><br />
<A HREF="otherstuff.php?myperson=<?php echo $myperson?>" target="main">STuff I can borrow</A><br />
<A HREF="borrowedStuff.php?myperson=<?php echo $myperson?>" target="main">STuff I have borrowed</A><br />
<A HREF="notAvailable.php?myperson=<?php echo $myperson?>" target="main">STuff not currently available</A><br>
<A HREF="giveBack.php?myperson=<?php echo $myperson?>" target="main">Return Stuff</A><br />
<A HREF="deleteItem.php?myperson=<?php echo $myperson?>" target="main">Remove Item from  STuff </A><br />
<br />
<A HREF="books.php?myperson=<?php echo $myperson?>" target="main">Show all Books</A><br />
<A HREF="cds.php?myperson=<?php echo $myperson?>" target="main">Show all CD's</A><br />
<A HREF="videos.php?myperson=<?php echo $myperson?>" target="main">Show all Videos</A><br />
<A HREF="misc.php?myperson=<?php echo $myperson?>" target="main">Show all Misc</A><br />
<br />
<?php $itemid=9999;  ?>
<A HREF="insert01.php?myperson=<?php echo $myperson?>&itemid=<?php echo $itemid?>" target="main">Add Misc </A><br />
<A HREF="insertbook.php?myperson=<?php echo $myperson?>&itemid=<?php echo $itemid?>" target="main">Add Book </A><br />
<A HREF="insertcd.php?myperson=<?php echo $myperson?>&itemid=<?php echo $itemid?>" target="main">Add CD </A><br />
<A HREF="insertvideo.php?myperson=<?php echo $myperson?>&itemid=<?php echo $itemid?>" target="main">Add Video</A><br />


<form method="post" action="search.php" target="main" >
Find: <input type ="text" size="10" name="token" value="">
<input type="submit" value="SEARCH">
</form>
<br />
delete yourself : IMMEDIATE!
<form method="post" action="deleteMyself.php" target="main" >
Password: <input type ="password" size="10" name="token" value=<?php echo $myperson ?> >
<input type="submit" value="ERASE ME">
</form>
<CENTER>
<br />
<br />
<br />
<IMG src="apache_pb22_ani.gif" alt="a neat image">
<br />
<a href="http://Www.google.com" target ="main" >Search </a>
<br />
<br />
<br />

</body>
</html>

