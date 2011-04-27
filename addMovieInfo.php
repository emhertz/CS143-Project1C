<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>

<?php
	$title = $_POST["title"];
	$year = $_POST["year"];
	$rating = $_POST["rating"];
	$company = $_POST["company"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	# Sanitize input
	$title = mysql_real_escape_string($title, $db_connection);
	$year = mysql_real_escape_string($year, $db_connection);
	$rating = mysql_real_escape_string($rating, $db_connection);
	$company = mysql_real_escape_string($company, $db_connection);

	print("Adding movie info for " . $title);

?>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./addMovieInfo.php" method="POST">
			<input type="radio" name="identity" value="add" checked="true">Add New Movie<br/>
			<input type="radio" name="identity" value="edit">Edit Existing Movie<br/>
			<hr/>
			Title:
			<input type="text" name="title" maxlength="100" size="50"><br/><br/>
			Year:
			<input type="text" name="year" maxlength="4" size="4"><br/><br/>
			Rating:
			<input type="text" name="rating" maxlength="10" size="10"><br/><br/>
			Company:
			<input type="text" name="company" maxlength="50" size="50"><br/><br/>
			<input type="submit" value="Add Info"/>
			</form>
			<hr/></font>
		</td>
	</tr>
</table>
</body>
</html> 

</body>
</html>

