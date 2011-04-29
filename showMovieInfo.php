<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>

<?php

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	$result = mysql_query("SELECT title, year, id FROM Movie ORDER BY title", $db_connection);
	if(!$result) {
		$message = "Invalid query: " . mysql_error() . "\n";
		die($message);
	}
?>


<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./movie.php" method="POST">
			Movie:
			<select name="movie">
			<?php
			while($row = mysql_fetch_assoc($result)) {
				echo "<option value='" . $row['id'] . "'>";
				echo $row['title'];
				echo "</option>";
			}
			?>
			</option>
			</select>
			<input type="submit" value="Search"/>
			</form>
			<hr/></font>
		</td>
	</tr>
</table>
</body>
</html> 