<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>

<?php
	$comment = $_POST["comment"];
	$mid = $_POST["mid"];
	$name = $_POST["name"];
	$rating = $_POST["rating"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	# Sanitize input
	$comment = mysql_real_escape_string($comment, $db_connection);
	$mid = mysql_real_escape_string($mid, $db_connection);
	$name = mysql_real_escape_string($name, $db_connection);
	$rating = mysql_real_escape_string($rating, $db_connection);
	
	if (!is_numeric($rating))
		$rating = 0;

	$result = mysql_query("INSERT VALUES(" . $name . ", " . CURRENT_TIMESTAMP() . ", " . $mid . ", " . $rating . ", " $comment . ") INTO Review", $db_connection);
	if (!$result) {
		$result = mysql_query("UPDATE Review SET time = " . CURRENT_TIMESTAMP() . ", rating = " . $rating . ", comment = " . $comment . " WHERE name = ". $name . " AND mid = " $mid, $db_connection);
		if (!result) {
			$message = "Invalid query: " . mysql_error() . "\n";
			die($message);
		} else {
			print "Review updated!";
		}
	} else {
		print "Review posted!";
	}
		
?>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./addComment.php" method="POST">
			Name:<br/>
			<input type="text" name="name" maxlength="100" width="100"><br/><br/>
			Comment:<br/>
			<textarea name="comment" cols="40" rows="5"></textarea><br/>
			Rating:<br/>
			<input type="text" name="name" maxlength="1" width="100"><br/><br/>
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

