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
	$director = $_POST["director"];

	$genre = $_POST["genre"];

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

	$dir_result = @mysql_query("SELECT first, last, dob from Director ORDER BY last");
	$rating_result = @mysql_query("SELECT DISTINCT rating from Movie ORDER BY rating");
	$genre_result = @mysql_query("SELECT DISTINCT genre from MovieGenre ORDER BY genre");

	$resID = @mysql_query("SELECT id FROM MaxMovieID");
	$row = @mysql_fetch_assoc($resID);
	$id = $row['id'];
	$id = $id + 1;
	
	$movie_query = "INSERT INTO Movie VALUES($id, '$title', $year, '$rating', '$company')";
	
	$name_arr = preg_split("/ /", $director);
	$dir_find = "SELECT id from Director where first='$name_arr[0]' and last='$name_arr[1]'";
	
	$dir_id_res = @mysql_query($dir_find);
	$row = @mysql_fetch_assoc($dir_id_res);
	$did = $row['id'];
	$dir_query = "INSERT INTO MovieDirector VALUES($id, $did)";
	$upd_query = "UPDATE MaxMovieID SET id=$id";

	@mysql_query($upd_query, $db_connection);
	@mysql_query($movie_query, $db_connection);
	@mysql_query($dir_query, $db_connection);
	
	if($genre) {
		foreach ($genre as $g) {	
			$genre_query = "INSERT INTO MovieGenre VALUES($id, '$g')";
			@mysql_query($genre_query, $db_connection);
		}
	}

?>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./addMovieInfo.php" method="POST">
			<input type="radio" name="identity" value="add" checked="true">Add New Movie<br/>
			<!--<input type="radio" name="identity" value="edit">Edit Existing Movie<br/>-->
			<hr/>
			Title:
			<input type="text" name="title" maxlength="100" size="50"><br/>
			Year:
			<input type="text" name="year" maxlength="4" size="4"><br/>
			Rating:
			<select name="rating">
			<?php
				while($row = mysql_fetch_assoc($rating_result)) {
					$rating = $row['rating'];
					print "<option value='".$rating."'>$rating</option>";
				}
			?>
			</select><br/>
			Director:
			<select name="director">
			<?php
				while($row = mysql_fetch_assoc($dir_result)) {
					$first = $row['first'];
					$last = $row['last'];
					$dob = $row['dob'];
					print "<option value='".$first. " " . $last ."'>$first $last (Born: $dob)</option>";
				}
			?>
			</select><br/>
			Company:
			<input type="text" name="company" maxlength="50" size="50"><br/>
			Genre:
			<select name="genre[]" multiple="multiple" size=5>
			<?php
				while($row = mysql_fetch_assoc($genre_result)) {
					$genre = $row['genre'];
					print "<option value='".$genre."'>$genre</option>";
				}
			?>
			</select><br/>
			<input type="submit" value="Add Info"/>
			</form>
			<hr/></font>
		</td>
	</tr>
</table>
</body>
</html> 

