<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>

<?php
	$entered_id = $_POST["movie"];
	$comment = $_POST["comment"];
	$title = $_POST["title"];
	$name = $_POST["name"];
	$rating = $_POST["rating"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	$movie_query = "SELECT * from Movie order by title";
	
	$movie_res = mysql_query($movie_query, $db_connection);

	$id = 0;

	if($title) {
		$movie_query_new = "SELECT id from Movie where title='$title'";
		$movie_res_new = mysql_query($movie_query_new, $db_connection);
		$row = mysql_fetch_assoc($movie_res_new);
		$id = $row['id'];
	
		# Sanitize input
		$comment = mysql_real_escape_string($comment, $db_connection);
		$name = mysql_real_escape_string($name, $db_connection);
		$rating = mysql_real_escape_string($rating, $db_connection);

		$query = "INSERT INTO Review VALUES('$name', CURRENT_TIMESTAMP(), $id, $rating, '$comment')";
		$result = mysql_query($query, $db_connection);
	}	
?>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./addComment.php" method="POST">
			Movie:
			<select name="title">
			<?php
				while($row = mysql_fetch_assoc($movie_res)) {
					$title = $row['title'];
					$r_id = $row['id'];
					if($entered_id == $r_id) {
						print "<option value='".$title."' selected='selected'>$title</option>";
					} else {
						print "<option value='".$title."' id='".$r_id."'>$title</option>";
					}
				}
			?>
			</select><br/>
			Name:
			<input type="text" name="name" maxlength="100" width="100"><br/>
			Comment:
			<textarea name="comment" cols="40" rows="5"></textarea><br/>
			Rating:
			<select name="rating">
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
			</select><br/>
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

