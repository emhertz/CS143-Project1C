<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>

<?php
	$movie = $_POST["movie"];
	$comment = $_POST["comment"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	# Sanitize input
	$movie = mysql_real_escape_string($movie, $db_connection);
	$comment = mysql_real_escape_string($comment, $db_connection);

	print("Commenting on movie " . $movie);

?>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./addComment.php" method="POST">
			Movie:<br/>
			<input type="text" name="movie" maxlength="100" width="100"><br/><br/>
			Comment:<br/>
			<textarea name="comment" cols="40" rows="5"></textarea><br/>
			<input type="submit" value="Comment"/>
			</form>
			<hr/></font>
		</td>
	</tr>
</table>
</body>
</html> 

</body>
</html>

